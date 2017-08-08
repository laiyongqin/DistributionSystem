<?php

/**
 * 订单表
 *
 * @author: moxiaobai
 * @since : 2016/8/16 17:07
 */

class OrderModel extends BaseModel
{
    private $_field;
    public function __construct()
    {
        $this->_field = 'o_id,o_order_no,m_id,p_id,p_title,pp_ids,pp_title,p_price,o_number,o_order_amount,o_payment_amount,o_pay_status,o_order_status,o_addtime,o_updatetime,o_express_company,o_express_number,o_memo,o_close_remark';
        parent::__construct('www', 't_order', 'o_id');
    }

    /**
     * 获取数据列表
     *
     * @param array $where       搜索条件
     * @param array $pagination  分页信息
     * @param string $field
     * @return array/boolean
     */
    public function getList($where=array(), $pagination = array(), $field = '') {
        $data = $this->_setWhereSQL($where)
                    ->_setPaginationSQL($pagination)
                    ->_db->select($field ? $field : $this->_field)
                    ->from($this->_table)
                    ->order($this->_primary_key, 'DESC')
                    ->fetchAll();

        if ( $data === FALSE ) return FALSE;
        return $data;
    }

    /**
     * 支付成功后,处理订单
     *
     * @param string $orderNo 订单号
     * @return bool
     */
    public function dealOrder($orderNo) {
        $orderInfo = $this->getOrderInfoByOrderNo($orderNo);
        if(!$orderInfo) {
            return false;
        }

        //判断订单是否处理
        if($orderInfo['o_pay_status'] == 3) {
            return false;
        }

        //订单ID
        $oid = $orderInfo['o_id'];

        //更新订单状态
        $this->updateOrderPayStatus($oid, 3);

        //更新订单进度
        $this->updateOrderProgress($oid, '成功支付订单');

        //增加产品销量
        $this->loadModel('Product', array(), 'Mall')->updateSales($orderInfo['p_id'], $orderInfo['o_number']);

        //增加套餐销量
        if($orderInfo['pp_ids'] != '') {
            $this->loadModel('ProductProfile', array(), 'Mall')->updateSales($orderInfo['pp_ids'], $orderInfo['o_number']);
        }

        //增加消费金额
        MemberModel::getInstance()->updateConsume($orderInfo['m_id'], $orderInfo['o_payment_amount']);

        //首次购买成为代言人
        $mid = $orderInfo['m_id'];
        $nickname  = MemberModel::getInstance()->getNicknameByMid($mid);
        if(!MemberModel::getInstance()->isVip($mid)) {
            MemberModel::getInstance()->updateVipLevel($mid, 2);
        }

        //通知上级代言人
        if($orderInfo['o_award_amount'] != 0) {
            //更改销售分销订单
            $this->loadModel('SalesOrder', array(), 'Mall')->updateOrderStatus($orderNo, 2);

            $mid       = $this->loadModel('SalesPromoter', array(), 'Mall')->getMid($orderInfo['m_id']);
            if($mid) {
                $openId = MemberModel::getInstance()->getOpenIdByMid($mid);
                $data   = array(
                    'nickname' => $nickname,
                    'datetime' => date('Y-m-d H:i:s'),
                    'orderNo'  => $orderInfo['o_order_no'],
                    'money'    => $orderInfo['o_payment_amount'],
                    'award'    => $orderInfo['o_award_amount']
                );
                QueueModel::getInstance()->addQueue($openId, 'payment_order_notice', $data);
            }
        }

        return $orderInfo;
    }

    /**
     * 取消订单
     *
     * @param integer $oid   订单ID
     * @return bool
     */
    public function cancleOrder($oid) {
        //更新订单进度
        $this->updateOrderProgress($oid, '用户取消订单');

        //获取订单信息
        $orderInfo = $this->getOrderInfoByOrderNo($oid,2);
        if(!$orderInfo) {
            return false;
        }

        //判断订单是否处理
        if($orderInfo['o_pay_status'] == 2) {
            return false;
        }

        //增加商品库存
        $this->loadModel('Product', array(), 'Mall')->updateStock($orderInfo['p_id'], -$orderInfo['o_number']);


        //增加套餐库存
        if($orderInfo['pp_ids'] != '') {
            $this->loadModel('ProductProfile', array(), 'Mall')->updateStock($orderInfo['pp_ids'], -$orderInfo['o_number']);
        }

        //删除分销订单
        $this->loadModel('SalesOrder', array(), 'Mall')->removeOrder($orderInfo['o_order_no']);

        //用户财富
        if($orderInfo['o_award_amount'] != 0) {
            $mid       = $this->loadModel('SalesPromoter', array(), 'Mall')->getMid($orderInfo['m_id']);
            //$nickname  = MemberModel::getInstance()->getNicknameByMid($orderInfo['m_id']);
            if($mid) {
                //删除分销订单
                $this->loadModel('SalesOrder', array(), 'Mall')->removeOrder($orderInfo['o_order_no']);

                //更新提现金额
                $this->loadModel('MemberWealth', array(), 'Member')->updateWealth($mid, $orderInfo['o_payment_amount'], $orderInfo['o_award_amount'] ,2);

                //通知一级代言人
//                $openId = MemberModel::getInstance()->getOpenIdByMid($mid);
//
//                $data = array(
//                    'nickname' => $nickname,
//                    'datetime' => date('Y-m-d H:i:s'),
//                    'orderNo'  => $orderInfo['o_order_no']
//                );
//                QueueModel::getInstance()->addQueue($openId, 'cancle_order_notice', $data);
            }
        }

        return true;
    }

    /**
     * 确认订单
     *
     * @param   integer $oid 订单ID
     * @return boolean
     */
    public function completeOrder($oid) {
        //更新订单进度
        $this->updateOrderProgress($oid, '用户确认订单');

        //获取订单信息
        $orderInfo = $this->getOrderInfoByOrderNo($oid,2);
        if(!$orderInfo) {
            return false;
        }

        //判断订单是否处理
        if($orderInfo['o_order_status'] == 3) {
            return false;
        }

        //更改销售分销订单
        $this->loadModel('SalesOrder', array(), 'Mall')->updateOrderStatus($orderInfo['o_order_no'], 3);

        //用户财富,提现金额调整
        if($orderInfo['o_award_amount'] != 0) {
            $mid       =  $this->loadModel('SalesPromoter', array(), 'Mall')->getMid($orderInfo['m_id']);
            $nickname  = MemberModel::getInstance()->getNicknameByMid($orderInfo['m_id']);
            if($mid) {
                $this->loadModel('MemberWealth', array(), 'Member')->updateWithdraw($mid, $orderInfo['o_award_amount']);

                //通知一级代言人
                $openId = MemberModel::getInstance()->getOpenIdByMid($mid);
                $data   = array(
                    'nickname' => $nickname,
                    'datetime' => date('Y-m-d H:i:s'),
                    'orderNo'  => $orderInfo['o_order_no'],
                    'money'    => $orderInfo['o_payment_amount'],
                    'award'    => $orderInfo['o_award_amount']
                );
                QueueModel::getInstance()->addQueue($openId, 'confirm_order_notice', $data);
            }
        }

        return true;
    }

    public function saveData($data, $id=0) {
        if($id){
            return $this->_db->update($this->_table)->rows($data)->where($this->_primary_key, $id)->execute();
        }else{
            return $this->_db->insert($this->_table)->rows($data)->execute();
        }
    }

    /**
     * 根据订单号获取订单信息
     *
     * @param $orderNo   订单号/订单ID
     * @param $type      类型  1订单号，2订单ID
     * @param string $field
     * @return mixed
     */
    public function getOrderInfoByOrderNo($orderNo, $type=1, $field = 'o_id,o_order_no,o_pay_status,o_order_status,m_id,p_id,pp_ids,o_number,o_payment_amount,o_award_amount,o_express_company,o_express_number') {
        if($type == 1) {
            $this->_db->where('o_order_no', $orderNo);
        } else {
            $this->_db->where('o_id', $orderNo);
        }

        return $this->_db->select($field)->from('t_order')->fetchOne();
    }

    /**
     * 更新订单确认状态
     *
     * @param $oid     订单ID
     * @param $status  状态    1未发货，2已经发货,3确认收货
     * @return mixed
     */
    public function updateOrderConfirmStatus($oid, $status) {
        $rows = array(
            'o_order_status' => $status,
            'o_updatetime'   => date('Y-m-d H:i:s')
        );

        return $this->_db->update('t_order')->where('o_id', $oid)->rows($rows)->execute();
    }

    /**
     * 更新订单支付状态
     *
     * @param $oid      订单ID
     * @param $status   支付状态   1未支付，2取消订单，3已经支付
     * @return mixed
     */
    public function updateOrderPayStatus($oid, $status) {
        $rows = array(
            'o_pay_status' => $status,
            'o_payTime'    => date('Y-m-d H:i:s'),
            'o_updatetime' => date('Y-m-d H:i:s')
        );

        return $this->_db->update('t_order')->where('o_id', $oid)->rows($rows)->execute();
    }

    /**
     * 添加订单进度
     *
     * @param $oid    订单ID
     * @param $memo   备注
     * @return mixed
     */
    public function updateOrderProgress($oid, $memo) {
        $rows = array(
            'o_id'       => $oid,
            'op_memo'    => $memo,
            'op_addtime' => date('Y-m-d H:i:s')
        );

        return $this->_db->insert('t_order_progress')->rows($rows)->execute();
    }

    /**
     * SQL分页查询
     */
    private  function _setPaginationSQL( $pagination = array() ) {
        if ( isset($pagination['page']) AND isset($pagination['pagesize']) ) {
            $page      = isset( $pagination['page'] ) ? intval($pagination['page']) : 1;
            $pagesize  = isset( $pagination['pagesize']  ) ? intval($pagination['pagesize'])  : 10;
            $this->_db->page($page, $pagesize);
        } elseif ( isset($pagination['limit']) ) {
            $this->_db->limit( intval($pagination['limit']) );
        }
        return $this;
    }

    /**
     * SQL Where条件
     *
     * @param array $condition
     * @return $this
     */
    private function _setWhereSQL ($condition = array()) {
        if(isset($condition['m_id']) && $condition['m_id']){  // 待收货
            $this->_db->where('m_id', $condition['m_id']);
        }

        $this->_db->where('o_pay_status != 2');
        return $this;
    }
}