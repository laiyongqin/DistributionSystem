<?php /* Smarty version 3.1.27, created on 2016-08-20 17:31:36
         compiled from "/mnt/www/wx.fenxiao.com/application/modules/Mall/views/product/order.html" */ ?>
<?php
/*%%SmartyHeaderCode:39187505257b823784ec616_80734078%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1ff0b9773e5191c583aeb14dccad6d223a2a2674' => 
    array (
      0 => '/mnt/www/wx.fenxiao.com/application/modules/Mall/views/product/order.html',
      1 => 1471680222,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '39187505257b823784ec616_80734078',
  'variables' => 
  array (
    'addressInfo' => 0,
    'orderInfo' => 0,
    'signPackage' => 0,
    'orderNo' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57b8237853f9d2_79733693',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57b8237853f9d2_79733693')) {
function content_57b8237853f9d2_79733693 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '39187505257b823784ec616_80734078';
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>支付页面</title>
    <link rel="stylesheet" type="text/css" href="/public/js/weui/weui.min.css">
    <link rel="stylesheet" type="text/css" href="/public/js/weui/jquery-weui.css">
    <link rel="stylesheet" type="text/css" href="/public/css/style.css">
    <link rel="stylesheet" type="text/css" href="/public/css/iconfont.css">
</head>


<body style="padding-bottom:4vw;">

<div class="pay">

    <div class="box">
        <div class="title">收货人信息</div>
        <div class="content">
            <p>联系人：<?php echo $_smarty_tpl->tpl_vars['addressInfo']->value['a_realname'];?>
</p>
            <p>联系电话：<?php echo $_smarty_tpl->tpl_vars['addressInfo']->value['a_phone'];?>
</p>
            <p>联系地址：<?php echo $_smarty_tpl->tpl_vars['addressInfo']->value['a_province'];?>
,<?php echo $_smarty_tpl->tpl_vars['addressInfo']->value['a_city'];?>
,<?php if ($_smarty_tpl->tpl_vars['addressInfo']->value['a_area']) {
echo $_smarty_tpl->tpl_vars['addressInfo']->value['a_area'];?>
,<?php }
echo $_smarty_tpl->tpl_vars['addressInfo']->value['a_address'];?>
</p>
        </div>
    </div>

    <div class="box">
        <div class="title">产品信息</div>
        <div class="content">
            <p><?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['p_title'];?>
 <?php if ($_smarty_tpl->tpl_vars['orderInfo']->value['pp_title']) {?>（<?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['pp_title'];?>
）<?php }?>￥<?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['p_price'];?>
 * <?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['o_number'];?>
</p>
            <p><span>购物合计总金额：<?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['o_payment_amount'];?>
元</span></p>
        </div>
    </div>
    <input type="button" class="btn" value="微信支付" onclick="callpay()">
</div>
<?php echo '<script'; ?>
 type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/public/js/zepto.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/public/js/weui/jquery-weui.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
    var appId     = '<?php echo $_smarty_tpl->tpl_vars['signPackage']->value['appId'];?>
';var timestamp = '<?php echo $_smarty_tpl->tpl_vars['signPackage']->value['timestamp'];?>
';
    var nonceStr  = '<?php echo $_smarty_tpl->tpl_vars['signPackage']->value['nonceStr'];?>
';var signature = '<?php echo $_smarty_tpl->tpl_vars['signPackage']->value['signature'];?>
';

    wx.config({
        appId: appId,
        timestamp:timestamp,
        nonceStr: nonceStr,
        signature: signature,
        jsApiList: [
            'chooseWXPay'
        ]
    });

    function callpay() {
        var orderNo = '<?php echo $_smarty_tpl->tpl_vars['orderNo']->value;?>
';
        $.getJSON('/ajax/order/create/', {orderNo : orderNo},  function(data) {
            if(data.status == 'y'){
                var jsApiParameters = data.info;
                wx.chooseWXPay({
                    timestamp: jsApiParameters.timeStamp,
                    nonceStr: jsApiParameters.nonceStr,
                    package: jsApiParameters.package,
                    signType: jsApiParameters.signType, // 注意：新版支付接口使用 MD5 加密
                    paySign: jsApiParameters.paySign,
                    success: function (res) {
                        window.location.href = "/mall/order/index/";
                    }
                });
            }else{
                alert(data.info);
            }

        });
    }
<?php echo '</script'; ?>
>


</body>
</html>
<?php }
}
?>