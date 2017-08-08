<?php

/**
 * 自动完成订单
 *
 * @author: moxiaobai
 * @since : 2016/8/19 11:01
 */

class ConfirmOrderModel extends BaseModel
{

    public function __construct()
    {
        parent::__construct('www', 't_order', 'o_id');
    }

    /**
     * 获取已经完成的普通订单
     *
     * @return mixed
     */
    public function getCompleteOrder() {
        $expireTime  = ConfigModel::getInstance()->getValueByKey('auto_complete_order');
        if(!$expireTime) {
            return false;
        }

        $currentTime = date('Y-m-d H:i:s', strtotime("-{$expireTime} days"));

        $rows =  $this->_db->select('o_id')
                        ->from('t_order')
                        ->where("o_updatetime < '{$currentTime}'")
                        ->where("o_order_status", 2)
                        ->where('o_pay_status', 3)
                        ->fetchAll();


        if($rows === FALSE) {return FALSE;}
        return Helper_Array::setIdsKey($rows, 'o_id');
    }

    /**
     * 获取订单列表
     *
     * @param $order
     * @return bool
     */
    public function getConfirmOrder($order) {
        $ids = Helper_Array::setIds($order, 'o_id', TRUE);
        if ( ! $ids) {return array();}

        $result = $this->_db->select('o_id')->from('t_order_auto_complete')->where("o_id IN({$ids})")->fetchAll();
        if ( $result === FALSE ) {return array();}

        return Helper_Array::setIdsKey($result, 'o_id');
    }

    /**
     * 获取订单信息
     *
     * @param $id  订单ID
     * @return bool
     */
    public function getOrderInfo() {
        $row =  $this->_db->select('oac_id,o_id')
                    ->from('t_order_auto_complete')
                    ->where('oac_status', 1)
                    ->order("oac_id", "ASC")
                    ->limit(1)
                    ->fetchOne();
        if($row === FALSE) return FALSE;

        return $row;
    }

    /**
     * 添加确认订单
     *
     * @param $oid      订单ID
     * @return mixed
     */
    public function addConfirmOrder($oid) {
        $rows = array(
            'o_id'            => $oid,
            'oac_addtime'     => date('Y-m-d H:i:s')
        );

        return $this->_db->insert('t_order_auto_complete')->rows($rows)->execute();
    }

    /**
     * 更新订单状态
     *
     * @param $id     订单ID
     * @return mixed
     */
    public function updateOrderStatus($oid) {
        $rows = array(
            'oac_status'      => 2,
            'oac_updatetime'  => date('Y-m-d H:i:s')
        );

        return $this->_db->update('t_order_auto_complete')->rows($rows)->where('o_id', $oid)->execute();
    }
}