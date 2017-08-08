<?php

/**
 * 分销明细
 *
 * @author: monyyip
 * @since : 2016/08/19
 */

class SalesOrderModel extends BaseModel {

    public $_field = 'so_id, m_id ,so_spokesman,so_order_no,so_money,so_type,so_addtime,so_updatetime';
    public function __construct()
    {
        parent::__construct('www', 't_sales_order', 'so_id');
    }

     /**
     * 获取列表
     *
     * @param array $where
     * @param array $pagination
     * @return bool
     */
    public function getList($where=array(), $pagination=array()) {
        $data = $this->_setWhereSQL($where)
                    ->_setPaginationSQL($pagination)
                    ->_db->select($this->_field)
                    ->from($this->_table)
                    ->order($this->_primary_key, 'DESC')
                    ->fetchAll();

        if ( $data === FALSE ) return FALSE;
        return $data;
    }


    /**
     * 统计数量
     *
     * @param array $where
     */
    public function countData($where=array()) {
        return $this->_setWhereSQL($where)->_db->select('COUNT(*)')->from($this->_table)->fetchValue();
    }

    /**
     * @param $id
     */
    public function getInfo($id) {
        return $this->_db->select($this->_field)->from($this->_table)->where($this->_primary_key, $id)->fetchOne();
    }

    /**
     * 保存数据
     *
     * @param array $data
     * @param int   $id
     * @return mixed
     */
    public function saveData($data, $id=0) {
        if($id){
            return $this->_db->update($this->_table)->rows($data)->where($this->_primary_key, $id)->execute();
        }else{
            return $this->_db->insert($this->_table)->rows($data)->execute();
        }
    }


    /**
     * SQL分页查询
     */
    private function _setPaginationSQL( $pagination = array() ) {
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
     * @param array $where
     * @return $this
     */
    private function _setWhereSQL ($where = array()) {
        if(isset($where['mid']) && $where['mid']){
            $this->_db->where('m_id', $where['mid']);
        }
        if(isset($where['smid']) && $where['smid']){
            $this->_db->where('m_id', $where['smid']);
        }

        if(isset($where['type']) && $where['type']){
            if($where['type']==1){
                $this->_db->where('so_type', 1);
            }else{
                $this->_db->where('so_type != 1');
            }
        }
        return $this;
    }

    /**
     * 更新订单状态
     *
     * @param $orderNo  订单号
     * @param $status   状态
     * @return mixed
     */
    public function updateOrderStatus($orderNo, $status) {
        $rows = array(
            'so_type'       => $status,
            'so_updatetime' => date('Y-m-d H:i:s')
        );

        return $this->_db->update($this->_table)->where('so_order_no', $orderNo)->rows($rows)->execute();
    }

    /**
     * 移除订单
     *
     * @param $orderNo
     * @return mixed
     */
    public function removeOrder($orderNo) {
        return $this->_db->delete($this->_table)->where('so_order_no', $orderNo)->execute();
    }

    /**
     * 获得用户下单未购买
     */
    public function getAllAlready($mid){
        return $this->_db->select('COUNT(*)')->from($this->_table)->where('m_id',$mid)->where('so_type',1)->fetchValue();
    }

    /**
     * 获得用户下单已购买
     */
    public function getAllEnd($mid){
        return $this->_db->select('COUNT(*)')->from($this->_table)->where('m_id ',$mid)->where('so_type != 1')->fetchValue();
    }

    /**
     * 获得未付款订单金额
     * @param $mid 用户mid
     */
    public function getNoPay($mid){
        return $this->_db->select('sum(so_money)')->from($this->_table)->where('m_id',$mid)->where('so_type',1)->fetchValue();
    }

    /**
     * 获得已付款订单金额
     * @param $mid 用户mid
     */
    public function getGoPay($mid){
        return $this->_db->select('sum(so_money)')->from($this->_table)->where('m_id',$mid)->where('so_type',2)->fetchValue();
    }


    /**
     * 获得确认收货订单金额
     * @param $mid 用户mid
     */
    public function getTake($mid){
        return $this->_db->select('sum(so_money)')->from($this->_table)->where('m_id',$mid)->where('so_type',3)->fetchValue();
    }
}