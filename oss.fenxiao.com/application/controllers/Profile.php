<?php

/**
 * 用户管理
 *
 * @author: lindexin
 * @since : 2016/07/11
 */

class ProfileController extends BaseController {

    private $_pageSize;
    private $_model;
    private $_status = array(1=>'正常',2=>'禁用');

    public function init() {
        $this->checkRight(A_ID, A_ROLE);
        $this->_model = new MemberModel();
        $this->_pageSize = 12;
    }


}