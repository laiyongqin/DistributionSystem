<?php

/**
 * 微信支付异步回调地址
 *
 * @author: moxiaobai
 * @since : 2016/8/19 18:39
 */

class WeixinController extends BaseController
{

    public function init()
    {
        Yaf_Dispatcher::getInstance()->disableView();
    }

    //微信支付回调
    public function notifyAction()
    {
        $notify = new PayNotifyCallBack();
        $notify->Handle(false);
    }

}

//异步通知
class PayNotifyCallBack extends Pay_Weixin_Notify
{
    //重写回调处理函数
    public function NotifyProcess($data, &$msg)
    {
        if(!array_key_exists("transaction_id", $data)){
            $msg = "输入参数不正确";
            return false;
        }
        //查询订单，判断订单真实性

        if(!Pay_Weixin_Pay::Queryorder($data["transaction_id"])){
            $msg = "订单查询失败";
            return false;
        }

        //处理订单
        $order = new Order();
        $order->dealOrder($data);

        return true;
    }
}

class Order {

    public function dealOrder($data) {
        //具体的业务逻辑
        $trade_no       = $data['out_trade_no'];
        $transaction_id = $data['transaction_id'];

        //记录异步通知日志
        $this->loadModel('NotifyLog', array(), 'Pay')->addNotifyLog(1, $trade_no, $transaction_id, $data);

        //处理订单
        $orderInfo = $this->loadModel('Order', array(), 'Mall')->dealOrder($trade_no);

        //处理订单成功,记录支付信息
        if($orderInfo) {
            $this->loadModel('Payment', array(), 'Pay')->createPayment($trade_no,$transaction_id, $orderInfo['m_id'], $orderInfo['o_payment_amount']);
        }

        return true;
    }

    protected function loadModel($class_name,$param=array(),$module_name=false){
        //return module name;
        if(!$module_name){
            $module_name = $this->getModuleName();
        }
        $class_name  = ucwords($class_name);

        $key   = "{$module_name}[{$class_name}]";
        $model = Yaf_Registry::get($key);

        //Is model has instance.
        if ( ! $model ) {
            //Is model file exists.
            $model_file = APP_PATH . '/application/modules/' . $module_name . '/models/' . $class_name.'.php';
            if ( ! file_exists( $model_file ) )
                exit('Model file not exists: ' . $model_file);

            require $model_file;

            $code_str = "";
            foreach ($param as $key => $value) {
                $code_str.='$param['.$key.'],';
            }
            if($code_str!=""){
                $code_str=substr($code_str,0,-1);
            }
            $class_name = $class_name . 'Model';
            $code_str    = '$model = new '.$class_name.'('.$code_str.');';
            eval($code_str);
            Yaf_Registry::set($key, $model);

            if( ! defined('MODULES_NAME') ) {
                define('MODULES_NAME', $module_name);
            }
        }
        return $model;
    }
}