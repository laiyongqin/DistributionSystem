<?php /* Smarty version 3.1.27, created on 2016-08-26 10:08:47
         compiled from "/mnt/www/oss.fenxiao.com/application/views/default/diymenu/form.html" */ ?>
<?php
/*%%SmartyHeaderCode:198224799157bfa4af2e0758_24927814%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '16971fff51301c0f81bcc95ceb29027c527212f6' => 
    array (
      0 => '/mnt/www/oss.fenxiao.com/application/views/default/diymenu/form.html',
      1 => 1471425778,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '198224799157bfa4af2e0758_24927814',
  'variables' => 
  array (
    'row' => 0,
    'menuOption' => 0,
    'typeOption' => 0,
    'statusOption' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57bfa4af34f552_87713953',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57bfa4af34f552_87713953')) {
function content_57bfa4af34f552_87713953 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '198224799157bfa4af2e0758_24927814';
?>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="passportModalLabel">自定义菜单配置</h4>
        </div>
        <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['wm_id'];?>
" />
        <div class="modal-body">
            <div class="alert alert-dismissible" role="alert" style="display: none;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong></strong>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">上级菜单</label>
                <div class="col-sm-6">
                    <select name="wm_pid" id="wm_pid" class="form-control">
                        <?php echo $_smarty_tpl->tpl_vars['menuOption']->value;?>

                    </select>
                </div>
                <span class="help-inline" style="color:red;">*</span>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">菜单名称</label>
                <div class="col-sm-6">
                    <input type="text" name="wm_name" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['wm_name'];?>
" placeholder="菜单名称" datatype="*" nullmsg="请填写菜单名称" />
                </div>
                <span class="help-inline" style="color:red;">*</span>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">菜单类型</label>
                <div class="col-sm-6">
                    <select name="wm_type" id="wm_type" class="form-control">
                        <?php echo $_smarty_tpl->tpl_vars['typeOption']->value;?>

                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">菜单键值</label>
                <div class="col-sm-6">
                    <input type="text" name="wm_key" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['wm_key'];?>
" placeholder="跳转URL/事件键值" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">排序</label>
                <div class="col-sm-6">
                    <input type="text" name="wm_sort" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['wm_sort'];?>
" placeholder="排序" datatype="n" nullmsg="请填写排序号" />
                </div>
                <span class="help-inline" style="color:red;">*</span>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">状态</label>
                <div class="col-sm-6">
                    <select name="wm_status" id="wm_status" datatype="*" nullmsg="请选择状态" class="form-control">
                        <?php echo $_smarty_tpl->tpl_vars['statusOption']->value;?>

                    </select>
                </div>
                <span class="help-inline" style="color:red;">*</span>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            <button type="submit" class="btn btn-primary btn-submit"><?php if ($_smarty_tpl->tpl_vars['row']->value['wm_id']) {?>确认修改<?php } else { ?>确认添加<?php }?></button>
        </div>
    </div>
</div>
<?php }
}
?>