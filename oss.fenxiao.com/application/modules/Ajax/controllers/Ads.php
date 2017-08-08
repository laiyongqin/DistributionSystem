<?php

/**
 * 广告管理
 *
 * @author: lindexin
 * @since : 2016/08/15
 */

class AdsController extends BaseController
{

    private $_model;

    //初始化
    public function init()
    {
        $this->isAjaxRequest();
        $this->isLogin();
        $this->_model    = new AdsModel();
        Yaf_Dispatcher::getInstance()->disableView();
    }

    public function saveAction(){
        $post = $this->getRequest()->getPost();
        $id = intval($post['id']);

        unset($post['file']);
        unset($post['id']);

        if($post['a_alias']==''){
            $post['a_alias'] = 'banner'.strtotime(date('Y-m-d'));
        }

        if($id){
            $msg = '修改';
            $ret = $this->_model->saveData($post, $id);
        }else{
            $msg = '添加';
            $post['a_addtime'] = date('Y-m-d H:i:s');
            $ret = $this->_model->saveData($post);
        }

        if($ret){
            Helper_Json::formJson($msg . '成功', 'y');
        }else{
            Helper_Json::formJson($msg . '失败');
        }
    }
}