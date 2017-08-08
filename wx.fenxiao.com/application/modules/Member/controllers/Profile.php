<?php

/**
 * 个人资料
 *
 * @author: lindexin
 * @since : 2016/08/20
 */

class ProfileController extends BaseController {

    private $_model;

    public function init() {
        $this->_model = $this->loadModel('Member');
        $this->initViewPath();

    }

    /**
     * 上传用户头像
     */
//    public function uploadAction($dir = 'avatar/') {
//        $data = $_POST['image'];
//        preg_match("/data:image\/(.*);base64,/", $data, $res);
//        $ext = $res[1];
//        if(!in_array($ext, array('jpeg','jpg','png','gif'))){
//            Helper_Json::formJson('请上传图片');
//        }
//
//        $file = time() .'.'. $ext;
//        $newfilepath = APP_UPLOAD_DIR . $dir . $file;
//        $data = preg_replace("/data:image\/(.*);base64,/", '', $data);
//        if(file_put_contents($newfilepath, base64_decode($data)) == false){
//            Helper_Json::formJson('上传失败');
//        }else{
//            $data = array(
//                'status' => 1,
//                'msg'    => 'SUCCESS',
//                'file'   =>	$dir . $file,
//                'path'   => $newfilepath,
//                'dir'	 => $dir,
//                'http'	 => APP_IMAGE_URL.$dir.$file
//            );
//
//            Helper_Json::formJson($data, 'y');
//        }
//    }

    //个人资料
    public function indexAction() {
        $this->initPageTitle("个人资料");

        $data  = $this->_model->getInfo(M_ID);

        $this->getView()->assign(array(
            'data' =>$data,
            'nav'          => 3
        ));
    }
}