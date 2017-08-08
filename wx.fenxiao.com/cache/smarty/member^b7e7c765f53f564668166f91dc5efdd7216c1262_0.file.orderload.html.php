<?php /* Smarty version 3.1.27, created on 2016-08-20 17:04:40
         compiled from "/mnt/www/wx.fenxiao.com/application/modules/Member/views/member/orderload.html" */ ?>
<?php
/*%%SmartyHeaderCode:131669914757b81d28a53081_05796778%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b7e7c765f53f564668166f91dc5efdd7216c1262' => 
    array (
      0 => '/mnt/www/wx.fenxiao.com/application/modules/Member/views/member/orderload.html',
      1 => 1471683504,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '131669914757b81d28a53081_05796778',
  'variables' => 
  array (
    'data' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57b81d28ab8a72_95651585',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57b81d28ab8a72_95651585')) {
function content_57b81d28ab8a72_95651585 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '131669914757b81d28a53081_05796778';
if ($_smarty_tpl->tpl_vars['data']->value) {?>
<?php
$_from = $_smarty_tpl->tpl_vars['data']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['v'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['v']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
$foreach_v_Sav = $_smarty_tpl->tpl_vars['v'];
?>
<li>
    <img src="<?php echo @constant('IMAGE_URL');
echo $_smarty_tpl->tpl_vars['v']->value['m_avatar'];?>
" width="185" height="185">
    <div class="text">
        <p>昵称：<?php echo $_smarty_tpl->tpl_vars['v']->value['m_nickname'];?>
</p>
        <p>会员：<?php if ($_smarty_tpl->tpl_vars['v']->value['m_vip'] == 2) {?>是<?php } else { ?>否<?php }?></p>
        <p>订单号：<?php echo $_smarty_tpl->tpl_vars['v']->value['so_order_no'];?>
</p>
        <p>会员ID：<?php echo $_smarty_tpl->tpl_vars['v']->value['so_spokesman'];?>
</p>
    </div>
</li>
<?php
$_smarty_tpl->tpl_vars['v'] = $foreach_v_Sav;
}
?>
<?php }
}
}
?>