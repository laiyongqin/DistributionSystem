<?php

/**
 * 微信公众号配置
 *
 * @auther monyyip
 * @since  2016-08-15
 */

class SubconfigModel extends BaseModel {
    public function __construct(){
        parent::__construct('www', 't_weixin_config', 'wc_id');
    }


    public function getInfo(){
        return $this->_db->select('wc_id,wc_appid,wc_appsecret,wc_apptoken,wc_mch_id,wc_pay_key,wc_sslcert_path,wc_sslkey_path')->from($this->_table)->fetchOne();
    }

    public function saveData($data, $id=0) {
        if($id){
            return $this->_db->update($this->_table)->rows($data)->where($this->_primary_key, $id)->execute();
        }else{
            return $this->_db->insert($this->_table)->rows($data)->execute();
        }
    }
}