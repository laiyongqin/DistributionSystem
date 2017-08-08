<?php

/**
 * 后台管理首页
 *
 * @author: moxiaobai
 * @since : 2016/1/28 16:43
 */

class IndexController extends BaseController {
    public function init(){
        parent::init();
    }

    public function indexAction() {

        $this->initPageTitle('管理员主页');

        //登录日志
        $loginLogList = LoginLogModel::getInstance()->getList(A_ID);

        //下单数
        $orderNumber = OrderModel::getInstance()->countOrder();

        //销售额
        $salesMoney  = OrderModel::getInstance()->countSalesMoney();
        $this->getView()->assign(array(
            'loginLogList' => $loginLogList,
            'orderNumber'  => $orderNumber,
            'salesMoney'   => $salesMoney,
        ));
    }

    public function passwordAction() {
    }
}