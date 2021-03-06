<?php

/**
 * 支付明细
 *
 * @author: monyyip
 * @since : 2016/08/17
 */

class WithdrawModel extends BaseModel {

    private $_field;
    public function __construct(){
        parent::__construct('www', 't_pay_withdraw', 'pw_id');
        $this->_field = 'pw_id, m_id,pw_money,pw_status,pw_addtime,pw_updatetime';
    }

    /**
     * 获取数据列表
     *
     * @param array $where       搜索条件
     * @param array $pagination  分页信息
     * @return mixed
     */
    public function getList($where=array(), $pagination = array()) {
        $data = $this->_setWhereSQL($where)
            ->_setPaginationSQL($pagination)
            ->_db->select($this->_field)
            ->from($this->_table)
            ->order($this->_primary_key, 'DESC')
            ->fetchAll();

        if ( !$data) {
            return $data;
        }

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

    public function deleteOrder($where = array()){
        return $this->_setWhereSQL($where)->_db->delete($this->_table)->from($this->_table)->execute();
    }

    /**
     * SQL分页查询
     */
    protected  function _setPaginationSQL( $pagination = array() ) {
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
     *
     * @param array $where
     * @return $this
     */
    private function _setWhereSQL ($where = array()) {
        if (isset($where['endTime']) AND $where['endTime']) {
            $this->_db->where("pw_addtime  <= '" . $where['endTime'] . "'");
        }

        if(isset($where['startTime']) AND $where['startTime']) {
            $this->_db->where("pw_addtime  >= '" . $where['startTime'] . "'");
        }


        return $this;
    }


    /**
     * 通过id 获得单条数据
     * @param $id 订单id
     * @return miexd
     */
    public function getInfo($id){
        return $this->_db->select($this->_field)->from($this->_table)->where($this->_primary_key,$id)->fetchOne();
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
     * 更新状态
     *
     * @param $id
     * @param $status
     * @return mixed
     */
    public function updateStatus($id, $status) {
        $rows = array(
            'pw_status'      => $status,
            'pw_updatetime'  => date('Y-m-d H:i:s')
        );
        return $this->_db->update($this->_table)->where($this->_primary_key,$id)->rows($rows)->execute();
    }
}