<?php

/**
 * 商品套餐模块
 *
 * @author: lindexin
 * @since : 2016/08/15
 */

class ProductProfileModel extends BaseModel {

    private $_field;
    public function __construct(){
        parent::__construct('www', 't_product_profile', 'pp_id');
        $this->_field = 'pp_id,p_id,pt_id,pp_name,pp_stock,pp_sales,pp_editTime,pp_addTime';
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

    public function getInfo($id){
        return $this->_db->select($this->_field)->from($this->_table)->where($this->_primary_key, $id)->fetchOne();
    }

    /**
     * @param $ppids
     * @param $num 大于0表示扣库存
     * @return mixed
     */
    public function updateStock($ppids, $num){
        if($num > 0){
            return $this->_db->update($this->_table)->set('pp_stock', '-' . $num, true)->where('pp_id in(' . $ppids . ')')->where('pp_stock >= ' . $num)->execute();
        }else{
            return $this->_db->update($this->_table)->set('pp_stock', abs($num), true)->where('pp_id in(' . $ppids . ')')->execute();
        }

    }

    /**
     * 修改销量
     *
     * @param $id
     * @param $num 大于0表示增加销量
     */
    public function updateSales($ppids, $num){
        if($num < 0){
            return $this->_db->update($this->_table)->set('pp_sales', $num, true)->where('pp_id in(' . $ppids . ')')->where('pp_sales >= ' . abs($num))->execute();
        }else{
            return $this->_db->update($this->_table)->set('pp_sales', $num, true)->where('pp_id in(' . $ppids . ')')->execute();
        }
    }
}