<?php

/**
 * 分销推广员表
 *
 * @author: monyyip
 * @since : 2016/08/19
 */

class SalesPromoterModel extends BaseModel {

    public $_field = 'sp_id, m_id ,sp_spokesman,sp_addtime';
    public function __construct()
    {
        parent::__construct('www', 't_sales_promoter', 'sp_id');
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
                    ->order($this->_primary_key, 'DESC')
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

    public function getInfoBySpoke($spoke = 0){
        return $this->_db->select($this->_field)->from($this->_table)->where('sp_spokesman', $spoke)->where('sp_status', 1)->fetchOne();
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
        if(isset($where['spokesman']) && $where['spokesman']){
            $this->db->where('sp_spokesman', $where['spokesman']);
        }

        if (isset($where['mid']) AND $where['mid']) {
            $this->_db->where('m_id', $where['mid']);
        }

        if (isset($where['smid']) AND $where['smid']) {
            $this->_db->where('sp_spokesman', $where['smid']);
        }
        return $this;
    }

    /**
     * 通过mid获得用户信息
     * @param $mid 用户mid
     */
    public function getMidInfo($mid){
        return $this->_db->select($this->_filed)->from($this->_table)->where('m_id',$mid)->where('sp_status',1)->fetchValue();
    }

    /**
     * 通过下家id获得上家信息
     * @param $id 用户id
     */
    public function getMid($id){
        return $this->_db->select('m_id')->from($this->_table)->where('sp_spokesman',$id)->where('sp_status',1)->fetchValue();
    }

    /*
     * 统计下家数量
     * @param $mid 用户mid
     */
    public function countPromoter($mid){
        return $this->_db->select('count(*)')->from($this->_table)->where('m_id',$mid)->where('sp_status',1)->fetchValue();
    }
    /**
     * 通过上家id获得下家信息
     * @param $mid 用户mid
     */
    public function getPromoter($mid){
        $data = $this->_db->select('sp_spokesman')->from($this->_table)->where('m_id',$mid)->where('sp_status',1)->fetchAll();
        if(!$data){
            return $data;
        }
        return $data;
    }

    /**
     * 添加推广人
     *
     * @param $mid
     * @param $spokesman
     * @return bool
     */
    public function addPromoter($mid, $spokesman) {
        if($mid == 0) {return false;}

        $ret = $this->_db->select('sp_id')->from('t_sales_promoter')->where('m_id', $mid)->where('sp_spokesman', $spokesman)->fetchValue();
        if(!$ret) {
            $data = array(
                'm_id'         => $mid,
                'sp_spokesman' => $spokesman,
                'sp_addtime'   => date('Y-m-d H:i:s')
            );

            $this->_db->insert('t_sales_promoter')->rows($data)->execute();

            return true;
        } else {
            return false;
        }
    }
}