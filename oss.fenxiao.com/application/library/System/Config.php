<?php
/**
 * 微信配置
 *
 * @author: moxiaobai
 * @since : 2016/8/24 10:39
 */

class System_Config {

    /**
     * 根据Uri获取菜单信息
     *
     * @param $uri
     * @return bool
     */
    public static function initWeixinConfig() {
        $db = Db_LinkMySQL::get('www');

        $rows = $db->select('wc_appid,wc_appsecret,wc_apptoken,wc_mch_id,wc_pay_key,wc_sslcert_path,wc_sslkey_path')->from('t_weixin_config')->fetchOne();
        if($rows) {
            /* 微信配置 */
            define('APP_ID',     $rows['wc_appid']);
            define('APP_SECRET', $rows['wc_appsecret']);
            define('TOKEN',      $rows['wc_apptoken']);
            define('MCH_ID',     $rows['wc_mch_id']);
            define('MCH_KEY',    $rows['wc_pay_key']);
        }
    }
}