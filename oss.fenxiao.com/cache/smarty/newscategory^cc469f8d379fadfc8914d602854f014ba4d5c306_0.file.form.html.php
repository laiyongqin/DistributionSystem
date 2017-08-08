<?php /* Smarty version 3.1.27, created on 2016-09-06 15:58:47
         compiled from "/mnt/www/oss.fenxiao.com/application/views/default/newscategory/form.html" */ ?>
<?php
/*%%SmartyHeaderCode:136307295557ce77375ea304_77828511%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cc469f8d379fadfc8914d602854f014ba4d5c306' => 
    array (
      0 => '/mnt/www/oss.fenxiao.com/application/views/default/newscategory/form.html',
      1 => 1471418965,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '136307295557ce77375ea304_77828511',
  'variables' => 
  array (
    'id' => 0,
    'nc_id' => 0,
    'categoryOption' => 0,
    'nc_name' => 0,
    'nc_alias' => 0,
    'nc_sort' => 0,
    'statusOption' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57ce773765c523_42856796',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57ce773765c523_42856796')) {
function content_57ce773765c523_42856796 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '136307295557ce77375ea304_77828511';
?>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="passportModalLabel"><?php if ($_smarty_tpl->tpl_vars['id']->value) {?>修改分类<?php } else { ?>添加分类<?php }?></h4>
        </div>
        <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['nc_id']->value;?>
" />
        <div class="modal-body">
            <div class="alert alert-dismissible" role="alert" style="display: none;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong></strong>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">上级分类</label>
                <div class="col-sm-6">
                    <select name="nc_parent_id" id="nc_parent_id" class="form-control" >
                        <?php echo $_smarty_tpl->tpl_vars['categoryOption']->value;?>

                    </select>
                </div>
                <span class="help-inline" style="color:red;">*</span>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">分类名称</label>
                <div class="col-sm-6">
                    <input type="text" name="nc_name" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['nc_name']->value;?>
" placeholder="分类名称" datatype="*" nullmsg="请填写分类名称" />
                </div>
                <span class="help-inline" style="color:red;">*</span>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">别名</label>
                <div class="col-sm-6">
                    <input type="text" name="nc_alias" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['nc_alias']->value;?>
" placeholder="分类别名" datatype="*" nullmsg="请填写分类别名" />
                </div>
                <span class="help-inline" style="color:red;">*</span>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">排序</label>
                <div class="col-sm-6">
                    <input type="text" name="nc_sort" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['nc_sort']->value;?>
" placeholder="排序" datatype="*" nullmsg="请填写排序" />
                </div>
                <span class="help-inline" style="color:red;">*</span>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">状态</label>
                <div class="col-sm-6">
                    <select name="nc_status" id="nc_status" datatype="*" nullmsg="请选择状态" class="form-control">
                        <?php echo $_smarty_tpl->tpl_vars['statusOption']->value;?>

                    </select>
                </div>
                <span class="help-inline" style="color:red;">*</span>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            <button type="submit" class="btn btn-primary btn-submit">确认修改</button>
        </div>

    </div>
</div>
<?php }
}
?>