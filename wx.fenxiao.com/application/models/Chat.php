<?php

/**
 * 消息通讯
 *
 * @author: moxiaobai
 * @since : 2016/2/23 14:01
 */

class ChatModel {

    public function deal($data) {
        /* 响应当前请求 */
        $msgType = $data['MsgType'];
        $openId  = $data['FromUserName'];

        $content = '';
        $type    = '';
        $code    = 1;
        switch ($msgType) {
            case 'text':
                $keyword = $data['Content'];

                //通过关键字获取内容
                $keywordModel = new KeywordModel();
                $result       = $keywordModel->getContentByKeyword($keyword);

                $content = $result['content'];
                $type    = $result['type'];
                break;
            case 'event':
                $eventType = $data['Event'];
                switch($eventType) {
                    case 'subscribe':
                        $eventKey = isset($data['EventKey']) ? substr($data['EventKey'], 8) : 0;

                        //订阅事件
                        $subscribeModel = new SubscribeModel();
                        $result        = $subscribeModel->getWelcomeTip($eventKey, $openId);
                        $content = $result['content'];
                        $type    = $result['type'];

                        break;
                    case 'CLICK':
                        //菜单点击事件
                        $eventKey = $data['EventKey'];

                        $eventModel = new EventModel();
                        $result     = $eventModel->getContentByEvent($eventKey, $openId);

                        $content = $result['content'];
                        $type    = $result['type'];
                        break;
                    case 'SCAN':
//                        //扫码事件
                        $eventKey = $data['EventKey'];
//
                        $subscribeModel = new SubscribeModel();
                        $result        = $subscribeModel->getWelcomeTip($eventKey, $openId, 'scan');
                        $content = $result['content'];
                        $type    = 'text';
                        break;
                }
                break;
            default:
                $content  = '谢谢您关注，祝您生活愉快！';
                $type     = 'text';
                break;
        }

        $result = array(
            'code'    => $code,
            'content' => $content,
            'type'    => $type,
        );

        return $result;
    }
}