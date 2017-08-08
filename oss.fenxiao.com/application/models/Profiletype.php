<?php

/**
 * 分类管理
 *
 * @author: lindexin
 * @since : 2016/07/06
 */

class ProfiletypeModel extends BaseModel {

    public $_field = 'pt_id, pt_name ,pt_status,pt_addtime';
    public function __construct()
    {
        parent::__construct('www', 't_profile_type', 'pt_id');
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
                    ->order($this->_primary_key, 'ASC')
                    ->fetchAll();

        if ( $data === FALSE ) return FALSE;
        return $data;
    }

    public function getTypeList($where = array()){
        $data = $this->_setWhereSQL($where)
            ->_db->select($this->_field)
            ->from($this->_table)
            ->order($this->_primary_key, 'ASC')
            ->fetchAll();

        if ( $data === FALSE ) return FALSE;
        $result = array();
        foreach($data as $val){
            $result[$val['pt_id']] = $val['pt_name'];
        }

        return $result;
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
        if(isset($where['status']) && $where['status']){
            $this->_db->where('pt_status', $where['status']);
        }

        if(isset($where['name']) && $where['name']){
            $this->_db->where('pt_name like "%' . $where['name'] . '%"');
        }

        return $this;
    }

    /**
     * 整合信息
     *
     * @param $data
     * @return mixed
     */
    public function mergData($data,$key='pt_id') {
        if ( ! is_array( $data ) )
            return $data;

        $ids = Helper_Array::setIds($data, $key, TRUE);
        if ( ! $ids) {return $data;}

        //订单信息
        $info = $this->_db->select('pt_id', 'pt_name')->from($this->_table)->where("pt_id IN({$ids})")->where('pt_status',1)->fetchAll();
        if ( $info === FALSE ) {return $data;}

        $info = Helper_Array::setIdsKey($info, 'pt_id');

        foreach ( $data AS &$row ) {
            $row['pt_id']   = isset($info[ $row[$key] ]) ? $info[ $row[$key] ]['pt_id'] : '';
            $row['pt_name']   = isset($info[ $row[$key] ]) ? $info[ $row[$key] ]['pt_name'] : '';
        }
        return $data;
    }

}