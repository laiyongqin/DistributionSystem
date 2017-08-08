<?php /* Smarty version 3.1.27, created on 2016-08-20 11:59:34
         compiled from "/mnt/www/wx.fenxiao.com/application/modules/Member/views/cash/load.html" */ ?>
<?php
/*%%SmartyHeaderCode:32238733057b7d5a6445af9_10005046%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b46772d9db0cc2503cebebb155ba914c7ff3fe6c' => 
    array (
      0 => '/mnt/www/wx.fenxiao.com/application/modules/Member/views/cash/load.html',
      1 => 1471665573,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '32238733057b7d5a6445af9_10005046',
  'variables' => 
  array (
    'data' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57b7d5a649bfa9_85548503',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57b7d5a649bfa9_85548503')) {
function content_57b7d5a649bfa9_85548503 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '32238733057b7d5a6445af9_10005046';
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
    <span><?php echo $_smarty_tpl->tpl_vars['v']->value['pw_id'];?>
</span>
    <span><?php echo $_smarty_tpl->tpl_vars['v']->value['pw_money'];?>
</span>
    <?php if ($_smarty_tpl->tpl_vars['v']->value['pw_status'] == 1) {?>
    <span class="zt2">进行中...</span>
    <?php } elseif ($_smarty_tpl->tpl_vars['v']->value['pw_status'] == 2) {?>
    <span class="zt1">提现成功</span>
    <?php } elseif ($_smarty_tpl->tpl_vars['v']->value['pw_status'] == 3) {?>
    <span class="zt3">提现失败</span>
    <?php }?>
</li>
<?php
$_smarty_tpl->tpl_vars['v'] = $foreach_v_Sav;
}
?>
<?php }
}
}
?>