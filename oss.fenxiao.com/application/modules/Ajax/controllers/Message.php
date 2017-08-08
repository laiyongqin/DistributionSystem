<?php

/**
 * 微信自定义菜单
 *
 * @author: monyyip
 * @since : 2016/08/16
 */

class MessageController extends BaseController
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
            $result = MessageModel::getInstance()->saveData($data, $id);
            $msg = '修改';
        } else {
            $result = MessageModel::getInstance()->saveData($data);
            $msg = '添加';
        }

        if($result){
            Helper_Json::formJson($msg . '成功', 'y');
        }else{
            Helper_Json::formJson($msg . '失败');
        }
    }

    //更改状态
    public function statusAction($id, $status) {
        $id = intval($id);
        if( empty($id) ) {
            Helper_Json::formJson('缺失参数');
        }

        $status  = ($status == 1) ? 2: 1;
        $data     = array('wm_status'=>$status);
        $result   = MessageModel::getInstance()->saveData($data, $id);
        if($result) {
            Helper_Json::formJson('操作成功', 'y');
        } else {
            Helper_Json::formJson('操作失败');
        }
    }

}