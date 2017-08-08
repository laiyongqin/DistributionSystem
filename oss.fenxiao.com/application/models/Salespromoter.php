<?php

/**
 * 推荐人管理
 *
 * @author: lindexin
 * @since : 2016/1/29 10:36
 */

class SalespromoterModel extends BaseModel {

    private $_field;
    public function __construct()
    {
        parent::__construct('www', 't_sales_promoter', 'sp_id');
        $this->_field = 'sp_id,m_id,sp_spokesman,sp_addtime,sp_status';
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
            ->order('sp_addtime', 'DESC')
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
        if (isset($where['mid']) AND $where['mid']) {
            $this->_db->where("m_id", $where['mid']);
        }

        if (isset($where['endTime']) AND $where['endTime']) {
            $this->_db->where("sp_addtime  <= '" . $where['endTime'] . "'");
        }

        if(isset($where['startTime']) AND $where['startTime']) {
            $this->_db->where("sp_addtime  >= '" . $where['startTime'] . "'");
        }
        return $this;
    }



    /**
     * 整合信息
     *
     * @param $data
     * @return mixed
     */
    public function mergData($data,$key='sp_id') {
        if ( ! is_array( $data ) )
            return $data;

        $ids = Helper_Array::setIds($data, $key, TRUE);
        if ( ! $ids) {return $data;}

        //订单信息
        $info = $this->_db->select('sp_id', 'sp_spokesman')->from($this->_table)->where("sp_id IN({$ids})")->where('sp_status',1)->fetchAll();
        if ( $info === FALSE ) {return $data;}

        $info = Helper_Array::setIdsKey($info, 'sp_id');

        foreach ( $data AS &$row ) {
            $row['sp_spokesman']   = isset($info[ $row[$key] ]) ? $info[ $row[$key] ]['sp_spokesman'] : '';
            $row['sp_id']   = isset($info[ $row[$key] ]) ? $info[ $row[$key] ]['sp_id'] : '';
        }
        return $data;
    }

}