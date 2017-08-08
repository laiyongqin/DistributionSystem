<?php

/**
 * 配置管理
 *
 * @author: lindexin
 * @since : 2016/08/13
 */

class ConfigModel extends BaseModel {

    public $_field = 'bc_id, bc_type ,bc_title,bc_key,bc_value,bc_sort,bc_addtime';
    public function __construct()
    {
        parent::__construct('www', 't_basic_config', 'bc_id');
    }

     /**
     * 获取配置
     *
     * @param array $where
     * @return bool
     */
    public function getList($where=array()) {
        $data = $this->_setWhereSQL($where)
                    ->_db->select($this->_field)
                    ->from($this->_table)
                    ->order('bc_id', 'ASC')
                    ->fetchAll();

        if ( $data === FALSE ) return FALSE;
        return $data;
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
     * SQL Where条件
     * @param array $where
     * @return $this
     */
    private function _setWhereSQL ($where = array()) {

        if(isset($where['tid']) && $where['tid']){
            $this->_db->where('bc_type', $where['tid']);
        }

        return $this;
    }

}