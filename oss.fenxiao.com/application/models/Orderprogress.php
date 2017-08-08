<?php

/**
 * 订单进度模块
 *
 * @author: lindexin
 * @since : 2016/08/15
 */

class OrderprogressModel extends BaseModel {

    private $_field;
    public function __construct(){
        parent::__construct('www', 't_order_progress', 'op_id');
        $this->_field = 'op_id,o_id,op_memo,op_addtime';
    }

    /*
   * 通过订单id获得对应信息
   * @param $id 订单id
   * @return array
   */
    public function getAllInfo($id){

        $data = $this->_db->select($this->_field)->from($this->_table)->where('o_id',$id)->order('op_addtime','DESC')->fetchAll();
        if(!$data){
            return $data;
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

}