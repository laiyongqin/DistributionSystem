<?php

/**
 * 新闻管理
 *
 * @author: monyyip
 * @since : 2016/08/20
 */

class NewsModel extends BaseModel {

    public $_field = 'n_id,nc_id,n_title,n_des,n_cover,n_content,n_sort,n_status,n_addtime,n_recommend';
    public function __construct()
    {
        parent::__construct('www', 't_news', 'n_id');
    }

     /**
     * 获取列表
     *
     * @param array $where
     * @param array $pagination
     * @return bool
     */
    public function getList($where=array(), $pagination=array(), $field = '') {
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
     * @param $id
     */
    public function getInfo($id) {
        return $this->_db->select($this->_field)->from($this->_table)->where($this->_primary_key, $id)->fetchOne();
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
        $nc_id = $this->loadModel('NewsCategory', array(), 'Mall')->getIdByAlias('help');
        $this->_db->where("nc_id != $nc_id");

        if(isset($where['nc_id'])  && $where['nc_id']){
            $this->_db->where('nc_id', $where['nc_id']);
        }

        if(isset($where['status']) && $where['status']){
            $this->_db->where('n_status', $where['status']);
        }

        if(isset($where['name']) && $where['name']){
            $this->_db->where('n_title like "%' . $where['name'] . '%"');
        }

        return $this;
    }

}