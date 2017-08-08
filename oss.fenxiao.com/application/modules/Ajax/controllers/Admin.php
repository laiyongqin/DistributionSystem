<?php

/**
 * 小区管理员
 *
 * @author: moxiaobai
 * @since : 2016/2/1 17:19
 */

class AdminController extends BaseController
{

    //初始化
    public function init()
    {
        $this->isAjaxRequest();
        $this->isLogin();
        Yaf_Dispatcher::getInstance()->disableView();
    }

    //新增保存数据
    public function saveAction() {
        $id  = intval( $_POST['id'] );

        // 基本数据过滤
        $data  = $this->getRequest()->getPost();

        unset($data['id']);
        if($id > 0) {
            $result = AdminModel::getInstance()->saveData($data, $id);
        } else {
            $result = AdminModel::getInstance()->saveData($data);
        }
        $this->eachJson($result);

    }

    //更改状态
    public function statusAction($id, $status) {
        $id = intval($id);
        if( empty($id) ) {
            Helper_Json::formJson('缺失参数');
        }

        $status  = ($status == 1) ? 2: 1;
        $data     = array('a_status'=>$status);
        $result   = AdminModel::getInstance()->changeData($id,$data);
        if($result) {
            Helper_Json::formJson('操作成功', 'y');
        } else {
            Helper_Json::formJson('操作失败');
        }
    }

    //修改密码
    public function editPasswordAction() {
        $id       = intval( $_POST['id'] );
        $password = $_POST['password'];

        AdminModel::getInstance()->editPassword($id, $password);
        Helper_Json::formJson('修改成功', 'y');
    }
}