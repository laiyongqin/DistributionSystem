<?php

/**
 * 分类管理
 *
 * @author: lindexin
 * @since : 2016/07/06
 */

class NewsCategoryModel extends BaseModel {

    public $_field = 'nc_id, nc_parent_id ,nc_alias,nc_name,nc_sort,nc_status,nc_addtime';
    public function __construct()
    {
        parent::__construct('www', 't_news_category', 'nc_id');
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
                    ->order('nc_sort', 'ASC')
                    ->fetchAll();

        if ( $data === FALSE ) return FALSE;
        return $data;
    }

    /**
     * @param $id
     */
    public function getInfo($id) {
        return $this->_db->select($this->_field)->from($this->_table)->where($this->_primary_key, $id)->fetchOne();
    }

    public function getIdByAlias($alias = ''){
        return $this->_db->select($this->_primary_key)->from($this->_table)->where('nc_alias', $alias)->fetchValue();
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
        if(isset($where['status']) && $where['status']){
            $this->_db->where('nc_status', $where['status']);
        }
        return $this;
    }


}