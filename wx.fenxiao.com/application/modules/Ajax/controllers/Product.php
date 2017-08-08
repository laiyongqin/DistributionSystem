<?php

/**
 * 产品购买
 *
 * @author: monyyip
 * @since : 2016/8/19 10:51
 */

class ProductController extends BaseController
{

    //初始化
    public function init()
    {
        $this->isAjaxRequest();
        $this->isLogin();
        Yaf_Dispatcher::getInstance()->disableView();
    }

    public function buyAction(){
        $pid = isset($_POST['p_id']) ? intval($_POST['p_id']) : 0;
        $ppList = isset($_POST['ppList']) ? Helper_Filter::format($_POST['ppList'], FALSE, TRUE) : '';
        $num = isset($_POST['num']) ? intval($_POST['num']) : 1;
        $realname = isset($_POST['realname']) ? Helper_Filter::format($_POST['realname'], FALSE, TRUE) : '';
        $phone = isset($_POST['phone']) ? Helper_Filter::format($_POST['phone'], FALSE, TRUE) : '';
        $wechat = isset($_POST['wechat']) ? Helper_Filter::format($_POST['wechat'], FALSE, TRUE) : '';
        $prov = isset($_POST['prov']) ? Helper_Filter::format($_POST['prov'], FALSE, TRUE) : '';
        $city = isset($_POST['city']) ? Helper_Filter::format($_POST['city'], FALSE, TRUE) : '';
        $dist = isset($_POST['dist']) ? Helper_Filter::format($_POST['dist'], FALSE, TRUE) : '';
        $address = isset($_POST['address']) ? Helper_Filter::format($_POST['address'], FALSE, TRUE) : '';
        $remark = isset($_POST['remark']) ? Helper_Filter::format($_POST['remark'], FALSE, TRUE) : '';
        if(empty($num)){
            $num = 1;
        }

        if(empty($pid)){
            Helper_Json::formJson('商品信息错误');
        }

        if(empty($realname)){
            Helper_Json::formJson('请填写联系人');
        }

        if(empty($phone) || !Helper_Check::isMobile($phone)){
            Helper_Json::formJson('请填写正确的手机号码');
        }

        if(empty($wechat)){
            Helper_Json::formJson('请填写微信号');
        }

        if(empty($address)){
            Helper_Json::formJson('请填写联系地址');
        }

        $productInfo = $this->loadModel('Product', array(), 'Mall')->getInfo($pid);
        if(empty($productInfo) || $productInfo['p_status'] == 2){
            Helper_Json::formJson('商品信息错误');
        }

        // 判断是否有过地址，有则更新，无则插入
        $addressModel = $this->loadModel('Address', array(), 'Member');
        $addressInfo = $addressModel->getAddress(M_ID, 'a_id');
        $data = array(
            'm_id' => M_ID,
            'a_phone' => $phone,
            'a_realname' => $realname,
            'a_wechat_id' => $wechat,
            'a_province' => $prov,
            'a_city' => $city,
            'a_area' => $dist,
            'a_address' => $address,
            'a_addtime' => date("Y-m-d H:i:s")
        );

        if($addressInfo){
            $addressID = $addressModel->saveData($data, $addressInfo['a_id']);
        }else{
            $addressID = $addressModel->saveData($data);
        }

        if(!$addressID){
            Helper_Json::formJson('地址保存失败');
        }

        // 更新用户手机号
        MemberModel::getInstance()->updatePhone(M_ID, $phone);

        // 判断库存是否够
        $title = array();
        if($ppList){
            // 判断套餐库存
            $ppids = explode(',', $ppList);
            foreach($ppids as $ppid){
                $ppInfo = $this->loadModel('ProductProfile', array(), 'Mall')->getInfo($ppid);
                if(empty($ppInfo)){
                    Helper_Json::formJson('套餐信息错误');
                }

                if($ppInfo['pp_stock'] < $num){
                    Helper_Json::formJson('库存不足');
                }

                $title[] = $ppInfo['pp_name'];
            }
        }else{
            // 判断商品库存
            if($productInfo['p_stock'] < $num){
                Helper_Json::formJson('库存不足');
            }

        }

        if($productInfo['p_event_price'] > 0){
            $price = $productInfo['p_event_price'];
        }else{
            $price = $productInfo['p_original_price'];
        }

        $total = $price * $num;
        $orderNo = date('YmdHis') . Helper_Code::getActiveCode(4);


        // 写入订单
//        $paymentModel = $this->loadModel('Payment', array(), 'Pay');
//
//        $params = $paymentModel->getJsApiParameters($orderNo, '可米支付', $total);
//        if(empty($params)){
//            Helper_Json::formJson('订单错误');
//        }

        // 计算佣金比例
        $money = floatval($total * $productInfo['p_rate'] / 100);
        // 分销订单明细，判断是否有代言人
        $spokesInfo = $this->loadModel('SalesPromoter', array(), 'Mall')->getInfoBySpoke(M_ID);
        // 写入订单
        $data = array(
            'o_order_no' => $orderNo,
            'm_id'       => M_ID,
            'p_id'       => $pid,
            'p_title'    => $productInfo['p_title'],
            'pp_ids'     => $ppList,
            'pp_title'   => implode(',', $title),
            'p_price'    => $price,
            'o_number'   => $num,
            'o_order_amount' => $total,
            'o_payment_amount' => $total,
            'o_award_amount' => $spokesInfo ? $money : 0,
            'o_pay_status' => 1,
            'o_order_status' => 1,
            'o_addtime' => date('Y-m-d H:i:s'),
            'o_memo' => $remark,
        );

        $orderModel = $this->loadModel('Order', array(), 'Mall');
        $o_id       = $orderModel->saveData($data);
        if($o_id) {
            //写入订单进度
            $orderModel->updateOrderProgress($o_id, '创建订单');

            // 扣库存
            if ($ppList) {
                $ret = $this->loadModel('ProductProfile', array(), 'Mall')->updateStock($ppList, $num);
            } else {
                $ret = $this->loadModel('Product', array(), 'Mall')->updateStock($pid, $num);
            }

            if(!$ret){
                Helper_Json::formJson('扣库存失败');
            }

            if(!empty($spokesInfo) && $money > 0){
                // 写入分销明细
                $data = array(
                    'm_id'         => $spokesInfo['m_id'],
                    'so_spokesman' => M_ID,
                    'so_order_no'  => $orderNo,
                    'so_money'     => $money,
                    'so_type'      => 1,
                    'so_addtime'   => date('Y-m-d H:i:s'),
                );

                $ret = $this->loadModel('SalesOrder', array(), 'Mall')->saveData($data);
                if($ret){
                    // 更新个人财富
                    $this->loadModel('MemberWealth', array(), 'Member')->updateWealth($spokesInfo['m_id'], $total, $money);

                    // 给推广人发信息，获得推广人信息
                    $openID = MemberModel::getInstance()->getOpenIdByMid($spokesInfo['m_id']);
                    $data = array(
                        'nickname' => M_NAME,
                        'datetime' => date('Y-m-d H:i:s'),
                        'orderNo'  => $orderNo,
                        'money'    => $total,
                        'award'    => $money,
                    );
                    QueueModel::getInstance()->addQueue($openID, 'purchase_order_notice', $data);
                }
            }
        }

        $result = array(
            'orderNo' => $orderNo
        );

        Helper_Json::formJson($result, 'y');
    }
}