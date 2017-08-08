<?php

/**
 * 微信菜单点击事件
 *
 * @author: moxiaobai
 * @since : 2016/3/3 16:07
 */

class EventModel {

    public function getContentByEvent($eventKey, $openId) {
        switch ($eventKey) {
            case 'myQrcode':
                //判断是否是会员
                $qrcodeInfo = QrcodeModel::getInstance()->create($openId);
                if($qrcodeInfo['code'] == 1) {
                    //上传临时素材
                    $file = APP_PATH . $qrcodeInfo['data'];

                    $media_id = MediaModel::getInstance()->getMedia($openId, 1);
                    if(!$media_id) {
                        $weixin = new Open_Weixin_Auth();
                        $media  = $weixin->uploadMedia("image", $file);

                        $media_id = $media['media_id'];

                        MediaModel::getInstance()->updateMedia($openId,1,$media_id);
                    }

                    $content = array($media_id);
                    $type    = 'image';
                } else {
                    $content = $qrcodeInfo['data'];
                    $type    = 'text';
                }

                break;
            default:
                $content = '您好，很高兴为你服务';
                $type    = 'transfer_customer_service';
                break;
        }

        //返回数据
        $result = array(
            'content' => $content,
            'type'    => $type
        );
        return $result;
    }
}