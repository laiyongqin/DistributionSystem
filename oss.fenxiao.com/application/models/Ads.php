<?php

/**
 * 广告管理
 *
 * @author: lindexin
 * @since : 2016/07/18
 */

class AdsModel extends BaseModel {

    public $_field = 'a_id,a_title, a_alias ,a_picture,a_link,a_status,a_addtime';
    public function __construct()
    {
        parent::__construct('www', 't_ad', 'a_id');
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

        if(isset($where['title']) && $where['title']){
            $this->_db->where("a_title like '%{$where['title']}%'");
        }

        if(isset($where['status']) && $where['status']){
            $this->_db->where('a_status', $where['status']);
        }

        if ( isset($where['ids']) AND $where['ids'] ){
            $this->_db->where("a_id IN({$where['ids']})");
        }
        return $this;
    }


    /**
     * 获取广告ID=>广告名的列表
     * @access public
     *
     * @return array
     */
    public function getAdMapByDomain() {
        $data   = $this->getAd(array('status'=>1));

        $new    = array();
        foreach($data AS $row) {
            $new[ $row['a_id'] ] = $row['a_title'];
        }
        return $new;
    }

    /**
     * 排序条件式SQL查询
     * @access private
     *
     * @param  array  $order   条件式
     * @return $this
     */
    private function _setOrderSQL ($order = array()) {
        foreach ( $order AS $sortname => $sortorder) {
            $sortorder = strtoupper($sortorder);
            $sortorder = in_array($sortorder, array('ASC', 'DESC') ) ? $sortorder : 'DESC';

            switch ($sortname) {
                case 'a_id':
                case 'a_createtime':
                case 'a_status':
                case 'a_stat':
                    $this->_db_go->order( $sortname, $sortorder );
                    break;
            }
        }
        return $this;
    }

    /**
     * 根据条件式，排序，分页，读取广告
     * @access public
     *
     * @param  array  $condition   条件式
     * @param  array  $order       排序式
     * @param  array  $pagination  分页式
     * @return array|FALSE
     */
    public function getAd($condition=array(), $order=array(), $pagination=array()) {

        $this->_setWhereSQL($condition)
            ->_setOrderSQL($order)
            ->_setPaginationSQL($pagination)
            ->_db
            ->select($this->_field)
            ->from('t_ad');

        if ( FALSE === $data = $this->_db->fetchAll() ) {
            return FALSE;
        }
        return $data;
    }






}