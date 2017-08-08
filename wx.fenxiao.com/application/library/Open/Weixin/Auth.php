<?php

/**
 * 验证
 *
 * @author: moxiaobai
 * @since : 2016/2/23 16:12
 */

class Open_Weixin_Auth {

    /* 消息类型常量 */
    const MSG_TYPE_TEXT       = 'text';
    const MSG_TYPE_IMAGE      = 'image';
    const MSG_TYPE_VOICE      = 'voice';
    const MSG_TYPE_VIDEO      = 'video';
    const MSG_TYPE_SHORTVIDEO = 'shortvideo';
    const MSG_TYPE_LOCATION   = 'location';
    const MSG_TYPE_LINK       = 'link';
    const MSG_TYPE_MUSIC      = 'music';
    const MSG_TYPE_NEWS       = 'news';

    /* 二维码类型常量 */
    const QR_SCENE       = 'QR_SCENE';
    const QR_LIMIT_SCENE = 'QR_LIMIT_SCENE';

    private $appId;
    private $appSecret;
    private $accessToken = '';

    /**
     * 微信api根路径
     * @var string
     */
    private $apiURL = 'https://api.weixin.qq.com/cgi-bin';
    /**
     * 微信二维码根路径
     * @var string
     */
    private $qrcodeURL   = 'https://mp.weixin.qq.com/cgi-bin';
    private $oauthApiURL = 'https://open.weixin.qq.com/connect/oauth2/authorize';

    public function __construct() {
        $this->appId       = APP_ID;
        $this->appSecret   = APP_SECRET;
        $this->accessToken = $this->getAccessToken();
    }

    public function getRequestCodeURL($redirect_uri, $state = null, $scope = 'snsapi_base'){
        $query = array(
            'appid'         => $this->appId,
            'redirect_uri'  => $redirect_uri,
            'response_type' => 'code',
            'scope'         => $scope,
        );
        if(!is_null($state) && preg_match('/[a-zA-Z0-9]+/', $state)){
            $query['state'] = $state;
        }
        $query = http_build_query($query);
        return "{$this->oauthApiURL}?{$query}#wechat_redirect";
    }

    /**
     * 获取授权用户信息
     *
     * @param  string $openid 用户的OpenID
     * @param  string $lang   指定的语言
     * @return array          用户信息数据，具体参见微信文档
     */
    public function getUserInfo($openid, $lang = 'zh_CN'){
        $query = array(
            'access_token' => $this->accessToken,
            'openid'       => $openid,
            'lang'         => $lang,
        );
        $info = $this->http("{$this->apiURL}/user/info", $query);
        return json_decode($info, true);
    }

    public function getMedia($media_id) {
        $query = array(
            'access_token' => $this->accessToken,
            'media_id'     => $media_id
        );

        return $this->http("{$this->apiURL}/media/get", $query);
    }

    /**
     * 上传文件
     *
     * @param $type   文件类型
     * @param $file
     * @return mixed
     * @throws Exception
     */
    public function uploadMedia($type, $file) {
        $query = array(
            'access_token' => $this->accessToken,
            'type'         => $type,
        );
        $data = array('media' =>  new CURLFile($file));
        $info = $this->http("{$this->apiURL}/media/upload", $query, $data, 'post');
        return json_decode($info, true);
    }

    /**
     * 创建自定义菜单
     * @param  array $button 符合规则的菜单数组，规则参见微信手册
     */
    public function menuCreate($data){
        return $this->api('menu/create', $data);
    }

    /**
     * 删除菜单
     * @return array
     */
    public function menuDelete() {
        return $this->api('menu/delete');
    }

    /**
     * 发送客服消息
     *
     * @param $data
     * @return array
     */
    public function sendCustomMessage($data) {
        return $this->api('message/custom/send', $data, 'post', '', true);
    }

    /**
     * 发送消息通知模版
     *
     * @param $data
     * @return array
     */
    public function sendMessageTemplate($data) {
        return $this->api('message/template/send', $data);
    }

    /**
     * 创建二维码，可创建指定有效期的二维码和永久二维码
     * @param  integer $scene_id       二维码参数
     * @param  integer $expire_seconds 二维码有效期，0-永久有效
     */
    public function qrcodeCreate($scene_id, $expire_seconds = 0){
        $data = array();
        if(is_numeric($expire_seconds) && $expire_seconds > 0){
            $data['expire_seconds'] = $expire_seconds;
            $data['action_name']    = self::QR_SCENE;
        } else {
            $data['action_name']    = self::QR_LIMIT_SCENE;
        }
        $data['action_info']['scene']['scene_id'] = $scene_id;
        return $this->api('qrcode/create', $data, $method = 'POST', $param = '', true);
    }
    /**
     * 根据ticket获取二维码URL
     * @param  string $ticket 通过 qrcodeCreate接口获取到的ticket
     * @return string         二维码URL
     */
    public function showqrcode($ticket){
        return "{$this->qrcodeURL}/showqrcode?ticket={$ticket}";
    }
    /**
     * 长链接转短链接
     * @param  string $long_url 长链接
     * @return string           短链接
     */
    public function shorturl($long_url){
        $data = array(
            'action'   => 'long2short',
            'long_url' => $long_url
        );
        return $this->api('shorturl', $data, $method = 'POST', $param = '', true);
    }

    //获取access_token
    private function getAccessToken($type = 'client', $code = null) {
        // access_token 应该全局存储与更新，以下代码以写入到文件中做示例
//        $data = json_decode($this->get_php_file("access_token.php"));
//        if ($data->expire_time < time()) {
            $param = array(
                'appid'  => $this->appId,
                'secret' => $this->appSecret
            );
            switch ($type) {
                case 'client':
                    $param['grant_type'] = 'client_credential';
                    $url = "{$this->apiURL}/token";
                    break;
                case 'code':
                    $param['code'] = $code;
                    $param['grant_type'] = 'authorization_code';
                    $url = "{$this->oauthApiURL}/oauth2/access_token";
                    break;

                default:
                    throw new \Exception('不支持的grant_type类型！');
                    break;
            }
            $token = $this->http($url, $param);
            $token = json_decode($token, true);
            if(is_array($token)){
                if(isset($token['errcode'])){
                    throw new \Exception($token['errmsg']);
                }
            } else {
                throw new \Exception('获取微信access_token失败！');
            }

            $access_token = $token['access_token'];
//            if ($access_token) {
//                $data->expire_time  = time() + 7000;
//                $data->access_token = $access_token;
//                $this->set_php_file("access_token.php", json_encode($data));
//            }
//        } else {
//            $access_token = $data->access_token;
//        }
        return $access_token;
    }

    /**
     * 调用微信api获取响应数据
     * @param  string $name   API名称
     * @param  string $data   POST请求数据
     * @param  string $method 请求方式
     * @param  string $param  GET请求参数
     * @return array          api返回结果
     */
    protected function api($name, $data = '', $method = 'POST', $param = '', $json = false){
        $params = array('access_token' => $this->accessToken);
        if(!empty($param) && is_array($param)){
            $params = array_merge($params, $param);
        }
        $url  = "{$this->apiURL}/{$name}";
        if($json && !empty($data)){
            //保护中文，微信api不支持中文转义的json结构
            array_walk_recursive($data, function(&$value){
                $value = urlencode($value);
            });
            $data = urldecode(json_encode($data));
        }
        $data = $this->http($url, $params, $data, $method);
        return json_decode($data, true);
    }

    /**
     * 发送HTTP请求方法，目前只支持CURL发送请求
     * @param  string $url    请求URL
     * @param  array  $param  GET参数数组
     * @param  array  $data   POST的数据，GET请求时该参数无效
     * @param  string $method 请求方法GET/POST
     * @return array          响应数据
     */
    protected  function http($url, $param, $data = '', $method = 'GET'){
        $opts = array(
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        );
        /* 根据请求类型设置特定参数 */
        $opts[CURLOPT_URL] = $url . '?' . http_build_query($param);
        if(strtoupper($method) == 'POST'){
            $opts[CURLOPT_POST] = 1;
            $opts[CURLOPT_POSTFIELDS] = $data;

            if(is_string($data)){ //发送JSON数据
                $opts[CURLOPT_HTTPHEADER] = array(
                    'Content-Type: application/json; charset=utf-8',
                    'Content-Length: ' . strlen($data),
                );
            }
        }
        /* 初始化并执行curl请求 */
        $ch = curl_init();
        curl_setopt_array($ch, $opts);
        $data  = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);
        //发生错误，抛出异常
        if($error) throw new \Exception('请求发生错误：' . $error);
        return  $data;
    }

    private function get_php_file($filename) {
        return trim(substr(file_get_contents($filename), 15));
    }

    private function set_php_file($filename, $content) {
        $fp = fopen($filename, "x+");
        fwrite($fp, "<?php exit();?>" . $content);
        fclose($fp);
    }
}