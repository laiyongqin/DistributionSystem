<?php

/**
 * 用户提现模型
 *
 * @author: lindexin
 * @since : 2016/8/20
 */

class PaywithdrawModel extends BaseModel
{
    private $_field;
    public function __construct()
    {
        parent::__construct('www', 't_pay_withdraw', 'pw_id');
        $this->_field = 'pw_id,m_id,pw_money,pw_status,pw_addtime,pw_updatetime';
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

        if(isset($where['mid']) && $where['mid']){
            $this->_db->where('m_id', $where['mid']);
        }
        return $this;
    }

    /**
     * 获得单日提现次数
     * @param $mid 用户id
     * @return $this
     */
    public function getDayCount($mid) {
        return $this->_db->select('COUNT(*)')->from($this->_table)->where('m_id', $mid)->where("date(pw_addtime) = curdate()")->fetchValue();
    }


}