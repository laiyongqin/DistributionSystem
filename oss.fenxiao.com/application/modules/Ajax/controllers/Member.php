<?php

/**
 * 用户管理
 *
 * @author: lindexin
 * @since : 2016/07/11
 */

class MemberController extends BaseController
{

    //初始化
    public function init()
    {
        $this->isAjaxRequest();
        $this->isLogin();
        Yaf_Dispatcher::getInstance()->disableView();
    }

    //更改状态
    public function statusAction($id, $status) {
        $id = intval($id);
        if( empty($id) ) {
            Helper_Json::formJson('缺失参数');
        }

        $status  = ($status == 1) ? 2: 1;
        $data     = array('m_status'=>$status);
        $result   = MemberModel::getInstance()->changeData($id,$data);
        if($result) {
            Helper_Json::formJson('操作成功', 'y');
        } else {
            Helper_Json::formJson('操作失败');
        }
    }

    //修改密码
    public function editPasswordAction() {
        $id       = intval( $_POST['id'] );
        $password = Helper_Secret::encode($_POST['password']);

        MemberModel::getInstance()->editPassword($id, $password);
        Helper_Json::formJson('修改成功', 'y');
    }

    //查看密码
    public function checkPasswordAction() {

        $password = $_POST['password'];

        $data = Helper_Secret::decode($password);
        Helper_Json::formJson($data, 'y');
    }

    //新增保存数据
    public function saveAction() {
        $id  = intval( $_POST['id'] );

        // 基本数据过滤
        $data  = $this->getRequest()->getPost();
        unset($data['id']);
        if($id > 0) {
            $result = MemberModel::getInstance()->saveData($data, $id);
        } else {
            $result = MemberModel::getInstance()->saveData($data);
        }
        $this->eachJson($result);

    }
}