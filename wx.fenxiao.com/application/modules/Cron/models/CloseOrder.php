<?php

/**
 * 自动关闭订单
 *
 * @author: moxiaobai
 * @since : 2016/8/19 11:41
 */


class CloseOrderModel extends BaseModel
{

    public function __construct()
    {
        parent::__construct('www', 't_order', 'o_id');
    }

    /**
     * 收集过期的订单
     * @return array|bool
     */
    public function getExpireOrder() {
        $expireTime  = ConfigModel::getInstance()->getValueByKey('auto_cancle_order');
        if(!$expireTime) {
            return false;
        }

        $expireTime  = $expireTime * 60;
        $currentTime = date('Y-m-d H:i:s', strtotime("-{$expireTime} minutes"));

        $rows =  $this->_db->select('o_id')
                            ->from('t_order')
                            ->where('o_pay_status', 1)
                            ->where("o_addTime < '{$currentTime}'")
                            ->order("o_id", "ASC")
                            ->fetchAll();
        if($rows === FALSE)  return FALSE;
        return Helper_Array::setIdsKey($rows, 'o_id');
    }

    /**
     * 获取订单列表
     *
     * @param $order
     * @return bool
     */
    public function getCloseOrder($order) {
        $ids = Helper_Array::setIds($order, 'o_id', TRUE);
        if ( ! $ids) {return array();}

        $result = $this->_db->select('o_id')->from('t_order_auto_close')->where("o_id IN({$ids})")->fetchAll();
        if ( $result === FALSE ) {return array();}

        return Helper_Array::setIdsKey($result, 'o_id');
    }

    /**
     * 查询订单信息
     *
     * @param $id
     * @return mixed
     */
    public function getOrderInfo() {
        $row =  $this->_db->select('oac_id,o_id')
                         ->from('t_order_auto_close')
                         ->where('oac_status', 1)
                         ->order("oac_id", "ASC")
                         ->limit(1)
                         ->fetchOne();
        if($row === FALSE) return FALSE;

        return $row;
    }

    /**
     * 添加关闭订单
     *
     * @param $oid      订单ID
     * @return mixed
     */
    public function addCloseOrder($oid) {
        $rows = array(
            'o_id'         => $oid,
            'oac_addtime'  => date('Y-m-d H:i:s')
        );

        return $this->_db->insert('t_order_auto_close')->rows($rows)->execute();
    }

    /**
     * 更新订单状态
     *
     * @param $id
     * @return mixed
     */
    public function updateOrderStatus($oid) {
        $rows = array(
            'oac_status'     => 2,
            'oac_updatetime' => date('Y-m-d H:i:s')
        );

        return $this->_db->update('t_order_auto_close')->rows($rows)->where('o_id', $oid)->execute();
    }
}