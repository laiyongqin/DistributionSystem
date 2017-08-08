<?php /* Smarty version 3.1.27, created on 2016-09-05 15:49:26
         compiled from "/mnt/www/oss.fenxiao.com/application/views/default/order/load.html" */ ?>
<?php
/*%%SmartyHeaderCode:18950859057cd238637b714_27431517%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '216cffd78d0a336eee83cfe8b4673332bc6f1354' => 
    array (
      0 => '/mnt/www/oss.fenxiao.com/application/views/default/order/load.html',
      1 => 1473061764,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18950859057cd238637b714_27431517',
  'variables' => 
  array (
    'expressData' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57cd23863dc2b3_54410710',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57cd23863dc2b3_54410710')) {
function content_57cd23863dc2b3_54410710 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '18950859057cd238637b714_27431517';
?>
<div class="table-responsive">
    <table class="table">
        <thead style="border-bottom: solid 2px #d9edf7;">
        <tr>
            <th>时间</th>
            <th>信息</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($_smarty_tpl->tpl_vars['expressData']->value) {?>
        <?php
$_from = $_smarty_tpl->tpl_vars['expressData']->value['data'];
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['v'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['v']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
$foreach_v_Sav = $_smarty_tpl->tpl_vars['v'];
?>
        <tr>
            <td><?php echo $_smarty_tpl->tpl_vars['v']->value['ftime'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['v']->value['context'];?>
</td>
        </tr>
        <?php
$_smarty_tpl->tpl_vars['v'] = $foreach_v_Sav;
}
?>
        <?php }?>
        </tbody>
    </table>
</div><?php }
}
?>