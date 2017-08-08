<?php

/**
 * 菜单模型
 *
 * @author: moxiaobai
 * @since : 2015/3/20 14:38
 */

class MenuModel extends BaseModel {

    private $_rightDb;
    private $_top_menu;
    private $_sub_menu;

    public function __construct() {
        parent::__construct('www', 't_menus', 'm_id');
        $this->_rightDb    =  new RightModel();

        $this->_top_menu    = null;
        $this->_sub_menu    = null;
        $this->initMenu();
    }

    //初始化菜单
    public function initMenu() {
        if ( ! is_array( $this->_top_menu ) OR empty( $this->_top_menu) ) {
            $this->_top_menu = $this->initCacheTopMenu();


        }

        if ( ! is_array( $this->_sub_menu ) OR empty( $this->_sub_menu) ) {
            $this->_sub_menu = $this->initCacheSubMenu();
        }
    }

    //一级菜单
    public function initCacheTopMenu() {
        $data = $this->_db->select('m_id', 'm_name', 'm_url', 'm_tag')
                        ->from('t_menus')
                        ->where('m_parent_id = 0 and m_status = 1')
                        ->order('m_order', 'ASC')
                        ->fetchAll();

        $data = Helper_Array::setIdsKey($data, 'm_id');
        return $data;
    }

    //二级菜单
    public function initCacheSubMenu($pid = 0) {
        $row = $this->_db->select('m_id', 'm_parent_id', 'm_name', 'm_url', 'm_tag')
                    ->from('t_menus')
                    ->where('m_status = 1')
                    ->where('m_parent_id', $pid)
                    ->order('m_order', 'ASC')
                    ->fetchAll();

        if(empty($row)){
            return FALSE;
        }

        $data = array();
        foreach($row as $val){
            $data[$val['m_id']] = $val;
        }

        foreach($data as $key => $val){
            $son = $this->initCacheSubMenu($val['m_id']);
            $data[$val['m_id']]['son'] = $son;
        }

        return $data;
    }

    /**
     *
     */
    public function getArray(){
        $result = $this->_db->select('m_id', 'm_parent_id', 'm_name', 'm_url', 'm_tag')
                ->from('t_menus')
                ->where('m_status = 1')
                ->order('m_parent_id', 'ASC')
                ->order('m_order', 'ASC')
                ->fetchAll();

        $data = array();
        if( $result ) {
            foreach ( $this->_top_menu AS $row ) {
                $list= array();
                $id = $row['m_id'];
                foreach ($result as $key => $val) {
                    if($val['m_parent_id'] == $id) {
                        $list[$val['m_id']]['m_id']   = $val['m_id'];
                        $list[$val['m_id']]['m_name'] = $val['m_name'];
                        $list[$val['m_id']]['m_url']  = $val['m_url'];
                        $list[$val['m_id']]['m_tag']  = $val['m_tag'];
                    }

                    foreach ($list as $k => $v) {
                        if($v['m_id'] == $val['m_parent_id']) {
                            $list[$k]['child'][$key] = $val;
                        }
                    }

                }
                $data[$id] = $list;

            }
        }

        return $data;
    }

    /**
     * 根据菜单ID获取菜单信息
     * @param $id
     * @return mixed
     */
    public function getMenuById($id) {
        return  $this->_db->select('m_id','m_parent_id','m_name','m_url','m_tag','m_status','m_addtime','m_order','m_memo')
                            ->from('t_menus')
                            ->where('m_status = 1')
                            ->where('m_id', $id)
                            ->fetchOne();
    }

    /**
     * 根据搜索条件获取菜单信息
     *
     * @param array $where
     * @return mixed
     */
    public function getMenu($where=array()) {
        $this->_db->where('m_status = 1');

        if ( isset($where['m_name']) && $where['m_name']) {
            $this->_db->where("m_name", $where['m_name']);
        }

        if ( isset($where['mid']) && $where['mid']) {
            $this->_db->where("m_id", $where['mid']);
        }

        if ( isset($where['m_parent_id'])) {
            $this->_db->where("m_parent_id", $where['m_parent_id']);
        }

        return $this->_db->select('m_id','m_parent_id','m_name','m_url','m_tag','m_status','m_addtime','m_order','m_memo')
                    ->from('t_menus')
                    ->order('m_order', 'ASC')
                    ->fetchAll();
    }

    /**
     * 保存菜单
     *
     * @param $data
     * @param int $id
     * @return mixed
     */
    public function saveMenu($data, $id=0){
        if ( $id > 0 ) {
            return $this->_db->update('t_menus')->rows($data)->where('m_id', $id)->execute();
        } else {
            return $this->_db->insert('t_menus')->rows($data)->execute();
        }
    }

    /**
     * 获取顶级菜单列表
     */
    public function getTopMenu() {
        return $this->_top_menu;
    }

    /**
     * 根据项目ID获取二级列表
     */
    public function getMenuList($id=0) {
        return isset($this->_sub_menu[$id]) ? $this->_sub_menu[$id] : $this->_sub_menu;
    }

    /**
     * 获得与父类名称拼接的字符
     */
    public function makeMergeName($id,$current='') {
        $row = $this->getMenuById($id);
        if(!$row) {
            return $current;
        }
        if(0 < $row['m_parent_id']) {
            $current = $this->makeMergeName($row['m_parent_id'],$current);
        }
        $data = empty($current) ? $row['m_name'] : $current . ' / ' . $row['m_name'];

        return $data;
    }

    public function mergeMenuUrl($data) {
        if ( ! is_array( $data ) )
            return $data;

        $ids = Helper_Array::setIds($data, 'm_id', TRUE);

        if ( ! $ids)
            return $data;

        $menus = $this->_db->select('m_id', 'm_url')->from('t_menus')->where("m_id IN({$ids})")->fetchAll();
        if ( $menus === FALSE )
            return $data;

        $menus = Helper_Array::setIdsKey($menus, 'm_id');
        foreach ( $data AS &$row ) {
            $row['m_url']   = isset($menus[ $row['m_id'] ]) ? $menus[ $row['m_id'] ]['m_url'] : '';
        }
        return $data;
    }

    public function getRightTopMenu() {
        $rightMenu = $this->_rightDb->getRight(A_ID);
        $rightMenu = explode(',', $rightMenu);

        $top_menu = $this->_top_menu;

        foreach( $this->_sub_menu AS $top_id => $top) {
            $has_in = FALSE;
            foreach ( $top AS $second ) {
                if ( ! isset( $second['child'] ) )
                    continue;

                foreach ( $second['child'] AS $menu) {
                    in_array( $menu['m_id'], $rightMenu ) && $has_in = TRUE;
                }
            }

            if ( ! $has_in ) {
                unset( $top_menu[$top_id] );
            }

        }
        return $top_menu;
    }

    public function getRightMenuList($id=0) {
        $rightMenu = $this->_rightDb->getRight(A_ID);
        $rightMenu = explode(',', $rightMenu);
        $menuList = $this->getMenuList($id);

        foreach ($menuList AS $f_id => &$second) {
            if ( ! isset($second['son']) )
                continue;
            $has_in = FALSE;
            foreach ( $second['son'] AS $parent_id => $menu ) {
                if ( in_array( $menu['m_id'] , $rightMenu ) ) {
                    $has_in = TRUE;
                } else {
                    unset( $second['son'][$parent_id] );
                }
            }

            //若持有权限在三级菜单都不存在，删除二级菜单
            if ( ! $has_in ) {
                unset($menuList[ $f_id] );
            }
        }
        return $menuList;
    }

    /**
     * 根据菜单名称获取菜单ID
     *
     * @param $name
     * @return mixed
     */
    public function getMidByName($name) {
        return $this->_db->select('m_id')->from('t_menus')->where('m_name', $name)->fetchValue();
    }

    public function getMidByUrl($url){
        return $this->_db->select('m_id')->from('t_menus')->where('m_url', $url)->fetchValue();
    }

    /**
     * 删除菜单
     * @param $id
     * @return bool
     */
    public function deleteMenu($id) {
        return $this->_db->update('t_menus')->rows( array('m_status' => 2) )->where("m_id", $id)->execute();
    }
}