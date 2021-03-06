<?php

/**
 * 产品管理
 *
 * @author: monyyip
 * @since : 2016/08/13
 */

class ProductModel extends BaseModel {

    public $_field = 'p_id, pc_id ,p_title,p_cover,p_rate,p_stock,p_content,p_original_price,p_sales,p_event_price,p_sort,p_status,p_updateTime,p_addTime';
    public function __construct()
    {
        parent::__construct('www', 't_product', 'p_id');
    }

     /**
     * 获取列表
     *
     * @param array $where
     * @param array $pagination
     * @return bool
     */
    public function getList($where=array(), $pagination=array(), $field = '') {
        $data = $this->_setWhereSQL($where)
                    ->_setPaginationSQL($pagination)
                    ->_db->select($field ? $field : $this->_field)
                    ->from($this->_table)
                    ->order('p_sort', 'ASC')
                    ->fetchAll();

        if ( $data === FALSE ) return FALSE;
        return $data;
    }

    /**
     * @param $id
     */
    public function getInfo($id) {
        return $this->_db->select($this->_field)->from($this->_table)->where($this->_primary_key, $id)->fetchOne();
    }

    /**
     * 增加库存
     * @param $id 商品id
     * @param $num 大于0表示扣库存
     * @return mixed
     */
    public function updateStock($id, $num){
        if($num > 0){
            return $this->_db->update($this->_table)->where($this->_primary_key, $id)->where('p_stock >= ' . $num)->set('p_stock', '-' . $num, true)->execute();
        }else{
            return $this->_db->update($this->_table)->where($this->_primary_key, $id)->set('p_stock', abs($num), true)->execute();
        }

    }

    /**
     * 修改销量
     *
     * @param $id
     * @param $num 大于0表示增加销量
     */
    public function updateSales($id, $num){
        if($num < 0){
            return $this->_db->update($this->_table)->where($this->_primary_key, $id)->where('p_sales >= ' . abs($num))->set('p_sales', $num, true)->execute();
        }else{
            return $this->_db->update($this->_table)->where($this->_primary_key, $id)->set('p_sales', $num, true)->execute();
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

        if(isset($where['pid']) && $where['pid']){
            $this->_db->where('pc_id', $where['pid']);
        }

        if(isset($where['status']) && $where['status']){
            $this->_db->where('p_status', $where['status']);
        }

        if(isset($where['name']) && $where['name']){
            $this->_db->where('p_title like "%' . $where['name'] . '%"');
        }

        return $this;
    }

}