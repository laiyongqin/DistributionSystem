<?php

/**
 * 权限控制
 * Class System_Right
 */

class System_Right {

    private static $_db;

    /**
     * 根据Uri获取菜单信息
     *
     * @param $uri
     * @return bool
     */
	public static function getMeunInfoByUri($uri) {
        self::$_db = Db_LinkMySQL::get('www');

        $urlArr = explode('/', $uri);
        $url    = "{$urlArr[1]}/";

        $rows = self::$_db->select('m_id, m_name')->from('t_menus')->where("m_url like '{$url}%' ")->fetchOne();
        return isset($rows) ? $rows : FALSE;
    }

    /**
     * 检查是否有菜单权限
     *
     * @param $uid     用户ID
     * @param $mid     菜单ID
     * @return bool
     */
	public static function checkRight($uid , $mid) {
        $rows = self::$_db->select('m_ids')->from('t_right')->where('u_id', $uid)->fetchValue();
        if(!$rows) return FALSE;

        $menuMids = explode(',', $rows);
        if(in_array($mid, $menuMids)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}