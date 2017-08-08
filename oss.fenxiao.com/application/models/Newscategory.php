<?php

/**
 * 分类管理
 *
 * @author: lindexin
 * @since : 2016/07/06
 */

class NewscategoryModel extends BaseModel {

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

    public function getListArr(){
        $arr = array();
        $res = $this->_db->select('nc_id,nc_name')->from('t_news_category')->fetchAll();
        if($res){
            foreach($res as $val){
                $arr[$val['nc_id']] = $val['nc_name'];
            }
        }

        return $arr;
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
        );

        $categoryList = $this->getList($where);

        if($categoryList){
            foreach($categoryList as $val){
                $data[$val['nc_id']] = $pre . $val['nc_name'];
                $this->getListByPid($val['nc_id'], $data, "&nbsp;&nbsp;&nbsp;" .$pre);
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

        if(isset($where['pid']) ){
            $this->_db->where('nc_parent_id', $where['pid']);
        }

        if(isset($where['name']) && $where['name']){
            $this->_db->where("nc_name like '%{$where['name']}%'");
        }

        if(isset($where['status']) && $where['status']){
            $this->_db->where('nc_status', $where['status']);
        }


        return $this;
    }

    /**
     * 是否别名存在
     */
    public function isTrueName($cname) {
        return $this->_db->select('COUNT(*)')->from($this->_table)->where('nc_alias', $cname)->fetchValue();
    }

    public function getCateIdByTag($tag = ''){
        return $this->_db->select('nc_id')->from('t_news_category')->where('nc_alias',$tag)->fetchValue();
    }


}