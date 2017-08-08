<?php

/**
 * 上传
 *
 * @author: moxiaobai
 * @since : 2016/1/29 17:24
 */

class UploadController extends BaseController {

    public function pictureAction() {
        $api = new Qiniu_Api('img');

        $params = array('category'=>'property', 'file'=>$_FILES['upload']);
        $ret = $api->uploadImg($params);

        if($ret['code'] == 1) {
            Helper_Json::formJson($ret['data'], 'y');
        } else {
            Helper_Json::formJson($ret['msg'], 'n');
        }
    }

    public function editorAction() {
        $callback= isset($_GET['callback']) ? $_GET['callback'] : '';
        if(isset($_FILES)){
            $api    = new Qiniu_Api('img');
            $params = array('category'=>'news', 'file'=>$_FILES['upfile']);
            $ret    = $api->uploadImg($params);

            if(1 == $ret['code']) {
                $info = array(
                    "originalName" => $_FILES['upfile']['name'] ,
                    "name"         => $ret['data']['fileName'] ,
                    "url"          => $ret['data']['url'] ,
                    "size"         => $_FILES['upfile']['size'] ,
                    "type"         => '.jpg',
                    "state"        => $ret['msg']
                );

                //返回数据
                if($callback) {
                    echo '<script>'.$callback.'('.json_encode($info).')</script>';
                } else {
                    echo json_encode($info);
                }
                exit;
            }
        }
    }
}