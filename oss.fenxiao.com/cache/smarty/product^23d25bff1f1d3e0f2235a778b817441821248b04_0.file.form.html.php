<?php /* Smarty version 3.1.27, created on 2016-08-29 15:07:42
         compiled from "/mnt/www/oss.fenxiao.com/application/views/default/product/form.html" */ ?>
<?php
/*%%SmartyHeaderCode:90566370757c3df3ec1a858_64944192%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '23d25bff1f1d3e0f2235a778b817441821248b04' => 
    array (
      0 => '/mnt/www/oss.fenxiao.com/application/views/default/product/form.html',
      1 => 1471687020,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '90566370757c3df3ec1a858_64944192',
  'variables' => 
  array (
    'menuList' => 0,
    'key' => 0,
    'vo' => 0,
    'row' => 0,
    'categoryOption' => 0,
    'count' => 0,
    'picRow' => 0,
    'pkey' => 0,
    'profileTypeOption' => 0,
    'ppList' => 0,
    'profileType' => 0,
    'pt_id' => 0,
    'ppType' => 0,
    'v' => 0,
    'ppCount' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57c3df3ed0bde7_98347880',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57c3df3ed0bde7_98347880')) {
function content_57c3df3ed0bde7_98347880 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '90566370757c3df3ec1a858_64944192';
echo $_smarty_tpl->getSubTemplate ("common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

<link href="/public/js/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<style>
    #right .nav-tabs { margin-bottom:0;}
    #right .tab-content {  border-top:none; padding:20px 20px 0;}
    .tab-pane{display:none;}
    .tab-pane.active{display:block;}
    .ptInfo_content{margin:20px 0 0 20px;}
    #profileTypeList{margin-top: 10px;}
    .profileType_content{}
    .pp_td{padding: 10px 0;}
    .profile_content .breadcrumb{ background: #dff0d8;}
    .profile_content .breadcrumb a{color:#333;}
    .news{display:none;}
    .img_left { position: relative; float: left; margin-right: 10px;}
    .img_left .order { margin-top: 5px; line-height: 30px;}
    .img_left .order span { margin-right: 5px;}
    .img_left a{ position: absolute; top:15px; right: 5px; width: 20px; height: 20px; border-radius: 999px; background: #fff;}
    .img_left a .glyphicon { left: 2.7px;}
    /*.img_left a { position: absolute; top: 14px; right: 2px; display: block; width: 20px; height: 20px; background: #fff; color: #fff; text-align: center; line-height: 20px; font-size: 12px;  border-radius: 999px; opacity: .8;}*/
    #productProfile .controls { margin-top: 20px; margin-bottom: 10px; padding-bottom: 30px; border-bottom: 1px solid #E8E8E8; overflow: auto;}
    .ppinfo_col { float: left; margin-right: 20px; margin-bottom: 10px;}
    .ppinfo_col span { display: block; float: left; height: 30px; line-height: 30px;}
    .ppinfo_col input { margin-left:4px;}
    .dropdown-menu{z-index: 999!important;}
</style>
<div class="main">
    <?php echo $_smarty_tpl->getSubTemplate ("common/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


    <div id="right">
        <!--面包屑导航-->
        <ol class="breadcrumb">
            <li><a href="/product/index">商品列表管理 </a></li>
            <li class="active">商品详情</li>
        </ol>

        <div class="right_con tabbable" >
            <?php if ($_smarty_tpl->tpl_vars['menuList']->value) {?>
            <ul class="nav nav-tabs">
                <?php
$_from = $_smarty_tpl->tpl_vars['menuList']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['vo'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['vo']->_loop = false;
$_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['__foreach_top'] = new Smarty_Variable(array('iteration' => 0));
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['vo']->value) {
$_smarty_tpl->tpl_vars['vo']->_loop = true;
$_smarty_tpl->tpl_vars['__foreach_top']->value['iteration']++;
$_smarty_tpl->tpl_vars['__foreach_top']->value['first'] = $_smarty_tpl->tpl_vars['__foreach_top']->value['iteration'] == 1;
$foreach_vo_Sav = $_smarty_tpl->tpl_vars['vo'];
?>
                <li <?php if ((isset($_smarty_tpl->tpl_vars['__foreach_top']->value['first']) ? $_smarty_tpl->tpl_vars['__foreach_top']->value['first'] : null)) {?>class="active"<?php }?>><a target="rightTop" tag="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
_right" href="#<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
_right" data-toggle="tab"><?php echo $_smarty_tpl->tpl_vars['vo']->value;?>
</a></li>
                <?php
$_smarty_tpl->tpl_vars['vo'] = $foreach_vo_Sav;
}
?>
            </ul>

            <?php }?>
            <div class="tab-content">
            <form class="form-horizontal" id="form-save" action="/product/save/">
                <div class="tab-pane active" id="basic_right">
                    <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['p_id'];?>
" />
                    <div class="form-group">
                        <label class="col-sm-2 control-label">类型</label>
                        <div class="col-sm-6">
                            <select name="pc_id" id="pc_id" class="form-control" style="width: 200px;">
                                <?php echo $_smarty_tpl->tpl_vars['categoryOption']->value;?>

                            </select>
                        </div>
                        <label style="color:red;"></label>
                        <span class="help-inline"></span>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">标题</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="p_title" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['p_title'];?>
" placeholder="标题" datatype="*" nullmsg="请填写标题" style="width: 400px;"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">原价</label>
                        <div class="col-sm-4">
                            <input type="text" style="width:100px;" class="form-control" name="p_original_price" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['p_original_price'];?>
" placeholder="原价" datatype="*" nullmsg="请填写原价" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">活动价</label>
                        <div class="col-sm-4">
                            <input type="text" style="width:100px;" class="form-control" name="p_event_price" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['p_event_price'];?>
" placeholder="活动价" datatype="*" nullmsg="请填写活动价" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">库存</label>
                        <div class="col-sm-4">
                            <input type="text" style="width:100px;" class="form-control" name="p_stock" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['p_stock'];?>
" placeholder="库存" datatype="*" nullmsg="请填写库存" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">内容</label>
                        <div class="col-sm-4">
                            <textarea name="p_content" id="p_content" style="width:800px;overflow-y:auto;max-height:200px;"><?php echo $_smarty_tpl->tpl_vars['row']->value['p_content'];?>
</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">封面图</label>
                        <div class="col-sm-4 ">
                            <input type="file" name="upload" id="upload" onchange="return ajaxFileUpload();" />
                            <div style="padding-top:10px;"><img src="<?php if ($_smarty_tpl->tpl_vars['row']->value['p_cover']) {
echo $_smarty_tpl->tpl_vars['row']->value['p_cover'];
}?>" id="upload-img" style="max-width:200px;<?php if (!$_smarty_tpl->tpl_vars['row']->value['p_cover']) {?>display:none;<?php }?>"/></div>
                            <input type="hidden" name="p_cover" id="file" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['p_cover'];?>
"  />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">主图</label>
                        <div class="col-sm-4">
                            <input type="hidden" name="uploadImgs" id="uploadImgs" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['count']->value)===null||$tmp==='' ? 0 : $tmp);?>
">
                            <input type="file" name="uploadCover" id="uploadCover" onchange="return ajaxFileUpload2();" />
                            <div id="imagesList">
                                <?php if ($_smarty_tpl->tpl_vars['picRow']->value) {?>
                                <?php
$_from = $_smarty_tpl->tpl_vars['picRow']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['vo'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['vo']->_loop = false;
$_smarty_tpl->tpl_vars['pkey'] = new Smarty_Variable;
foreach ($_from as $_smarty_tpl->tpl_vars['pkey']->value => $_smarty_tpl->tpl_vars['vo']->value) {
$_smarty_tpl->tpl_vars['vo']->_loop = true;
$foreach_vo_Sav = $_smarty_tpl->tpl_vars['vo'];
?>
                                <div id="picRow_<?php echo $_smarty_tpl->tpl_vars['pkey']->value;?>
" class="img_left">
                                    <a href="javascript:void(0);" rel="<?php echo $_smarty_tpl->tpl_vars['pkey']->value;?>
" class="removeImg"><i class="glyphicon glyphicon-remove" rel="<?php echo $_smarty_tpl->tpl_vars['pkey']->value;?>
"></i></a>
                                    <div style="padding-top:10px;"><img src="<?php if ($_smarty_tpl->tpl_vars['vo']->value['pp_url']) {
echo $_smarty_tpl->tpl_vars['vo']->value['pp_url'];
}?>" style="max-width:200px;"/></div>
                                    <div class="order">
                                        <input type="hidden" name="file[]" value="<?php echo $_smarty_tpl->tpl_vars['vo']->value['pp_url'];?>
" />
                                        <span>排序</span><input type="text" name="pp_order[]" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['vo']->value['pp_order'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['key']->value : $tmp);?>
" placeholder="排序号" style="width:50px;"/>
                                    </div>
                                </div>
                                <?php
$_smarty_tpl->tpl_vars['vo'] = $foreach_vo_Sav;
}
?>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">佣金比例（%）</label>
                        <div class="col-sm-4">
                            <input type="text" style="width:100px;" class="form-control" name="p_rate" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['p_rate'];?>
" placeholder="佣金比例" datatype="n" nullmsg="请填写佣金比例" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">排序</label>
                        <div class="col-sm-4">
                            <input type="text" style="width:100px;" class="form-control" name="p_sort" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['p_sort'];?>
" placeholder="排序" datatype="n" nullmsg="请填写排序" />
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="profile_right">
                    <div class="form-group">
                        <div class="col-sm-8">
                            <label style="display: inline-block; float: left;margin:7px 15px 0 0">产品规格:</label>
                            <select name="profileType" id="profileType" class="form-control" style="width:200px; float: left;">
                                <?php echo $_smarty_tpl->tpl_vars['profileTypeOption']->value;?>

                            </select>
                            <a class="btn btn-default" href="javascript:void(0);" role="button" id="addProfileType" style="display: inline-block; float: left;">添加</a>
                        </div>
                    </div>
                    <div id="profileTypeList">
                        <?php if ($_smarty_tpl->tpl_vars['ppList']->value) {?>
                        <?php
$_from = $_smarty_tpl->tpl_vars['profileType']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['vo'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['vo']->_loop = false;
$_smarty_tpl->tpl_vars['pt_id'] = new Smarty_Variable;
foreach ($_from as $_smarty_tpl->tpl_vars['pt_id']->value => $_smarty_tpl->tpl_vars['vo']->value) {
$_smarty_tpl->tpl_vars['vo']->_loop = true;
$foreach_vo_Sav = $_smarty_tpl->tpl_vars['vo'];
?>
                        <?php if (in_array($_smarty_tpl->tpl_vars['pt_id']->value,$_smarty_tpl->tpl_vars['ppType']->value)) {?>

                        <div class="profile_content">
                            <div id="profileType_<?php echo $_smarty_tpl->tpl_vars['pt_id']->value;?>
" style="margin-bottom: 15px;" class="profileType_content">
                                <ul class="breadcrumb">
                                    <li><a href="#"><?php echo $_smarty_tpl->tpl_vars['vo']->value;?>
</a></li>
                                    <li class="active">套餐配置</li>
                                </ul>
                                <table name="ptInfo_<?php echo $_smarty_tpl->tpl_vars['pt_id']->value;?>
" id="ptInfo_<?php echo $_smarty_tpl->tpl_vars['pt_id']->value;?>
" class="ptInfo_content">
                                    <tbody  class="lp_td">
                                    <tr>
                                        <td width="200px">名称</td>
                                        <td width="100px">库存</td>
                                        <td width="100px">操作</td>
                                    </tr>
                                    </tbody>
                                    <tbody id="ppList_<?php echo $_smarty_tpl->tpl_vars['pt_id']->value;?>
">
                                    <?php
$_from = $_smarty_tpl->tpl_vars['ppList']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['v'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['v']->_loop = false;
$_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
$foreach_v_Sav = $_smarty_tpl->tpl_vars['v'];
?>
                                    <?php if ($_smarty_tpl->tpl_vars['v']->value['pt_id'] == $_smarty_tpl->tpl_vars['pt_id']->value) {?>

                                    <tr id="pp_<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
">
                                        <input type="hidden" name="pp_id[<?php echo $_smarty_tpl->tpl_vars['pt_id']->value;?>
][<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['pp_id'];?>
">
                                        <td width="200px"><input class="form-control" type="text" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['pp_name'];?>
"  style="width:180px;" name="pp_name[<?php echo $_smarty_tpl->tpl_vars['pt_id']->value;?>
][<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
]" alue=""></td>
                                        <td width="100px"><input class="form-control" type="text"  value="<?php echo $_smarty_tpl->tpl_vars['v']->value['pp_stock'];?>
" style="width:90px;" name="pp_stock[<?php echo $_smarty_tpl->tpl_vars['pt_id']->value;?>
][<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
]" value=""></td>
                                                                                <td width="100px">
                                            <a class="btn btn-danger" href="javascript:void(0);" role="button" onclick="delProfile(<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
)">删除</a>
                                        </td>
                                    </tr>
                                    <?php }?>
                                    <?php
$_smarty_tpl->tpl_vars['v'] = $foreach_v_Sav;
}
?>

                                    </tbody>
                                    <tr>
                                        <td width="200px" class="pp_td"><a class="btn btn-primary" href="javascript:void(0);" role="button" onclick="addPpInfo(<?php echo $_smarty_tpl->tpl_vars['pt_id']->value;?>
)" style="display: inline-block;">增加一项</a><a class="btn btn-danger" href="javascript:void(0);" role="button" style="display: inline-block;" onclick="delProfileType(<?php echo $_smarty_tpl->tpl_vars['pt_id']->value;?>
)">删除<?php echo $_smarty_tpl->tpl_vars['vo']->value;?>
</a></td>
                                        <td width="100px"></td>
                                        <td width="100px"></td>

                                    </tr>
                                </table>
                            </div>
                        </div>
                        <?php }?>
                        <?php
$_smarty_tpl->tpl_vars['vo'] = $foreach_vo_Sav;
}
?>
                        <?php }?>
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
        </div>

        <!--&lt;!&ndash;弹窗&ndash;&gt;-->
        <!--<form class="form-horizontal" action="/ajax/productlight/save/" method="post">-->
        <!--<div class="modal fade" id="adminModal" tabindex="-1" role="dialog"></div>-->
        <!--</form>-->
    </div>
    <div class="clear"></div>
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
    var count = parseInt('<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
');
    $(function(){
        editor = UM.getEditor('p_content');
        $('#addProfileType').click(function(){
            var pt_id = $('#profileType').val();
            ppCount = ppCount + 1;
            if(!pt_id){
                $.dialog.tips('请选择价格类型');
                return;
            }

            if($('#ptInfo_' + pt_id).length > 0){
                $.dialog.tips('该产品规格已存在，请重新选择');
                return;
            }

            $.ajax({
                type: 'POST',
                url : "/product/addProfile",
                data: {pt_id:pt_id,ppCount : ppCount},
                dataType: 'html',
                success: function(data){
                    if(data) {
                        //赋值数据
                        $('#profileTypeList').append(data);

                    } else {
                        $.dialog.tips('添加失败');
                        return false;
                    }
                }
            });
        })
    });

    var ppCount = parseInt('<?php echo $_smarty_tpl->tpl_vars['ppCount']->value;?>
');
    function addPpInfo(pt_id){
        ppCount = ppCount + 1;
        var html = '';
        html += '<tr id="pp_'+ppCount+'">';
        html += '<input type="hidden" name="pp_id['+pt_id+']['+ppCount+']" value="">';
        html += '<td width="200px"><input class="form-control" type="text" style="width:180px;" name="pp_name['+pt_id+']['+ppCount+']" value=""></td>';
        html += '<td width="100px"><input class="form-control" type="text" style="width:90px;" name="pp_stock['+pt_id+']['+ppCount+']" value=""></td>';
        html += '<td width="200px">';
        html += '<a class="btn btn-danger" href="javascript:void(0);" role="button" onclick="delProfile('+ppCount+')">删除</a>';
        html += '</td>';
        html += '</tr>';

        $('#ppList_'+pt_id).append(html);
    }


    function delProfileType(pt_id){
        if(confirm('确认删除该产品规格吗？')){
            $('#profileType_' + pt_id).remove();
        }
    }

    function delProfile(pp_id){
        if(confirm('确认删除该套餐吗？')){
            $('#pp_' + pp_id).remove();
        }
    }

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
            url:'/product/upload/',
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

    /*初始化上传文件*/
    $("#uploadCover").customFileInput();
    function ajaxFileUpload2() {
        if ( processing == true ) {
            return false;
        }

        var dialog     = $.dialog.loading('上传中，请稍等！').show();
        processing = true;
        $.ajaxFileUpload({
            url:'/product/upload2/',
            secureuri:false,
            fileElementId:'uploadCover',
            dataType: 'json',
            success: function (data, status){
                setTimeout( function() {
                    processing = false;
                }, 500);
                dialog.close();

                if ( data.status == 'y' ) {
                    var html = '';
                    html += '<div id="picRow_'+count+'" class="img_left">';
                    html += '<a href="javascript:void(0);" rel="'+count+'" class="removeImg"><i class="glyphicon glyphicon-remove" rel="'+count+'"></i></a>';
                    html += '<div style="padding-top:10px;"><img src="'+ data.info.url +'" style="max-width:200px;"/></div>';
                    html += '<div class="order">';
                    html += '<input type="hidden" name="file[]" value="'+data.info.url+'" />';
                    html += '<span>排序</span><input type="text" name="pp_order[]" value="" placeholder="排序号" style="width:50px;"/>';
                    html += '</div>';
                    html += '</div>';
                    $('#imagesList').append(html);
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

    $(document).on('click', '.removeImg', function(){
        var rel = $(this).attr('rel');
        $('#picRow_' + rel).remove();
    })

<?php echo '</script'; ?>
>
<?php echo $_smarty_tpl->getSubTemplate ("common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);

}
}
?>