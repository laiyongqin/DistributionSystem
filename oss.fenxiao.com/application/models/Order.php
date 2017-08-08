<?php

/**
 * 订单管理模块
 *
 * @author: lindexin
 * @since : 2016/08/15
 */

class OrderModel extends BaseModel {

    private $_field;
    public function __construct(){
        parent::__construct('www', 't_order', 'o_id');
        $this->_field = 'o_id,o_order_no,m_id,p_id,p_title,pp_ids,pp_title,p_price,o_number,o_order_amount,o_payment_amount,o_award_amount,o_pay_status,o_order_status,o_addtime,o_updatetime,o_express_company,o_express_number,o_memo,o_close_remark';
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
            ->order('o_id', 'DESC')
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
        if (isset($where['title']) AND $where['title']) {
            $this->_db->where("p_title like '%{$where['title']}%'");
        }

        if (isset($where['orderSn']) AND $where['orderSn']) {
            $this->_db->where("o_order_no", $where['orderSn']);
        }

        if (isset($where['psid']) AND $where['psid']) {
            $this->_db->where("o_pay_status", $where['psid']);
        }

        if (isset($where['osid']) AND $where['osid']) {
            $this->_db->where("o_order_status", $where['osid']);
        }

        if (isset($where['endTime']) AND $where['endTime']) {
            $this->_db->where("o_updatetime  <= '" . $where['endTime'] . "'");
        }

        if(isset($where['startTime']) AND $where['startTime']) {
            $this->_db->where("o_updatetime  >= '" . $where['startTime'] . "'");
        }


        return $this;
    }


    /**
     * 整合信息
     *
     * @param $data
     * @return mixed
     */
    public function mergData($data,$key='o_id') {
        if ( ! is_array( $data ) )
            return $data;

        $ids = Helper_Array::setIds($data, $key, TRUE);
        if ( ! $ids) {return $data;}

        //订单信息
        $info = $this->_db->select('o_id', 'o_pay_status','o_payTime','o_price','o_order_sn','p_title')->from($this->_table)->where("o_id IN({$ids})")->fetchAll();
        if ( $info === FALSE ) {return $data;}

        $info = Helper_Array::setIdsKey($info, 'o_id');

        foreach ( $data AS &$row ) {
            $row['o_pay_status']   = isset($info[ $row[$key] ]) ? $info[ $row[$key] ]['o_pay_status'] : '';
            $row['o_payTime']   = isset($info[ $row[$key] ]) ? $info[ $row[$key] ]['o_payTime'] : '';
            $row['o_price']   = isset($info[ $row[$key] ]) ? $info[ $row[$key] ]['o_price'] : '';
            $row['o_order_sn']   = isset($info[ $row[$key] ]) ? $info[ $row[$key] ]['o_order_sn'] : '';
            $row['p_title']   = isset($info[ $row[$key] ]) ? $info[ $row[$key] ]['p_title'] : '';
        }
        return $data;
    }

    /**
     * 通过id 获得单条数据
     * @param $id 订单id
     * @return miexd
     */
    public function getInfo($id){
        return $this->_db->select($this->_field)->from($this->_table)->where('o_id',$id)->fetchOne();
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
     * 统计当天下单数
     * @return mixed
     */
    public function countOrder() {
        return $this->_db->select('COUNT(*)')
                ->from($this->_table)
                ->where('o_pay_status', 3)
                ->where("date(o_addtime) = curdate()")
                ->fetchValue();
    }

    /**
     * 统计当天销售金额
     * @return mixed
     */
    public function countSalesMoney() {
        return $this->_db->select('sum(o_payment_amount)')
            ->from($this->_table)
            ->where('o_pay_status', 3)
            ->where("date(o_addtime) = curdate()")
            ->fetchValue();
    }
}