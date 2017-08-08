<?php

/**
 * 菜单管理
 *
 * @author moxiaobai
 * @since  2015-3-20
 */

class MenuController extends BaseController {

    private $M_menu;

	public function init() {
        parent::init();
        $this->checkRight(A_ID, A_ROLE);
        $this->M_menu = new MenuModel();
	}
	
	/**
	 * 首页
	 */
	public function indexAction() {
        $this->initPageTitle('菜单管理');

        $mid    = isset($_GET['mid']) ? $_GET['mid'] : '';
        $name   = isset($_GET['nameSearch']) ? $_GET['nameSearch'] : '';
        $parent = isset($_GET['menuSearch']) ? $_GET['menuSearch'] : 0;

        $menuList = $this->M_menu->getMenuList();

        $topList  = $this->M_menu->getTopMenu();

        $where  = array('mid'=>$mid, 'm_name'=>$name, 'm_parent_id'=>$parent);
        $list   = $this->M_menu->getMenu($where);

        $this->getView()->assign(array(
            'topList'   => $topList,
            'menuList'  => $menuList,
            'list'      => $list,
            'mid'       => $mid,
            'name'      => $name,
            'parent'    => $parent
        ));
	}

	//表单
    public function formAction($id=0) {

        $id  = intval($id);
        if ( $id > 0 ) {
            $row = $this->M_menu->getMenuById($id);
            if ( ! $row['m_id'] ) {
                Helper_Json::formJson('参数错误');
            }

            if ( isset( $row['m_id'] ) ) {
                $this->getView()->assign('row', $row);
            }
        } else {
            $row = array('m_id'=>'', 'm_name'=>'','m_url'=>'','m_tag'=>'','m_order'=>'','m_parent_id'=>0);
            $this->getView()->assign('row', $row);
        }

        $menuList = $this->M_menu->getMenuList();

        $topList  = $this->M_menu->getTopMenu();
        $this->getView()->assign("topList", $topList);
        $this->getView()->assign("menuList", $menuList);
    }


    /**
     * 删除记录
     */
    public function deleteAction($id=0) {
        if ( ! $id )
            Helper_Json::formJson('参数错误');

        if ( $this->M_menu->deleteMenu( $id ) ) {
            Helper_Json::formJson('删除成功', 'y');
        }
        
        Helper_Json::formJson('删除失败');
    }


    /**
     * 更新菜单缓存
     */
    public function refreshAction() {
        $this->M_menu->refreshMenu();
        Helper_Json::formJson('更新成功', 'y');
    }
}