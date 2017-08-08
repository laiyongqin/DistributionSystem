<?php /* Smarty version 3.1.27, created on 2016-08-20 15:25:35
         compiled from "/mnt/www/wx.fenxiao.com/application/views/common/footer.html" */ ?>
<?php
/*%%SmartyHeaderCode:61783327757b805efdcd446_34641449%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6b1fa203e497ffc006535a27526325f5dfd9fdf4' => 
    array (
      0 => '/mnt/www/wx.fenxiao.com/application/views/common/footer.html',
      1 => 1471676374,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '61783327757b805efdcd446_34641449',
  'variables' => 
  array (
    'nav' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57b805efdd6426_18689611',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57b805efdd6426_18689611')) {
function content_57b805efdd6426_18689611 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '61783327757b805efdcd446_34641449';
?>
<nav>
<a <?php if (isset($_smarty_tpl->tpl_vars['nav']->value) && $_smarty_tpl->tpl_vars['nav']->value == 1) {?>class="on"<?php }?> href="/index"><i class="icon iconfont">&#xe613;</i><p>进入商城</p></a>
<a <?php if (isset($_smarty_tpl->tpl_vars['nav']->value) && $_smarty_tpl->tpl_vars['nav']->value == 2) {?>class="on"<?php }?> href="/mall/order/index"><i class="icon iconfont">&#xe614;</i><p>我的订单</p></a>
<a <?php if (isset($_smarty_tpl->tpl_vars['nav']->value) && $_smarty_tpl->tpl_vars['nav']->value == 3) {?>class="on"<?php }?> href="/member/member/index"><i class="icon iconfont">&#xe615;</i><p>会员中心</p></a>
<a <?php if (isset($_smarty_tpl->tpl_vars['nav']->value) && $_smarty_tpl->tpl_vars['nav']->value == 4) {?>class="on"<?php }?> href="/member/index/index"><i class="icon iconfont">&#xe616;</i><p>我的二维码</p></a>
</nav><?php }
}
?>