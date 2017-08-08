<?php

/**
 * 商品套餐模块
 *
 * @author: lindexin
 * @since : 2016/08/15
 */

class ProductprofileModel extends BaseModel {

    private $_field;
    public function __construct(){
        parent::__construct('www', 't_product_profile', 'pp_id');
        $this->_field = 'pp_id,p_id,pt_id,pp_name,pp_stock,pp_cost,pp_original_price,pp_event_price,pp_sales,pp_editTime,pp_addTime,pp_status';
    }

    /*
   * 通过订单id获得对应信息
   * @param $id 订单id
   * @return array
   */
    public function getAllInfo($id){

        $data = $this->_db->select($this->_field)->from($this->_table)->where('p_id',$id)->order('pp_addTime','DESC')->fetchAll();
        if(!$data){
            return $data;
        }
        return $data;
    }

}