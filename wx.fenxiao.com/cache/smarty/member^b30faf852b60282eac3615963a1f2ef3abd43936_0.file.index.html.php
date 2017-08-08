<?php /* Smarty version 3.1.27, created on 2016-08-20 16:59:29
         compiled from "/mnt/www/wx.fenxiao.com/application/modules/Member/views/data/index.html" */ ?>
<?php
/*%%SmartyHeaderCode:78528017257b81bf17c6c58_36045957%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b30faf852b60282eac3615963a1f2ef3abd43936' => 
    array (
      0 => '/mnt/www/wx.fenxiao.com/application/modules/Member/views/data/index.html',
      1 => 1471682528,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '78528017257b81bf17c6c58_36045957',
  'variables' => 
  array (
    'pageTitle' => 0,
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57b81bf18348a0_78359591',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57b81bf18348a0_78359591')) {
function content_57b81bf18348a0_78359591 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '78528017257b81bf17c6c58_36045957';
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?php echo $_smarty_tpl->tpl_vars['pageTitle']->value;?>
</title>
    <link rel="stylesheet" type="text/css" href="/public/css/weui.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/jquery-weui.css">
    <link rel="stylesheet" type="text/css" href="/public/css/style.css">
    <link rel="stylesheet" type="text/css" href="/public/css/iconfont.css">

</head>

<body>
<?php echo $_smarty_tpl->getSubTemplate ("application/views/common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


<div class="member-header">
    <a class="set" href="/member/data/index"><i class="icon iconfont">&#xe626;</i></a>
    <i class="shadow"></i>
    <div class="user">
        <div class="img">
            <p><?php echo $_smarty_tpl->tpl_vars['data']->value['m_nickname'];?>
</p>
            <img src="<?php echo $_smarty_tpl->tpl_vars['data']->value['m_avatar'];?>
"></div>
    </div>
</div>
<form id="proveForm">
    <input type="hidden" name="m_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['m_id'];?>
">
<div class="set">
    <ul>
        <li><i class="icon iconfont">&#xe625;</i><span>登陆账号：</span><input name="m_username" type="text" placeholder="在此输入您的登陆账号" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['m_username'];?>
"></li>
        <?php if (!$_smarty_tpl->tpl_vars['data']->value['m_username'] && !$_smarty_tpl->tpl_vars['data']->value['m_password']) {?>
        <li><i class="icon iconfont">&#xe619;</i><span>登陆密码：</span><input name="m_password" type="password" placeholder="在此输入您的登录密码"></li>
        <?php } else { ?>
        <li><i class="icon iconfont">&#xe619;</i><span>原始密码：</span><input name="old_password" type="password" placeholder="在此输入您的原始密码"></li>
        <li><i class="icon iconfont">&#xe619;</i><span>新密码：</span><input name="new_password" type="password" placeholder="在此输入您的新密码"></li>
        <?php }?>
        <!--<li><i class="icon iconfont">&#xe61a;</i><span>头像设置：</span>-->
            <!--<div class="tx"><img id="openImg" src="<?php echo $_smarty_tpl->tpl_vars['data']->value['m_avatar'];?>
" style="width:55px;height:55px;"/></div>-->
            <!--<input type="hidden" name="m_avatar" id="m_avatar" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['m_avatar'];?>
" />-->
            <!--<a class="upload"><input accept="image/*" type="file" id="upload"></a>-->
        <!--</li>-->
    </ul>
    <input type="button" class="btn" id="btn" value="确定提交">
</div>
</form>
<?php echo '<script'; ?>
 src="/public/js/jquery-2.1.4.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/public/js/jquery-weui.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/public/js/lrz_index1.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/public/js/lrz_index2.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
    $(document).ready(function(){

        $('#btn').click(function(){
            var m_username = $("input[name='m_username']").val();
            var m_password = $("input[name='m_password']").val();

            var old_password = $("input[name='old_password']").val();
            var new_password = $("input[name='new_password']").val();
//            var m_avatar = $("input[name='m_avatar']").val();
            var m_id = $("input[name='m_id']").val();

            //账户不能为中文
            if(m_username.length!=0){
                if(m_username.match(/^[\u4e00-\u9fa5]+$/)){
                    $.alert('用户名不能为中文');
                    return;
                }
            }else{
                $.alert('用户名不能为空');
                return;
            }
            //密码不能为空
            if(m_password==''){
                $.alert('密码不能为空');
                return;
            }
            //原始密码不能为空
            if(old_password==''){
                $.alert('原始密码不能为空');
                return;
            }
            //新密码不能为空
            if(new_password==''){
                $.alert('新密码不能为空');
                return;
            }
            //头像不能为空
//            if(m_avatar==''){
//                $.alert('头像不能为空');
//                return;
//            }
            getData(m_id,m_username,m_password,old_password,new_password);
        });

        //提交数据
        function getData(m_id,m_username,m_password,old_password,new_password){
            $.ajax({
                cache: true,
                type: "POST",
                url:'/ajax/data/save',
                data:{action:"data", m_id:m_id,m_username:m_username,m_password:m_password,old_password:old_password,new_password:new_password},// 你的formid
                async: false,
                dataType: "json",
                error: function(request) {
                    $.alert("提交错误,请重试");
                },
                success: function(data) {
                    if(data.status == 'y'){
                        $.alert(data.info);
                        setTimeout(" location.href = '/member/member/index';", 1000);
                    }else{
                        alert(data.info);
                    }
                }
            });
        }
    });
//
//    function ajaxFileUpload(submitData) {
//        $.ajax({
//            type: "POST",
//            url: "/member/data/upload",
//            data: submitData,
//            dataType:"json",
//            success: function(data){
//                if(data.status == 'y'){
//                    $('#openImg').attr('src', data.info.http);
//                    $('#m_avatar').val(data.info.http);
//                    return;
//                }else{
//                    alert(data.info);
//                }
//            },
//        });
//    }
//    document.getElementById('upload').addEventListener('change', function () {
//        var that = this;
//        lrz(that.files[0], {
//            width: 800
//        })
//        .then(function (rst) {
//            var submitData={
//                image:rst.base64,
//                name:rst.origin.name,
//                fileLength:rst.base64.length
//            };
//
//            ajaxFileUpload(submitData);
//
//            return rst;
//        });
//    });
<?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
?>