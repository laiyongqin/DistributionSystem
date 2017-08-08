<?php

/**
 * 支付明细
 *
 * @author: monyyip
 * @since : 2016/08/17
 */

class PaymentModel extends BaseModel {

    private $_field;
    public function __construct(){
        parent::__construct('www', 't_pay_payment', 'pp_id');
        $this->_field = 'pp_id, m_id,pp_order_no,pp_transaction_id,pp_money,pp_addtime';
    }

    /**
     * 获取数据列表
     *
     * @param array $where       搜索条件
     * @param array $pagination  分页信息
     * @return mixed
     */
    public function getList($where=array(), $pagination = array()) {
        $data = $this->_setWhereSQL($where)
            ->_setPaginationSQL($pagination)
            ->_db->select($this->_field)
            ->from($this->_table)
            ->order($this->_primary_key, 'DESC')
            ->fetchAll();

        if ( !$data) {
            return $data;
        }

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

    public function deleteOrder($where = array()){
        return $this->_setWhereSQL($where)->_db->delete($this->_table)->from($this->_table)->execute();
    }

    /**
     * SQL分页查询
     */
    protected  function _setPaginationSQL( $pagination = array() ) {
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
     * @param array $where
     * @return $this
     */
    private function _setWhereSQL ($where = array()) {
        if (isset($where['orderSn']) AND $where['orderSn']) {
            $this->_db->where("pp_order_no", $where['orderSn']);
        }

        if (isset($where['endTime']) AND $where['endTime']) {
            $this->_db->where("pp_addtime  <= '" . $where['endTime'] . "'");
        }

        if(isset($where['startTime']) AND $where['startTime']) {
            $this->_db->where("pp_addtime  >= '" . $where['startTime'] . "'");
        }


        return $this;
    }


    /**
     * 通过id 获得单条数据
     * @param $id 订单id
     * @return miexd
     */
    public function getInfo($id){
        return $this->_db->select($this->_field)->from($this->_table)->where($this->_primary_key,$id)->fetchOne();
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

}