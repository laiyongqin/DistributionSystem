<?php

/**
 * 分类管理
 *
 * @author: lindexin
 * @since : 2016/07/06
 */

class CategoryModel extends BaseModel {

    public $_field = 'pc_id, pc_pid ,pc_img,pc_name,pc_alise,pc_order,pc_status';
    public function __construct()
    {
        parent::__construct('www', 't_product_category', 'pc_id');
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
                    ->order('pc_order', 'ASC')
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
     * 通过父分类获得所有子类
     *
     * @param string $p_id
     * @param array $data
     * @return array
     */
    public function getListByPid($p_id = 0,&$data = array(), $pre = '+--'){
        $where = array(
            'pid' => $p_id,
            'status' => 1,
        );

        $categoryList = $this->getList($where);
        if($categoryList){
            foreach($categoryList as $val){
                $data[$val['pc_id']] = $pre . $val['pc_name'];
                $this->getListByPid($val['pc_id'], $data, "&nbsp;&nbsp;&nbsp;" .$pre);
            }
        }

        return $data;
    }

    public function getCategory(){
        $categoryList = $this->_db->select('pc_id,pc_name')->from('t_product_category')->fetchAll();

        $data = array();
        if($categoryList){
            foreach($categoryList as $val){
                $data[$val['pc_id']] = $val['pc_name'];
            }
        }

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
        if(isset($where['pid'])){
            $this->_db->where('pc_pid', $where['pid']);
        }

        if(isset($where['status']) && $where['status']){
            $this->_db->where('pc_status', $where['status']);
        }

        if(isset($where['name']) && $where['name']){
            $this->_db->where('pc_name like "%' . $where['name'] . '%"');
        }

        return $this;
    }



}