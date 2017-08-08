<?php /* Smarty version 3.1.27, created on 2016-09-01 15:34:39
         compiled from "/mnt/www/oss.fenxiao.com/application/views/default/order/expressform.html" */ ?>
<?php
/*%%SmartyHeaderCode:189577653557c7da0fd22037_27597046%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6b5656ead790c815f5949a5f96be8b59fd7f8d50' => 
    array (
      0 => '/mnt/www/oss.fenxiao.com/application/views/default/order/expressform.html',
      1 => 1471687250,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '189577653557c7da0fd22037_27597046',
  'variables' => 
  array (
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57c7da0fd8d912_41395732',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57c7da0fd8d912_41395732')) {
function content_57c7da0fd8d912_41395732 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '189577653557c7da0fd22037_27597046';
?>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="passportModalLabel">快递信息</h4>
        </div>
        <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['o_id'];?>
" />
        <div class="modal-body">
            <div class="alert alert-dismissible" role="alert" style="display: none;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong></strong>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">快递公司</label>
                <div class="col-sm-6">
                    <input type="text" name="o_express_company" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['o_express_company'];?>
" placeholder="快递公司" datatype="*" nullmsg="请填写快递公司" />
                </div>
                <span class="help-inline" style="color:red;">*</span>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">快递单号</label>
                <div class="col-sm-6">
                    <input type="text" name="o_express_number" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['o_express_number'];?>
" placeholder="快递单号" datatype="*" nullmsg="请填写快递单号" />
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