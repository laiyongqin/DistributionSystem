<?php

/**
 * 订单管理
 *
 * @author: lindexin
 * @since : 2016/08/15
 */

class OrderController extends BaseController
{

    private $_model;

    //初始化
    public function init()
    {
        $this->isAjaxRequest();
        $this->isLogin();
        $this->_model    = new OrderModel();
        Yaf_Dispatcher::getInstance()->disableView();
    }

    //改价表单页
    public function priceSaveAction() {
        $post = $this->getRequest()->getPost();
        $id = intval($post['id']);

        $data = array(
            'o_payment_amount' =>$post['o_payment_amount'],
            'o_updatetime' => date('Y-m-d H:i:s',time()),
        );
        $ret = $this->_model->saveData($data, $id);
        if($ret){
            //订单进度
            $result = array(
                'o_id'   => $id,
                'op_memo' => '修改订单价格为'.$post['o_payment_amount'],
                'op_addtime' => date('Y-m-d H:i:s',time()),
            );
            OrderprogressModel::getInstance()->saveData($result);
            Helper_Json::formJson('改价成功', 'y');
        }else{
            Helper_Json::formJson('改价失败');
        }
    }

    //关闭订单
    public function closeSaveAction() {
        $post = $this->getRequest()->getPost();
        $id = intval($post['id']);

        $data = array(
            'o_close_remark' =>$post['o_close_remark'],
            'o_pay_status' => 2,
            'o_updatetime' => date('Y-m-d H:i:s',time()),
        );
        $ret = $this->_model->saveData($data, $id);
        if($ret){
            //订单进度
            $result = array(
                'o_id'   => $id,
                'op_memo' => '关闭订单',
                'op_addtime' => date('Y-m-d H:i:s',time()),
            );
            OrderprogressModel::getInstance()->saveData($result);
            Helper_Json::formJson('关闭成功', 'y');
        }else{
            Helper_Json::formJson('关闭失败');
        }
    }

    //填写快递单号
    public function expressSaveAction() {
        $post = $this->getRequest()->getPost();
        $id = intval($post['id']);

        //商品信息
        $row    = $this->_model->getInfo($id);

        $data = array(
            'o_express_company' => $post['o_express_company'],
            'o_express_number'  => $post['o_express_number'],
            'o_updatetime'      => date('Y-m-d H:i:s',time()),
        );

        $ret = $this->_model->saveData($data, $id);
        if($ret){
            //订单进度
            $result = array(
                'o_id'       => $id,
                'op_memo'    => '填写快递信息',
                'op_addtime' => date('Y-m-d H:i:s',time()),
            );
            OrderprogressModel::getInstance()->saveData($result);

            //快递发送通知
            $data = array(
                'title'    => $row['p_title'],
                'company'  => $post['o_express_company'],
                'number'   => $post['o_express_number'],
            );

            //$message = MessageModel::getInstance()->rebuildMessage('express_notice', $data);

            $openId = MemberModel::getInstance()->getOpenId(intval($row['m_id']));
            QueueModel::getInstance()->addQueue($openId, 'express_notice', $data);
            //MessageModel::getInstance()->sendTextMessage($openId, $message);

            Helper_Json::formJson('快递填写成功', 'y');
        }else{
            Helper_Json::formJson('快递填写失败');
        }
    }

}