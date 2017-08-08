<?php /* Smarty version 3.1.27, created on 2016-09-01 16:35:55
         compiled from "/mnt/www/wx.fenxiao.com/application/modules/Mall/views/order/express.html" */ ?>
<?php
/*%%SmartyHeaderCode:211898929857c7e86b504701_04036645%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '027e644a278e266f0fc31b14d90a8b76bc71c3a1' => 
    array (
      0 => '/mnt/www/wx.fenxiao.com/application/modules/Mall/views/order/express.html',
      1 => 1472718954,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '211898929857c7e86b504701_04036645',
  'variables' => 
  array (
    'expressData' => 0,
    'data' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57c7e86b572d17_03630719',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57c7e86b572d17_03630719')) {
function content_57c7e86b572d17_03630719 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '211898929857c7e86b504701_04036645';
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>快递跟踪</title>
    <link rel="stylesheet" type="text/css" href="/public/css/style.css">
    <link rel="stylesheet" type="text/css" href="/public/css/iconfont.css">
</head>
<style>
    .refund-list   {}
    .orders-header a{color:#fff;}
    .refund-list h3{ background: #d5d5d5;padding:3vw 0 1vw 9vw;   font-size: 4vw; background:#00c191;color:#fff;margin-bottom: 6vw;}
    .refund-list p{margin-bottom:1vw;padding-right: 0.5vw;}
    .refund-list ul li:first-child{color:#00c191;border-left:1vw solid #d5d5d5;}
    .refund-list ul li:first-child i{ background:#00c191;left:-2.4vw; width:2.5vw; height:2.5vw;border:1vw solid #f0f0f0; }
    .refund-list ul li                 { position:relative; height:auto; color:#888;min-height:20vw;padding:0 0 2vw 5vw;overflow: hidden; margin-left:8%; border-left:1vw solid #999; font-size:3.5vw; overflow:inherit;}
    .refund-list ul .adopt             { border-left:1vw solid #d5d5d5;}
    .refund-list ul li i               { position:absolute; top:0vw; left:-1.5vw; width:2.2vw; height:2.2vw; border:none; background:#d5d5d5; border-radius:50%;}
    </style>
<body>
<?php echo $_smarty_tpl->getSubTemplate ("application/views/common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


<div class="orders-header">
    <a href="/mall/order/index"><i class="icon iconfont">&#xe614;</i>我的订单</a>
</div>
<?php if ($_smarty_tpl->tpl_vars['expressData']->value) {?>
<div class="refund-list">
    <h3>
        <p>快递公司：<?php echo $_smarty_tpl->tpl_vars['data']->value['o_express_company'];?>
</p>
        <p>快递单号：<?php echo $_smarty_tpl->tpl_vars['data']->value['o_express_number'];?>
</p>
    </h3>
    <ul>
        <?php
$_from = $_smarty_tpl->tpl_vars['expressData']->value['data'];
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['v'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['v']->_loop = false;
$_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
$foreach_v_Sav = $_smarty_tpl->tpl_vars['v'];
?>
        <li class="adopt">
            <i></i>
            <p><?php echo $_smarty_tpl->tpl_vars['v']->value['context'];?>
</p>
            <p><?php echo $_smarty_tpl->tpl_vars['v']->value['ftime'];?>
</p>
        </li>
        <?php
$_smarty_tpl->tpl_vars['v'] = $foreach_v_Sav;
}
?>
    </ul>
</div>
<?php }?>
</body>
</html>
<?php }
}
?>