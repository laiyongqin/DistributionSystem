<?php /* Smarty version 3.1.27, created on 2016-08-26 10:02:50
         compiled from "/mnt/www/oss.fenxiao.com/application/views/default/weichatsub/index.html" */ ?>
<?php
/*%%SmartyHeaderCode:152137362057bfa34a013ef5_74449545%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2ef5f8262532afc1fd990c11bf623c149b187ebc' => 
    array (
      0 => '/mnt/www/oss.fenxiao.com/application/views/default/weichatsub/index.html',
      1 => 1472091246,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '152137362057bfa34a013ef5_74449545',
  'variables' => 
  array (
    'typeList' => 0,
    'vo' => 0,
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57bfa34a0a7588_95681033',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57bfa34a0a7588_95681033')) {
function content_57bfa34a0a7588_95681033 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '152137362057bfa34a013ef5_74449545';
echo $_smarty_tpl->getSubTemplate ("common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


<div class="main">
    <?php echo $_smarty_tpl->getSubTemplate ("common/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


    <div id="right">
        <!--面包屑导航-->
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);">微信管理 </a></li>
            <li class="active">微信公招管理管理</li>
        </ol>

        <div class="right_con">
            <div class="tabbable" >
                <ul class="nav nav-tabs">
                    <?php
$_from = $_smarty_tpl->tpl_vars['typeList']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['vo'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['vo']->_loop = false;
$_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['vo']->value) {
$_smarty_tpl->tpl_vars['vo']->_loop = true;
$foreach_vo_Sav = $_smarty_tpl->tpl_vars['vo'];
?>
                    <li class="active"><a href="javascript:void(0);" ><?php echo $_smarty_tpl->tpl_vars['vo']->value;?>
</a></li>
                    <?php
$_smarty_tpl->tpl_vars['vo'] = $foreach_vo_Sav;
}
?>
                </ul>
                <div class="tab-content">
                    <form class="form-horizontal" id="form-save" action="/weichatsub/save/">
                        <div class="tab-pane active" id="basic_right" style="padding-top: 50px;">
                            <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['wc_id'];?>
" />
                            <div class="form-group">
                                <label class="col-sm-2 control-label">微信appid</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="wc_appid" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['wc_appid'];?>
" placeholder="微信appid" datatype="*" nullmsg="请填写微信appid"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">微信appsecret</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="wc_appsecret" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['wc_appsecret'];?>
" placeholder="微信appsecret" datatype="*" nullmsg="请填写微信appsecret"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">微信token</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="wc_apptoken" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['wc_apptoken'];?>
" placeholder="微信token" datatype="*" nullmsg="微信token"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">商户ID</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="wc_mch_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['wc_mch_id'];?>
" placeholder="商户ID" datatype="*" nullmsg="请填写支付密钥"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">商户支付密钥</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="wc_pay_key" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['wc_pay_key'];?>
" placeholder="商户支付密钥" datatype="*" nullmsg="请填写商户支付密钥"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">sslcert证书路径</label>
                                <div class="col-sm-4 ">
                                    <input type="file" name="upload" id="upload" onchange="return ajaxFileUpload();" />
                                    <?php if ($_smarty_tpl->tpl_vars['data']->value['wc_sslcert_path']) {?>
                                    <div style="padding-top:10px;" id="ssl_cert"><?php echo $_smarty_tpl->tpl_vars['data']->value['wc_sslcert_path'];?>
</div>
                                    <input type="hidden" name="wc_sslcert_path" id="file"  value="<?php echo $_smarty_tpl->tpl_vars['data']->value['wc_sslcert_path'];?>
"/>
                                    <?php } else { ?>
                                    <input type="hidden" name="wc_sslcert_path" id="file"  />
                                    <div style="padding-top:10px;" id="ssl_cert"></div>
                                    <?php }?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">sslkey证书路径</label>
                                <div class="col-sm-4 ">
                                    <input type="file" name="upload2" id="upload2" onchange="return ajaxFileUpload2();" />
                                    <?php if ($_smarty_tpl->tpl_vars['data']->value['wc_sslkey_path']) {?>
                                    <div style="padding-top:10px;" id="ssl_key"><?php echo $_smarty_tpl->tpl_vars['data']->value['wc_sslkey_path'];?>
</div>
                                    <input type="hidden" name="wc_sslkey_path" id="file2"  value="<?php echo $_smarty_tpl->tpl_vars['data']->value['wc_sslkey_path'];?>
" />
                                    <?php } else { ?>
                                    <input type="hidden" name="wc_sslkey_path" id="file2" />
                                    <div style="padding-top:10px;" id="ssl_key"></div>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-4">
                                <button class="btn btn-primary" type="submit">保存</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>
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
            url:'/weichatsub/upload/',
            secureuri:false,
            fileElementId:'upload',
            dataType: 'json',
            success: function (data, status){
                setTimeout( function() {
                    processing = false;
                }, 500);
                dialog.close();

                if ( data.status == 'y' ) {
                    $("#ssl_cert").html(data.info.path);
                    $('#file').val(data.info.path);
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

    $("#upload2").customFileInput();

    var processing = false;
    function ajaxFileUpload2() {
        if ( processing == true ) {
            return false;
        }

        var dialog = $.dialog.loading('上传中，请稍等！').show();
        processing = true;
        $.ajaxFileUpload({
            url:'/weichatsub/upload2/',
            secureuri:false,
            fileElementId:'upload2',
            dataType: 'json',
            success: function (data, status){
                setTimeout( function() {
                    processing = false;
                }, 500);
                dialog.close();

                if ( data.status == 'y' ) {
                    $("#ssl_key").html(data.info.path);
                    $('#file2').val(data.info.path);
                    return;
                }else{
                    alert(data.info.msg);
                }

                return false;
            },
            error: function (data, status, e){
                $.dialog.error(e);
            }
        });
    }

<?php echo '</script'; ?>
>
<?php echo $_smarty_tpl->getSubTemplate ("common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);

}
}
?>