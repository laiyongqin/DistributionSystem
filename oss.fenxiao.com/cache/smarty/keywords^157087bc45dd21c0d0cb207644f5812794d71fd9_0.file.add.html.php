<?php /* Smarty version 3.1.27, created on 2016-09-29 11:29:32
         compiled from "/mnt/www/oss.fenxiao.com/application/views/default/keywords/add.html" */ ?>
<?php
/*%%SmartyHeaderCode:173482189357ec8a9c90c989_89966241%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '157087bc45dd21c0d0cb207644f5812794d71fd9' => 
    array (
      0 => '/mnt/www/oss.fenxiao.com/application/views/default/keywords/add.html',
      1 => 1471510053,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '173482189357ec8a9c90c989_89966241',
  'variables' => 
  array (
    'row' => 0,
    'keywordsType' => 0,
    'statusType' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57ec8a9cabd042_21322888',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57ec8a9cabd042_21322888')) {
function content_57ec8a9cabd042_21322888 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '173482189357ec8a9c90c989_89966241';
echo $_smarty_tpl->getSubTemplate ("common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

<style>
    .news{display:none;}
</style>
<div class="main">
    <?php echo $_smarty_tpl->getSubTemplate ("common/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


    <div id="right">
        <!--面包屑导航-->
        <ol class="breadcrumb">
            <li><a href="/keywords/index/">关键字回复配置 </a></li>
            <li class="active">配置详情</li>
        </ol>

        <div class="right_con">

            <form class="form-horizontal" id="form-save" action="/keywords/save/">
                <div class="tab-pane active" id="basic_right">
                    <input type="hidden" name="k_id" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['k_id'];?>
">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">关键字</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="k_keys" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['k_keys'];?>
" placeholder="关键字"  />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">标题</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="k_title" value='<?php echo $_smarty_tpl->tpl_vars['row']->value['k_title'];?>
' placeholder="标题" datatype="*" nullmsg="请填写关键字标题" style="width:500px;" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">所属内容类别</label>
                        <div class="col-sm-2"><select class="form-control" name="k_type" id="k_type" datatype="*" nullmsg="请选择内容类别"><?php echo $_smarty_tpl->tpl_vars['keywordsType']->value;?>
</select></div>
                    </div>

                    <div class="form-group news" >
                        <label class="col-sm-2 control-label">跳转链接</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="k_url" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['k_url'];?>
" placeholder="跳转链接"  />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">内容</label>
                        <div class="col-sm-6">
                            <textarea name="k_content" style="width:600px;height: 120px;" rows="6"  datatype="*" nullmsg="请填写关键字内容"><?php echo $_smarty_tpl->tpl_vars['row']->value['k_content'];?>
</textarea>
                        </div>
                    </div>
                    <div class="form-group news">
                        <label class="col-sm-2 control-label">缩略图</label>
                        <div class="col-sm-6">
                            <input type="file" name="upload" id="upload" onchange="return ajaxFileUpload();" />

                            <?php if ($_smarty_tpl->tpl_vars['row']->value['k_thumb']) {?>
                            <div style="padding-top:10px;"><img src="<?php echo @constant('APP_IMAGE_URL');
echo $_smarty_tpl->tpl_vars['row']->value['k_thumb'];?>
" id="upload-img" style="max-width:200px;"/></div>
                            <input type="hidden" name="file" id="file" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['k_thumb'];?>
" />
                            <?php } else { ?>
                            <input type="hidden" name="file" id="file"  />
                            <div style="padding-top:10px;"><img src="" id="upload-img" style="max-width:200px; display:none"/></div>
                            <?php }?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">状态</label>
                        <div class="col-sm-2">
                            <select class="form-control" name="k_status" datatype="*" null="请选择状态"><?php echo $_smarty_tpl->tpl_vars['statusType']->value;?>
</select>
                        </div>
                    </div>


                </div>

                <div class="form-group">
                    <label class="control-label"></label>
                    <div class="controls">
                        <button class="btn btn-primary" type="submit">保存</button>
                    </div>
                </div>
            </form>
        </div>

        <!--&lt;!&ndash;弹窗&ndash;&gt;-->
        <!--<form class="form-horizontal" action="/ajax/productlight/save/" method="post">-->
        <!--<div class="modal fade" id="adminModal" tabindex="-1" role="dialog"></div>-->
        <!--</form>-->
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
    var loading = $.dialog.loading('注意：正在导入数据，请耐心等待，千万不要关闭或者刷新页面！').hide();

    $('#k_type').change(function(){
        if($(this).val() == 'news'){
            $('.news').show();
        }else{
            $('.news').hide();
        }
    })

    $(document).ready(function(){
        if($('#k_type').val() == 'news'){
            $('.news').show();
        }else{
            $('.news').hide();
        }
    })


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
                    window.location.href = "/keywords/index/";

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
            url:'/keywords/upload',
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
                    $('#file').val(data.info.fileName);
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
<?php echo $_smarty_tpl->getSubTemplate ("common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);

}
}
?>