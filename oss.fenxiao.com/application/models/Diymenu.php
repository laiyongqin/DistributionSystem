<?php

/**
 * 微信自定义菜单
 *
 * @auther monyyip
 * @since  2016-08-18
 */

class DiymenuModel extends BaseModel {

    private $_type = array(
        'view'  => '跳转URL',
        'click' => '点击推事件'
    );

    public function __construct(){
        parent::__construct('www', 't_weixin_menu', 'wm_id');
    }

    /**
     * 获取事件类型
     * @return array
     */
    public function getType() {
        return $this->_type;
    }

    public function getList($where = array()){
        return $this->_setWhereSQL($where)
                        ->_db->select('wm_id,wm_pid,wm_type,wm_key,wm_name,wm_status,wm_sort,wm_addtime')
                        ->from($this->_table)
                        ->order('wm_pid', 'ASC')
						->order('wm_sort', 'ASC')
                        ->fetchAll();
    }

    /**
     * 通过父分类获得所有子类
     *
     * @param string $p_id
     * @param array $data
     * @return array
     */
    public function getListByPid($p_id = 0,&$data = array(), $pre = '+--'){
        $where = array('pid' => $p_id, 'status' => 1,);

        $categoryList = $this->getList($where);
        if($categoryList){
            foreach($categoryList as $val){
                $data[$val['wm_id']] = $pre . $val['wm_name'];
                $this->getListByPid($val['wm_id'], $data, "&nbsp;&nbsp;&nbsp;" .$pre);
            }
        }

        return $data;
    }

    public function getMenuMap($pid = 0){
        $where = array('pid' => $pid);

        $categoryList = $this->getList($where);
        $data = array(0 => '一级菜单');
        if($categoryList){
            foreach($categoryList as $val){
                $data[$val['wm_id']] = $val['wm_name'];
            }
        }

        return $data;
    }



    public function getInfo($id = 0){
        return $this->_db->select('wm_id,wm_pid,wm_type,wm_key,wm_name,wm_status,wm_sort')
                        ->from($this->_table)
                        ->where($this->_primary_key, $id)
                        ->fetchOne();
    }

    public function saveData($data, $id=0) {
        if($id){
            return $this->_db->update($this->_table)->rows($data)->where($this->_primary_key, $id)->execute();
        }else{
            $data['wm_addtime'] = date('Y-m-d H:i:s');
            return $this->_db->insert($this->_table)->rows($data)->execute();
        }
    }

    /**
     * 改变状态
     *
     * @param $id
     * @param array $data 修改数据
     * @return mixed
     */
    public function changeData($id, $data) {
        return $this->_db->update($this->_table)->rows($data)->where($this->_primary_key, $id)->execute();
    }

    /**
     * SQL Where条件
     * @param array $where
     * @return $this
     */
    private function _setWhereSQL ($where = array()) {
        if(isset($where['status']) && $where['status']){
            $this->_db->where('wm_status', $where['status']);
        }

        if(isset($where['pid'])){
            $this->_db->where('wm_pid', $where['pid']);
        }

        return $this;
    }
}