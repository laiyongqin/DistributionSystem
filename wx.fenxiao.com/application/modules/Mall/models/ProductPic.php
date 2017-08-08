<?php

/**
 * 商品主图管理
 *
 * @author: lindexin
 * @since : 2016/4/13
 */

class ProductPicModel extends BaseModel {
    private $_field;
    public function __construct(){
        parent::__construct('www', 't_product_pic', 'pp_id');
        $this->_field = 'pp_id,p_id,pp_url,pp_order';
    }


    /**
     * 根据id获取关键字
     * @param $id
     * @return bool
     */
    public function getPicById($id) {
        $row = $this->_db->select('pp_id','p_id','pp_url','pp_order')
            ->from($this->_table)
            ->where('p_id', $id)
            ->order('pp_order', 'ASC')
            ->fetchAll();
        return isset($row) ? $row : FALSE;
    }

    /**
     * 通过id获得图片
     *
     * @param array $id
     * @return mixed
     */
    public function getAllPic($id){

        return $this->_db->select('pp_url')->from('t_product_pic')->where('p_id', $id)->fetchAll();
    }
}