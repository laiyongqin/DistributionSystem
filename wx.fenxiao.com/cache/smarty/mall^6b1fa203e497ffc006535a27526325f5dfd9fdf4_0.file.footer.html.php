<?php /* Smarty version 3.1.27, created on 2016-11-25 17:51:52
         compiled from "/mnt/www/wx.fenxiao.com/application/views/common/footer.html" */ ?>
<?php
/*%%SmartyHeaderCode:808085075583809b87d7792_17986678%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6b1fa203e497ffc006535a27526325f5dfd9fdf4' => 
    array (
      0 => '/mnt/www/wx.fenxiao.com/application/views/common/footer.html',
      1 => 1480067301,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '808085075583809b87d7792_17986678',
  'variables' => 
  array (
    'nav' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_583809b881c633_66520121',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_583809b881c633_66520121')) {
function content_583809b881c633_66520121 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '808085075583809b87d7792_17986678';
?>
<nav>
<a <?php if (isset($_smarty_tpl->tpl_vars['nav']->value) && $_smarty_tpl->tpl_vars['nav']->value == 1) {?>class="on"<?php }?> href="/index"><i class="icon iconfont">&#xe736;</i><p>进入商城</p></a>
<a <?php if (isset($_smarty_tpl->tpl_vars['nav']->value) && $_smarty_tpl->tpl_vars['nav']->value == 2) {?>class="on"<?php }?> href="/mall/news/index"><i class="icon iconfont">&#xe616;</i><p>新闻资讯</p></a>
<a <?php if (isset($_smarty_tpl->tpl_vars['nav']->value) && $_smarty_tpl->tpl_vars['nav']->value == 3) {?>class="on"<?php }?> href="/mall/order/index"><i class="icon iconfont">&#xe737;</i><p>我的订单</p></a>
<a <?php if (isset($_smarty_tpl->tpl_vars['nav']->value) && $_smarty_tpl->tpl_vars['nav']->value == 4) {?>class="on"<?php }?> href="/member/member/index"><i class="icon iconfont">&#xe75e;</i><p>会员中心</p></a>

</nav><?php }
}
?>