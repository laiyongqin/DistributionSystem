<?php

/**
 * 关键字编辑
 *
 * @auther monyyip
 * @since  2016-3-28
 */

class KeywordsModel extends BaseModel {
    public function __construct(){
        parent::__construct('www', 't_weixin_keywords', 'k_id');
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
     * @param array $where
     * @return $this
     */
    private function _setWhereSQL ($where = array()) {
        if (isset($where['ktype']) AND $where['ktype']) {
            $this->_db->where("{$this->_table}.k_type", $where['ktype']);
        }

//        if (isset($where['krtype']) AND $where['krtype']) {
//            $this->_db->where("{$this->_table}.k_rtype", $where['krtype']);
//        }

        if (isset($where['kstatus']) AND $where['kstatus']) {
            $this->_db->where("{$this->_table}.k_status", $where['kstatus']);
        }

        if(isset($where['ktitle']) AND $where['ktitle']){
            $this->_db->where("{$this->_table}.k_title like '%{$where['ktitle']}%' OR {$this->_table}.k_keys like '%{$where['ktitle']}%'");
        }

//        if(isset($where['kbeginTime']) AND $where['kbeginTime']){
//            $this->_db->where("{$this->_table}.k_beginTime > '{$where['kbeginTime']}'");
//        }
//
//        if(isset($where['kendTime']) AND $where['kendTime']){
//            $this->_db->where("{$this->_table}.k_endTime < '{$where['kendTime']}'");
//        }

        return $this;
    }

    /**
     * 查询所有关键字
     */
    public function getAllKeywords($where, $pagination) {
        $data = $this->_setWhereSQL($where)->_setPaginationSQL($pagination)->_db
            ->select('k_id','k_title','k_keys','k_type','k_content','k_url','addtime', 'k_status','k_thumb')->from($this->_table)->order($this->_primary_key,'ASC')->fetchAll();
        $allData =array();
        if($data){
            foreach($data as $v){
                $v['addtime'] = date('Y-m-d',strtotime($v['addtime']));
                $allData[]      = $v;
            }
        }

        return $allData;
    }

    public function getKeywordInfo($where){
        $data = $this->_setWhereSQL($where)->_db
            ->select('k_id','k_title','k_keys','k_type','k_content','k_url','addtime', 'k_status','k_thumb')->from($this->_table)->fetchOne();
        return $data ? $data : FALSE;
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
     * 删除事件新闻
     */
    public function deleteKeywords($id){
        return $this->_db->update($this->_table)->from($this->_table)->rows(array('k_status' => -1))->where('k_id',$id)->execute();
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
     * 根据id获取关键字
     * @param $id
     * @return bool
     */
    public function getKeywordsById($id) {
        $row = $this->_db->select('k_id','k_title','k_keys','k_type','k_content','k_url','addtime', 'k_status','k_thumb')
            ->from($this->_table)
            ->where($this->_primary_key, $id)
            ->fetchOne();

        return isset($row) ? $row : FALSE;
    }

    /**
     * 根据关键字获取关键字
     * @param $id
     * @return bool
     */
    public function getKeywordsByKey($key) {
        $row = $this->_db->select('k_id','k_title','k_keys','k_type','k_content','k_url','addtime', 'k_status','k_thumb')
            ->from($this->_table)
            ->where('k_keys', $key)
            ->fetchOne();

        return isset($row) ? $row : FALSE;
    }

    /**
     * 新增，编辑关键字
     * @param $data
     * @param int $id
     * @return mixed
     */
    public function saveKeywords($data, $id=0) {
        if ( $id > 0 ) {
            return $this->_db->update($this->_table)->rows($data)->where('k_id', $id)->execute();
        } else {
            $data['addtime'] = date('Y-m-d H:i:s');
            return $this->_db->insert($this->_table)->rows($data)->execute();
        }
    }

}