<?php

/**
 * 七牛上传接口
 *
 * @author: moxiaobai
 * @since : 2015/8/21 14:37
 */

require_once 'autoload.php';

use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

define('ACCESS_KEY', 'Xu2Xh5-zq4YCWs3GQOc-NwFAx3tKogVv3mBX_L_L');
define('SECRET_KEY', 'xfkjg0UJYv1E_scnRJgfSG2LMnuqZdhHkxN9eWth');

class Qiniu_Api {

    private $_auth;
    private $_token;
    private $_bucket;
    private $_domain;

    private $_zone   = array(
        'img'   => array('zone'=>'huibao',   'domain'=>'7xw2p1.com1.z0.glb.clouddn.com')
    );

    private $_site   = array('news');

    /**
     * 初始化获取token
     */
    public function __construct($zone='img') {
        if(!array_key_exists($zone, $this->_zone)) {
            throw new Exception('空间不存在');
        }
        //设置空间
        $this->_bucket = $this->_zone[$zone]['zone'];
        $this->_domain = $this->_zone[$zone]['domain'];

        //获取token
        $this->_auth  = new Auth(ACCESS_KEY, SECRET_KEY);
        $this->_token = $this->_auth->uploadToken($this->_bucket);
    }


    /**
     * 上传图片
     *
     * @param $params   array('category'=>'www', 'file'=>$return['path']);
     * @return string
     * @throws Exception
     */
    public function uploadImg($params) {
        $site        = isset($params['category']) ? $params['category'] : '';
        $file        = isset($params['file']) ? $params['file'] : '';

        if(!in_array($site, $this->_site)) {
            return $this->result(101, '站点不存在');
        }

        //文件后缀
        $suffix   = explode('.', $file['name']);
        $ext      = strtolower( array_pop( $suffix ) );
        $fileName = "{$site}/" . date('Ymd') . "/" .$this->uniqid() . ".{$ext}";

        $uploadMgr = new UploadManager();
        $ret = $uploadMgr->putFile($this->_token, $fileName, $file['tmp_name']);
        if($ret[0]) {
            $key = $ret[0]['key'];
            $url = "http://$this->_domain/" . $ret[0]['key'];

            return $this->result(1, 'SUCCESS', $key, $url);
        } else {
            return $this->result(101, 'ERROR');
        }
    }

    /**
     * 返回信息
     *
     * @param integer $code
     * @param string  $msg
     * @param string  $fileName
     * @param string  $url
     * @return string
     */
    private function result($code, $msg, $fileName='', $url='') {
        $data    = array('fileName'=>$fileName, 'url'=>$url);
        $result  = array(
            'code' => $code,
            'msg'  => $msg,
            'data' => $data
        );

        return $result;
    }

    //生成唯一文件名
    private function uniqid() {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',

            // 32 bits for "time_low"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),

            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,

            // 48 bits for "node"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }
}