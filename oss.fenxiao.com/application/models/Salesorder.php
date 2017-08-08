<?php

/**
 * 订单管理模块
 *
 * @author: lindexin
 * @since : 2016/08/15
 */

class SalesorderModel extends BaseModel {

    private $_field;
    public function __construct(){
        parent::__construct('www', 't_sales_order', 'so_id');
        $this->_field = 'so_id,m_id,so_spokesman,so_order_no,so_money,so_type,so_addtime,so_updatetime';
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
            ->order('so_addtime', 'DESC')
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
            $this->_db->where("so_order_no", $where['orderSn']);
        }

        if (isset($where['mid']) AND $where['mid']) {
            $this->_db->where("m_id", $where['mid']);
        }


        if (isset($where['tid']) AND $where['tid']) {
            $this->_db->where("so_type", $where['tid']);
        }

        if (isset($where['endTime']) AND $where['endTime']) {
            $this->_db->where("so_addtime  <= '" . $where['endTime'] . "'");
        }

        if(isset($where['startTime']) AND $where['startTime']) {
            $this->_db->where("so_addtime  >= '" . $where['startTime'] . "'");
        }

        return $this;
    }


}