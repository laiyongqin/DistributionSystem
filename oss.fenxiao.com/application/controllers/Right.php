<?php

/**
 * 权限分配
 *
 * @author lindexin
 * @since  2015-08-12
 */

class RightController extends BaseController {

    public function init() {
        parent::init();
        $this->checkRight(A_ID, A_ROLE);

		$this->M_menu  = new MenuModel();
		$this->M_admin = new AdminModel();
		$this->M_right = new RightModel();
    }


	public function indexAction() {
        $this->initPageTitle('权限管理');

		$uid         = isset($_GET['uid']) ? intval($_GET['uid']) : 0;
		$topMenuList = $this->M_menu->getTopMenu();
		$userOptions = Helper_Form::option( $this->M_right->getRightUserMap(), $uid, '请选择员工');

		if ( $uid > 0 ) {
			$menuList = $this->M_menu->getMenuList();
			$right = $this->M_right->getRight($uid);
			$right = $right === FALSE ? array() : explode(',', $right);

			$this->getView()->assign("right", $right);
			$this->getView()->assign("topMenuList", $topMenuList);
			$this->getView()->assign("menuList", $menuList);
		} else {
            $this->getView()->assign("right", "");
            $this->getView()->assign("topMenuList", "");
            $this->getView()->assign("menuList", "");
        }
		$this->getView()->assign("userOptions", $userOptions);
	}
	
	public function saveAction() {
		$uid     = intval($_POST['uid']);
		$right   = $_POST['right'];

		$this->M_right->saveRight($uid, $right);
		Helper_Json::formJson('权限分发成功', 'y');
	}
}