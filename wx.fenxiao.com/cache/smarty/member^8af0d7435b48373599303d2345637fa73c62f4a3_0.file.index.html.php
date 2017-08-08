<?php /* Smarty version 3.1.27, created on 2016-11-25 17:54:37
         compiled from "/mnt/www/wx.fenxiao.com/application/modules/Member/views/withdraw/index.html" */ ?>
<?php
/*%%SmartyHeaderCode:89373416158380a5d944719_10346733%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8af0d7435b48373599303d2345637fa73c62f4a3' => 
    array (
      0 => '/mnt/www/wx.fenxiao.com/application/modules/Member/views/withdraw/index.html',
      1 => 1480067677,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '89373416158380a5d944719_10346733',
  'variables' => 
  array (
    'userData' => 0,
    'wealth' => 0,
    'data' => 0,
    'v' => 0,
    'total' => 0,
    'pageSize' => 0,
    'type' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_58380a5d9e3415_41668569',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_58380a5d9e3415_41668569')) {
function content_58380a5d9e3415_41668569 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '89373416158380a5d944719_10346733';
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>提现</title>
    <link rel="stylesheet" type="text/css" href="/public/css/style.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/dropload.min.css">
</head>
<style>
    .dropload-down{position: absolute;bottom:-13vw; width:200px;margin:0 0 0 -100px;left:50%;text-align: center;}
    #cash_list{position: relative;}
</style>
<body>
<?php echo $_smarty_tpl->getSubTemplate ("application/views/common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


<div class="member-header">
    <a class="set" href="/member/profile/index"><i class="icon iconfont">&#xe73a;</i></a>
    <i class="shadow"></i>
    <div class="user">
        <div class="img">
            <p><?php echo $_smarty_tpl->tpl_vars['userData']->value['m_nickname'];?>
</p>
            <img src="<?php echo $_smarty_tpl->tpl_vars['userData']->value['m_avatar'];?>
"></div>
    </div>
</div>

<div class="cash">
    <ul>
        <li><i class="icon iconfont">&#xe785;</i><span>提现金额：</span><input name="pw_money" type="number" placeholder="可提现的金额<?php echo $_smarty_tpl->tpl_vars['wealth']->value;?>
元"></li>
    </ul>
    <input type="hidden" name="m_id" value="<?php echo $_smarty_tpl->tpl_vars['userData']->value['m_id'];?>
">
    <input type="button" class="btn" id="btn" value="确定提交">
</div>

<div class="cash-form">
    <div class="title">
        <span>编号</span>
        <span>金额</span>
        <span>状态</span>
    </div>
    <ul id="cash_list">
        <?php if ($_smarty_tpl->tpl_vars['data']->value) {?>
        <?php
$_from = $_smarty_tpl->tpl_vars['data']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['v'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['v']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
$foreach_v_Sav = $_smarty_tpl->tpl_vars['v'];
?>
        <li>
            <span><?php echo $_smarty_tpl->tpl_vars['v']->value['pw_id'];?>
</span>
            <span><?php echo $_smarty_tpl->tpl_vars['v']->value['pw_money'];?>
</span>
            <?php if ($_smarty_tpl->tpl_vars['v']->value['pw_status'] == 1) {?>
            <span class="zt2">进行中...</span>
            <?php } elseif ($_smarty_tpl->tpl_vars['v']->value['pw_status'] == 2) {?>
            <span class="zt1">提现成功</span>
            <?php } elseif ($_smarty_tpl->tpl_vars['v']->value['pw_status'] == 3) {?>
            <span class="zt3">提现失败</span>
            <?php }?>
        </li>
        <?php
$_smarty_tpl->tpl_vars['v'] = $foreach_v_Sav;
}
?>
        <?php }?>
    </ul>
    <p class="down"></p>
</div>

<?php echo '<script'; ?>
 src="/public/js/jquery-2.1.4.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/public/js/jquery-weui.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/public/js/dropload.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
    $(document).ready(function(){
        $('#btn').click(function () {
            var pw_money = $("input[name='pw_money']").val();
            var m_id     = $("input[name='m_id']").val();
            if(pw_money==''){
                $.alert('提现金额不能为空');
                return;
            }

            //提交申请
            $.ajax({
                type : 'POST',
                url  : "/ajax/cash/save/",
                data : {action:"cash", m_id:m_id, pw_money:pw_money},
                async: false,
                dataType: "json",
                error: function(request) {
                    $.alert("提交错误,请重试");
                },
                success: function(data) {
                    if(data.status == 'y'){
                        $.alert(data.info);
                        setTimeout("location.reload()", 1000);
                    }else{
                        $.alert(data.info);
                    }
                }
            })

        })

        $(function () {
            //下拉加载
            var page = 2;
            var total    = parseInt('<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
');
            var pageSize = parseInt('<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
');
            var mid      = parseInt('<?php echo $_smarty_tpl->tpl_vars['userData']->value['m_id'];?>
');
            var type      = parseInt('<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
');
            if(total >= pageSize) {
                $("#cash_list").dropload({
                    domDown : {// 下方DOM
                        domClass   : 'dropload-down',
                        domRefresh : '<div class="dropload-refresh">↑上拉加载更多</div>',
                        domLoad    : '<div class="dropload-load"><span class="loading"></span>加载中...</div>',
                        domNoData  : '<div class="dropload-noData">没有啦╮(╯_╰)╭</div>'
                    },
                    scrollArea : window,
                    loadDownFn : function(me){

                        $.ajax({
                            type: 'GET',
                            url : "/member/withdraw/index/?type=load&page=" + page + '&mid=' + mid,
                            dataType: 'html',
                            success: function(data){
                                if(data) {
                                    //赋值数据
                                    $("#cash_list").append(data);
                                    page++;
                                } else {
                                    // 锁定
                                    me.lock();
                                    // 无数据
                                    me.noData();
                                }
                                // 每次数据加载完，必须重置
                                me.resetload();
                            },
                            error: function(xhr, type){
                                // 即使加载出错，也得重置
                                me.resetload();
                            }
                        });
                    }
                });
            }
        })
    })
<?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
?>