<?php /* Smarty version 3.1.27, created on 2016-08-26 16:56:38
         compiled from "/mnt/www/oss.fenxiao.com/application/views/default/ads/form.html" */ ?>
<?php
/*%%SmartyHeaderCode:196622747057c0044675d3d2_78143765%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4175fb9dd9b030cd04a6239b8d2f5e97a7d2f01a' => 
    array (
      0 => '/mnt/www/oss.fenxiao.com/application/views/default/ads/form.html',
      1 => 1471490419,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '196622747057c0044675d3d2_78143765',
  'variables' => 
  array (
    'id' => 0,
    'row' => 0,
    'statusOption' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57c004467da4d8_43654287',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57c004467da4d8_43654287')) {
function content_57c004467da4d8_43654287 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '196622747057c0044675d3d2_78143765';
?>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="passportModalLabel"><?php if ($_smarty_tpl->tpl_vars['id']->value) {?>修改广告<?php } else { ?>添加广告<?php }?></h4>
        </div>
        <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['a_id'];?>
" />
        <div class="modal-body">
            <div class="alert alert-dismissible" role="alert" style="display: none;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong></strong>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">标题</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="a_title" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['a_title'];?>
" placeholder="banner名称" datatype="*" nullmsg="请填写banner名称" style="width: 300px;"/>
                </div>
                <span class="help-inline" style="margin-left: 20px;color:red;">*</span>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">封面图</label>
                <div class="col-sm-6">
                    <input type="file" name="upload" id="upload" onchange="return ajaxFileUpload();" />
                    <div style="padding-top:10px;"><img src="<?php if ($_smarty_tpl->tpl_vars['row']->value['a_picture']) {
echo $_smarty_tpl->tpl_vars['row']->value['a_picture'];
}?>" id="upload-img" style="max-width:300px;<?php if (!$_smarty_tpl->tpl_vars['row']->value['a_picture']) {?>display:none;<?php }?>"/></div>
                    <input type="hidden" name="a_picture" id="file" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['a_picture'];?>
"  datatype="*" nullmsg="请提交广告图片"/>
                </div>
                <span class="help-inline" style="margin-left: 20px;color:red;">*</span>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">别名</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="a_alias" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['a_alias'];?>
" placeholder="别名" style="width: 200px;" <?php if ($_smarty_tpl->tpl_vars['row']->value['a_id']) {?>readonly<?php }?>/>
                </div>
                <span class="help-inline" style="margin-left: 20px;color:red;">*</span>
            </div>


            <div class="form-group">
                <label class="col-sm-2 control-label">链接地址</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="a_link" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['a_link'];?>
" placeholder="链接地址" datatype="url" nullmsg="请填写地址" style="width: 300px;"/>
                </div>
                <span class="help-inline" style="margin-left: 20px;color:red;">*</span>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">状态</label>
                <div class="col-sm-6">
                    <select datatype="*"  nullmsg="请选择状态" id="a_status" name="a_status" class="form-control" style="width:200px;">
                        <?php echo $_smarty_tpl->tpl_vars['statusOption']->value;?>

                    </select>
                </div>
                <span class="help-inline" style="margin-left: 20px;color:red;">*</span>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            <button type="submit" class="btn btn-primary btn-submit">确认修改</button>
        </div>
    </div>
</div>

<?php echo '<script'; ?>
 src="/public/js/umeditor/umeditor.config.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/public/js/umeditor/umeditor.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/public/js/umeditor/lang/zh-cn/zh-cn.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/public/js/jquery.ajaxfileupload.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/public/js/bootstrap-customfile.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/public/js/bootstrap-datetimepicker.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
    var editor =  '';

    $(function(){
        editor = UM.getEditor('n_content');
    });

    $("#form-save").Validform({
        ajaxPost: true,
        tipSweep: true,
        tiptype:function(msg,o,cssctl){
            if(o.type == 3)
                $.dialog.tips(msg);
        },
        beforeSubmit:function(curform){
        },
        callback:function(response){
            $.dialog.tips(response.info);
            if ( response.status == 'y' ) {
                window.setTimeout(function(){
                    location.reload();
                }, 2000)
            }
        }
    });

    /*初始化上传文件*/
    $("#upload").customFileInput();
    var processing = false;
    function ajaxFileUpload() {
        if ( processing == true ) {
            return false;
        }

        var dialog     = $.dialog.loading('上传中，请稍等！').show();
        processing = true;
        $.ajaxFileUpload({
            url:'/ads/upload/',
            secureuri:false,
            fileElementId:'upload',
            dataType: 'json',
            success: function (data, status){
                setTimeout( function() {
                    processing = false;
                }, 500);
                dialog.close();

                if ( data.status == 'y' ) {
                    $("#upload-img").attr('src', data.info.url).show();
                    $('#file').val(data.info.url);
                    return;
                }

                $.dialog.error(data.info);
                return false;
            },
            error: function (data, status, e){
                $.dialog.error(e);
            }
        });
    }
<?php echo '</script'; ?>
>
<?php }
}
?>