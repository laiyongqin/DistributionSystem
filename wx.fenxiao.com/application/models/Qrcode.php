<?php

/**
 * 推广二维码
 *
 * @author: moxiaobai
 * @since : 2016/8/16 14:57
 */

class QrcodeModel extends BaseModel {

    public function __construct()
    {
        parent::__construct('www', 't_member', 'm_id');
    }

    public function create($openId) {
        $userInfo = MemberModel::getInstance()->getUserInfoByOpenId($openId);
        if($userInfo['m_vip'] == 1) {
            return $this->result(1001, '您还不是代言人，不能为您生成推广二维码,立即购买成为代言人。');
        }

        //新目录
        $fileimg = APP_PATH . "/public/qrcode/{$openId}.jpg";
        if(! file_exists($fileimg)) {
            $weixin   = new Open_Weixin_Auth();
            $info     = $weixin->getUserInfo($openId);

            //推广二维码
            $ticket = $weixin->qrcodeCreate($userInfo['m_id']);

            //背景图片
            $target = APP_PATH  . '/public/upload/qrcode.jpg';
            $target_img = imagecreatefromjpeg($target);

            //头像
            $avatar       = APP_PATH  . "/public/qrcode/{$openId}_avatar.jpg";
            $avatarWidth  = 93;
            $avatarHeight = 93;
            if(! file_exists($avatar)) {
                $this->curlDown($info['headimgurl'], $avatar, $avatarWidth, $avatarHeight);
            }
            $sourceOne = imagecreatefromjpeg($avatar);

            //二维码
            $qrcode       = APP_PATH  . "/public/qrcode/{$openId}_qrcode.jpg";
            $qrcodeWidth  = 166;
            $qrcodeHeight = 166;
            if(! file_exists($qrcode)) {
                $this->curlDown("https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=" . $ticket['ticket'], $qrcode, $qrcodeWidth, $qrcodeHeight);
            }
            $sourceTwo = imagecreatefromjpeg($qrcode);

            //商生成新图片
            imagecopy($target_img,$sourceOne,124,401,0,0,$avatarWidth, $avatarHeight);
            imagecopy($target_img,$sourceTwo,106,161,0,0,$qrcodeWidth,$qrcodeHeight);
            $font    = APP_PATH . "/public/fonts/font.ttf";
            @imagettftext($target_img, 20, 0, 299, 435, '0x000000', $font, $info['nickname']);

            Imagejpeg($target_img, $fileimg);
        }

        return $this->result(1, "/public/qrcode/{$openId}.jpg");
    }

    private function curlDown($url, $fileName, $width, $height) {
        $ch = curl_init();
        $fp = fopen($fileName, 'wb');

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);

        curl_exec($ch);
        curl_close($ch);
        fclose($fp);

        $imageZoom = new Images_Handle();
        $imageZoom->zoomAutoImages($fileName, $fileName, $width, $height);
    }
}