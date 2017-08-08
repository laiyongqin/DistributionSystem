<?php

/**
 * 我的二维码
 *
 * @author: moxiaobai
 * @since : 2016/8/19 9:54
 */

class QrcodeController extends BaseController
{

    private function init() {
        $this->initViewPath();
    }

    public function indexAction() {
        //判断是否是会员
        $isVip = MemberModel::getInstance()->isVip(M_ID);
        if(!$isVip) {
            $file = '/public/upload/qrcode.jpg';
        } else {
            $info = QrcodeModel::getInstance()->create(OPEN_ID);
            $file = $info['data'];
        }

        $this->initPageTitle('我的二维码');
        $this->getView()->assign('file', $file);
        $this->getView()->assign('nav', 4);
    }
}