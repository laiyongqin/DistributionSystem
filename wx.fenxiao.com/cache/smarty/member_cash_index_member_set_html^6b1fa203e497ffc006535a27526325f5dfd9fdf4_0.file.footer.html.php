<?php /* Smarty version 3.1.27, created on 2016-08-20 14:35:10
         compiled from "/mnt/www/wx.fenxiao.com/application/views/common/footer.html" */ ?>
<?php
/*%%SmartyHeaderCode:57370173757b7fa1e468f61_40539209%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6b1fa203e497ffc006535a27526325f5dfd9fdf4' => 
    array (
      0 => '/mnt/www/wx.fenxiao.com/application/views/common/footer.html',
      1 => 1471674832,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '57370173757b7fa1e468f61_40539209',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57b7fa1e46d199_16057842',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57b7fa1e46d199_16057842')) {
function content_57b7fa1e46d199_16057842 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '57370173757b7fa1e468f61_40539209';
?>
<nav>
<a class="on" href="/"><i class="icon iconfont">&#xe613;</i><p>进入商城</p></a>
<a href="/mall/order/index"><i class="icon iconfont">&#xe614;</i><p>我的订单</p></a>
<a href="/member/index/index"><i class="icon iconfont">&#xe615;</i><p>会员中心</p></a>
<a href="/member/index/index"><i class="icon iconfont">&#xe616;</i><p>我的二维码</p></a>
</nav><?php }
}
?>