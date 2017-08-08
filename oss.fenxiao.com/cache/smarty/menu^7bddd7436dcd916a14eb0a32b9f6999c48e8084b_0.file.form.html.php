<?php /* Smarty version 3.1.27, created on 2016-09-07 09:43:01
         compiled from "/mnt/www/oss.fenxiao.com/application/views/default/menu/form.html" */ ?>
<?php
/*%%SmartyHeaderCode:209855716657cf70a55bcc33_83911822%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7bddd7436dcd916a14eb0a32b9f6999c48e8084b' => 
    array (
      0 => '/mnt/www/oss.fenxiao.com/application/views/default/menu/form.html',
      1 => 1471418953,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '209855716657cf70a55bcc33_83911822',
  'variables' => 
  array (
    'row' => 0,
    'topList' => 0,
    'top' => 0,
    'm_id' => 0,
    'menuList' => 0,
    'son' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57cf70a5618640_04757174',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57cf70a5618640_04757174')) {
function content_57cf70a5618640_04757174 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '209855716657cf70a55bcc33_83911822';
?>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="passportModalLabel"><?php if ($_smarty_tpl->tpl_vars['row']->value['m_id']) {?>编辑菜单<?php } else { ?>添加菜单<?php }?></h4>
        </div>
        <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['m_id'];?>
" />
        <div class="modal-body">
            <div class="alert alert-dismissible" role="alert" style="display: none;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong></strong>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">一级菜单</label>
                <div class="col-sm-6">
                    <select id="menuEdit" name="menuEdit" class="form-control">
                        <option value="0">请选择菜单</option>
                        <?php
$_from = $_smarty_tpl->tpl_vars['topList']->value;
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
                        <option value="<?php echo $_smarty_tpl->tpl_vars['top']->value['m_id'];?>
">+<?php echo $_smarty_tpl->tpl_vars['top']->value['m_name'];?>
</option>
                        <?php
$_from = $_smarty_tpl->tpl_vars['menuList']->value[$_smarty_tpl->tpl_vars['m_id']->value]['son'];
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['son'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['son']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['son']->value) {
$_smarty_tpl->tpl_vars['son']->_loop = true;
$foreach_son_Sav = $_smarty_tpl->tpl_vars['son'];
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['son']->value['m_id'];?>
">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['son']->value['m_name'];?>
</option>
                        <?php
$_smarty_tpl->tpl_vars['son'] = $foreach_son_Sav;
}
?>
                        <?php
$_smarty_tpl->tpl_vars['top'] = $foreach_top_Sav;
}
?>
                    </select>
                </div>
                <span class="help-inline" style="color:red;">*</span>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">菜单名</label>
                <div class="col-sm-6">
                    <input type="text" name="name" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['m_name'];?>
" placeholder="菜单名" class="form-control">
                </div>
                <span class="help-inline" style="color:red;">*</span>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">菜单URL</label>
                <div class="col-sm-6">
                    <input type="text" name="url" placeholder="菜单URL" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['m_url'];?>
" datatype="*" nullmsg="请填写菜单URL" class="form-control"/>
                </div>
                <span class="help-inline" style="color:red;">*</span>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">菜单标记</label>
                <div class="col-sm-6">
                    <input type="text" name="tag" placeholder="菜单标记" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['m_tag'];?>
" datatype="*" nullmsg="请填写菜单标记" class="form-control"/>
                </div>
                <span class="help-inline" style="color:red;">*</span>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">排序</label>
                <div class="col-sm-6">
                    <input type="text" name="order" placeholder="菜单排序" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['m_order'];?>
" datatype="n" nullmsg="请填写菜单排序" class="form-control"/>
                </div>
                <span class="help-inline" style="color:red;">*</span>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            <button type="submit" class="btn btn-primary btn-submit">确认修改</button>
        </div>
    </div>
    <?php echo '<script'; ?>
>
        $("#menuEdit").val("<?php echo $_smarty_tpl->tpl_vars['row']->value['m_parent_id'];?>
");
    <?php echo '</script'; ?>
>
</div>
<?php }
}
?>