<?php

/**
 * 个人资料
 *
 * @author: moxiaobai
 * @since : 2016/4/19 20:33
 */


class DataController extends BaseController {

    private $_memberModel;

    //初始化
    private function init(){
        $this->isAjaxRequest();
        $this->isLogin();
        Yaf_Dispatcher::getInstance()->disableView();

        $this->_memberModel = $this->loadModel('Member',array(),'Member');
    }

    /**
     * 上传用户头像
     */
    public function uploadAction($dir = 'company/') {
        $data = $_POST['image'];
        preg_match("/data:image\/(.*);base64,/", $data, $res);
        $ext = $res[1];
        if(!in_array($ext, array('jpeg','jpg','png','gif'))){
            Helper_Json::formJson('请上传图片');
        }

        $file = time() .'.'. $ext;
        $newfilepath = APP_UPLOAD_DIR . $dir . $file;
        $data = preg_replace("/data:image\/(.*);base64,/", '', $data);
        if(file_put_contents($newfilepath, base64_decode($data)) == false){
            Helper_Json::formJson('上传失败');
        }else{
            $data = array(
                'status' => 1,
                'msg'    => 'SUCCESS',
                'file'   =>    $dir . $file,
                'path'   => $newfilepath,
                'dir'     => $dir,
                'http'     => IMAGE_URL.$dir.$file
            );

            Helper_Json::formJson($data, 'y');
        }
    }

    //保存资料
    public function saveAction() {
        $data  = $this->getRequest()->getPost();

        if(empty($data['m_username'])){
            Helper_Json::formJson('登陆账号不能为空');
        }
        if (preg_match("/[\x7f-\xff]/", $data['m_username'])) {
            Helper_Json::formJson('登陆账号不能含有中文');
        }

        //判断账号是否存在
        $userName = $this->_memberModel->getUserName($data['m_username'],M_ID);
        if($data['m_username'] == $userName){
            Helper_Json::formJson('账户名已存在,请换一个试试');
        }

        //新旧密码
        $row   = $this->_memberModel->getInfo(M_ID);
        if(empty($row['m_username']) && empty($row['m_password'])){
            //第一次填写
            if(empty($data['m_password'])){
                Helper_Json::formJson('登陆密码不能为空');
            }else{
                $data['m_password'] = $this->_memberModel->setMd5Password($data['m_password']);
            }
        }else{
            //修改密码
            if(empty($data['old_password'])){
                Helper_Json::formJson('原始密码不能为空');
            }
            if(empty($data['new_password'])){
                Helper_Json::formJson('新密码不能为空');
            }
            if($data['old_password'] == $data['new_password']){
                Helper_Json::formJson('原始密码和新密码一样,请修改');
            }

            $newPassword = $this->_memberModel->setMd5Password($data['old_password']);
            if($row['m_password'] !=$newPassword){
                Helper_Json::formJson('原始密码不正确~！');
            }else{
                $data['m_password'] = $this->_memberModel->setMd5Password($data['new_password']);
            }
        }

        unset($data['new_password']);
        unset($data['old_password']);
        $this->_memberModel->saveData($data,M_ID);
        Helper_Json::formJson('修改成功', 'y');
    }
}