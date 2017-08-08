<?php

/**
 * 分类管理
 *
 * @author: lindexin
 * @since : 2016/07/06
 */

class CategoryModel extends BaseModel {

    public function __construct()
    {
        parent::__construct('www', 't_product_category', 'pc_id');
    }

    public function getCategory(){
        $data = array();

        $categoryList = $this->_db->select('pc_id,pc_name')->from('t_product_category')->where('pc_status',1)->order('pc_order', 'ASC')->fetchAll();
        if($categoryList){
            foreach($categoryList as $val){
                $data[$val['pc_id']] = $val['pc_name'];
            }
        }

        return $data;
    }
}