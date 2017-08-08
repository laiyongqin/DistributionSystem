<?php /* Smarty version 3.1.27, created on 2016-09-29 11:29:32
         compiled from "/mnt/www/oss.fenxiao.com/application/views/default/common/menu.html" */ ?>
<?php
/*%%SmartyHeaderCode:64967204957ec8a9cb22978_83713873%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9df84d6a357bef00a1c447a232a3443808806c28' => 
    array (
      0 => '/mnt/www/oss.fenxiao.com/application/views/default/common/menu.html',
      1 => 1471484306,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '64967204957ec8a9cb22978_83713873',
  'variables' => 
  array (
    'menuLeftList' => 0,
    'top' => 0,
    'son' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57ec8a9cb61236_00628655',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57ec8a9cb61236_00628655')) {
function content_57ec8a9cb61236_00628655 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '64967204957ec8a9cb22978_83713873';
?>
<div id="left">
    <div class="btn-group-vertical" id="km_ment" role="group" aria-label="...">
        <?php
$_from = $_smarty_tpl->tpl_vars['menuLeftList']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['top'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['top']->_loop = false;
$_smarty_tpl->tpl_vars['m_id'] = new Smarty_Variable;
foreach ($_from as $_smarty_tpl->tpl_vars['m_id']->value => $_smarty_tpl->tpl_vars['top']->value) {
$_smarty_tpl->tpl_vars['top']->_loop = true;
$foreach_top_Sav = $_smarty_tpl->tpl_vars['top'];
?>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span><?php echo $_smarty_tpl->tpl_vars['top']->value['m_name'];?>

                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <?php
$_from = $_smarty_tpl->tpl_vars['top']->value['son'];
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['son'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['son']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['son']->value) {
$_smarty_tpl->tpl_vars['son']->_loop = true;
$foreach_son_Sav = $_smarty_tpl->tpl_vars['son'];
?>
                <li><a href="/<?php echo $_smarty_tpl->tpl_vars['son']->value['m_url'];?>
"><?php echo $_smarty_tpl->tpl_vars['son']->value['m_name'];?>
</a></li>
                <?php
$_smarty_tpl->tpl_vars['son'] = $foreach_son_Sav;
}
?>
            </ul>
        </div>
        <?php
$_smarty_tpl->tpl_vars['top'] = $foreach_top_Sav;
}
?>
    </div>
</div><?php }
}
?>