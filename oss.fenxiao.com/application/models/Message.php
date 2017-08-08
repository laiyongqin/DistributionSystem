<?php

/**
 * 微信自定义菜单
 *
 * @auther monyyip
 * @since  2016-08-18
 */

class MessageModel extends BaseModel {
    public function __construct(){
        parent::__construct('www', 't_weixin_message', 'wm_id');
    }

    public function getList($where = array(), $pagination = array()){
        return $this->_setWhereSQL($where)->_setPaginationSQL($pagination)
                    ->_db->select('wm_id,wm_key,wm_title,wm_content,wm_memo,wm_status,wm_addtime')
                    ->from($this->_table)
                    ->order($this->_primary_key, 'DESC')
                    ->fetchAll();
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
        if(isset($where['status']) && $where['status']){
            $this->_db->where('wm_status', $where['status']);
        }

        return $this;
    }

    public function getInfo($id = 0){
        return $this->_db->select('wm_id,wm_key,wm_title,wm_content,wm_memo,wm_status')->from($this->_table)->where($this->_primary_key, $id)->fetchOne();
    }

    public function saveData($data, $id=0) {
        if($id){
            return $this->_db->update($this->_table)->rows($data)->where($this->_primary_key, $id)->execute();
        }else{
            $data['wm_addtime'] = date('Y-m-d H:i:s');
            return $this->_db->insert($this->_table)->rows($data)->execute();
        }
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
     * 根据Key获取内容
     *
     * @param $key
     * @return mixed
     */
    private function getContentBykey($key) {
        return $this->_db->select('wm_content')->from('t_weixin_message')->where('wm_key', $key)->fetchValue();
    }

    // 替换
    public function rebuildMessage($key, $params = array()){
        $content = $this->getContentBykey($key);
        if(!empty($params)){
            foreach($params as $key => $val){
                $content = str_replace('{' . $key . '}', $val, $content);
            }
        }

        return $content;
    }

    /**
     * 发送文本消息
     *
     * @param $openId   OpenId
     * @param $content  发送内容
     * @return array
     */
    public function sendTextMessage($openId, $content) {
        $data = array(
            'touser'   => $openId,
            'msgtype'  => "text",
            'text'     => array('content'=>$content)
        );

        $weixin = new Open_Weixin_Auth;
        return $weixin->sendCustomMessage($data);
    }

}