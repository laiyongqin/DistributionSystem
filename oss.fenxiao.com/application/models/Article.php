<?php

/**
 * 单个文章管理
 *
 * @author: lindexin
 * @since : 2016/08/16
 */

class ArticleModel extends BaseModel {

    public $_field = 'a_id,a_title,a_content,a_status,a_addtime,a_desc';
    public function __construct()
    {
        parent::__construct('www', 't_article', 'a_id');
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
     * @param $id
     */
    public function getInfo($id) {
        return $this->_db->select($this->_field)->from($this->_table)->where($this->_primary_key, $id)->fetchOne();
    }
    /**
     * 统计数量
     *
     * @param array $where
     */
    public function countData($where=array()) {
        return $this->_setWhereSQL($where)->_db->select('COUNT(*)')->from($this->_table)->fetchValue();
    }

    public function delete($id){
        return $this->_db->delete($this->_table)->where($this->_primary_key, $id)->execute();
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
        if(isset($where['title']) && $where['title']){
            $this->_db->where("a_title like '%{$where['title']}%'");
        }

        if(isset($where['status']) && $where['status']){
            $this->_db->where('a_status', $where['status']);
        }

        return $this;
    }

}