<?php /* Smarty version 3.1.27, created on 2016-08-26 18:13:00
         compiled from "/mnt/www/oss.fenxiao.com/application/views/default/adsgroup/form.html" */ ?>
<?php
/*%%SmartyHeaderCode:195749934557c0162c89df87_10624274%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '00f6792c61544191fde7a1538b9376a07ae6ee0c' => 
    array (
      0 => '/mnt/www/oss.fenxiao.com/application/views/default/adsgroup/form.html',
      1 => 1472206378,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '195749934557c0162c89df87_10624274',
  'variables' => 
  array (
    'id' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57c0162c8ec9f9_22168373',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57c0162c8ec9f9_22168373')) {
function content_57c0162c8ec9f9_22168373 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '195749934557c0162c89df87_10624274';
?>
<div class="modal-dialog" role="document">
    <style>
        #wrap, .display_left{ display: inline-block;width:50%;float: left;padding:0 2%;}
        #choose, .display_right{ display: inline-block;width:50%; float: right;padding:0 10px;margin-top: 8px;}
        .clearafter::after {
            clear: both;
            content: ".";
            display: block;
            font-size: 0;
            height: 0;
            visibility: hidden;
        }
        </style>
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="passportModalLabel"><?php if ($_smarty_tpl->tpl_vars['id']->value) {?>编辑广告组<?php } else { ?>添加广告组<?php }?></h4>
        </div>
        <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['ag_id'];?>
" />
        <div class="modal-body">
            <div class="alert alert-dismissible" role="alert" style="display: none;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong></strong>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">广告组名</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="ag_name" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['ag_name'];?>
" placeholder="广告组名" datatype="*" nullmsg="请填写广告组名" style="width: 300px;"/>
                </div>
                <span class="help-inline" style="margin-left: 20px;color:red;">*</span>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">广告别名</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="ag_cname" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['ag_cname'];?>
" placeholder="广告别名" datatype="*" nullmsg="请填写广告组别名" style="width: 300px;" <?php if ($_smarty_tpl->tpl_vars['row']->value['ag_id']) {?>readonly<?php }?>/>
                </div>
                <span class="help-inline" style="margin-left: 20px;color:red;">*</span>
            </div>

            <div class="control-group clearafter" >
                <label class="control-label display_left" style=" text-align: center;margin:10px 0;">隶属广告列表</label>
                <label class="control-label display_right" style=" text-align: center;margin:10px 0;">已选择广告顺序</label>
            </div>
            <div class="control-group well clearafter">
                <div id="wrap" data="<?php echo $_smarty_tpl->tpl_vars['row']->value['a_ids'];?>
">
                </div>
                <div id="choose" >
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            <button type="submit" class="btn btn-primary btn-submit">确认修改</button>
        </div>
    </div>
</div>

<?php echo '<script'; ?>
>
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

    getAd();

    var aids = $("#wrap").attr('data');
    if ( aids != '' ) {
        aids = aids.split(',');
    }

    function getAd() {
        $("#choose").html('');
        $.getJSON('/adsgroup/getad/', function(json) {
            $("#wrap").html(json.data).find(':checkbox').each(function() {
                for (var i in aids) {
                    if ( aids[i] == $(this).val() ) {
                        $(this).attr('checked', true) ;
                    }
                }

                $(this).bind('change', function() {
                    var $select = $( '#select-' + $(this).val() ).get(0);
                    var has_select = ( typeof $select == 'undefined' || $select.tagName.toUpperCase() != 'DIV') ? false : true
                    if ( $(this).is(':checked') ) {
                        n = $("#choose").find('div').length + 1;
                        ! has_select && $("#choose").append('<div id="select-'+$(this).val()+'"><input name="aid[]" type="hidden" value="'+$(this).val()+ '" /><label><span class="label label-success">'+n+'</span> ' + $(this).parent().text() + '</label></div>' );
                    } else {
                        has_select && $select.remove();
                    }
                });
            });

            for (var i in aids) {
                n = $("#choose").find('div').length + 1;
                $("#choose").append('<div id="select-'+aids[i]+'"><input name="aid[]" type="hidden" value="'+aids[i]+ '" /><label><span class="label label-success">'+n+'</span> ' + $("#wrap").find(":checkbox[value='"+aids[i]+"']").parent().text() + '</label></div>' );
            }
        });
    }

<?php echo '</script'; ?>
>
<?php }
}
?>