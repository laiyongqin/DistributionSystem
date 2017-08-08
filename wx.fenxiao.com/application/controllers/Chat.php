<?php

/**
 * 微信通讯
 *
 * @author: moxiaobai
 * @since : 2016/2/23 8:59
 */

class ChatController extends BaseController {

    //公众号服务器配置地址
    public function indexAction() {
        $this->valid();

        $wechat = new Open_Weixin_Chat(TOKEN);
        $data = $wechat->request();

        /* 响应当前请求 */
        $chat   = new ChatModel();
        $result = $chat->deal($data);

        //记录日志
        LogModel::getInstance()->addLog($data);

        //code为1时候响应消息
        if($result['code'] == 1) {
            $wechat->response($result['content'], $result['type']);
        }
        exit;
    }

    protected function valid() {
        if(isset($_GET["echostr"])) {
            //valid signature , option
            if($this->checkSignature()){
                echo $_GET["echostr"];
                exit;
            }
        }
    }

    //验证
    private function checkSignature()
    {
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }

        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }

    public function unitAction() {
        //$this->debug(MessageModel::getInstance()->sendImagesMessage('oqejGwFgtwnFMzE1TuRFWNwHxLog', 'zFW_29uwo5mR5r4oxOiWTGg_lGJ4rK8SaECkeosZTDiJUOjpSyJtVOYzRD2nxtzJ'));
//        $file = APP_PATH . "/public/upload/logo.png";
//
//        $weixin = new Open_Weixin_Auth();
        //$this->debug($weixin->qrcodeCreate(1));

        //$this->loadModel('Promoter', array(), 'Member')->addPromoter(8, 9);
        //MemberModel::getInstance()->addMember(11111);

//        $qrcodeInfo = QrcodeModel::getInstance()->create("oqejGwFgtwnFMzE1TuRFWNwHxLog");
//        $this->debug($qrcodeInfo);

        //$this->debug($weixin->uploadMedia('image',$file));
        //$this->debug($weixin->getMedia('OQcqNpBvdoF89cGSqQD4gAhc1GuKZirdJnq27rXyXcuv7d8d2FoRxh-uCQfQ7NLQ'));

        //$this->debug($this->loadModel('Payment', array(), 'Pay')->createPayment(11,22,1,12.36));

        //MessageModel::getInstance()->confirmOrderNotice('oqejGwFgtwnFMzE1TuRFWNwHxLog', 'moxiaobai','123456',255,120);

        //$this->debug($this->loadModel('Payment', array(), 'Pay')->getJsApiParameters(20160819151101, '测试', 0.01));
        //$this->debug(Helper_Map::getAddress("26.096722134649,119.32142890422"));
        $this->debug(MediaModel::getInstance()->getMedia('oBp4Jt0jr95a3XzWJci7BKK-sHOk', 1));
        exit;
    }
}