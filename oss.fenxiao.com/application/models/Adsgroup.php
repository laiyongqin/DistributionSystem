<?php

/**
 * 广告组管理
 *
 * @author: lindexin
 * @since : 2016/07/18
 */

class AdsgroupModel extends BaseModel {

    public $_field = 'ag_id,ag_name, ag_cname ,ag_addtime,a_ids';
    public function __construct()
    {
        parent::__construct('www', 't_ad_group', 'ag_id');
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
            $data['ag_addtime'] = date('Y-m-d H:i:s');
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
            $this->_db->where("ag_name like '%{$where['title']}%'");
        }
        if ( isset($where['ids']) AND $where['ids'] ) {
            $this->_db->where("ag_id IN({$where['ids']})");
        }

        return $this;
    }


    /**
     * 通过id读取广告组
     */
    public function getAdgroupById($id) {
        $data = $this->getAdgroup( array('ids'=>$id) );
        return isset($data[0]) ? $data[0] : FALSE;
    }

    /**
     * 是否广告组别名存在
     */
    public function isGroupCNameExist($cname) {
        return $this->_db->select('COUNT(*)')->from('t_ad_group')->where('ag_cname', $cname)->fetchValue();
    }



    /**
     * 读取广告组
     */
    public function getAdgroup($where=array(), $pagination=array() ) {
        $data = $this->_setWhereSQL($where)
            ->_setPaginationSQL($pagination)
            ->_db->select('ag_id', 'ag_name', 'a_ids', 'ag_cname')
            ->from('t_ad_group')
            ->order('ag_addtime', 'DESC')
            ->fetchAll();

        if($data === FALSE) {
            return FALSE;
        }
        return $data;
    }


}