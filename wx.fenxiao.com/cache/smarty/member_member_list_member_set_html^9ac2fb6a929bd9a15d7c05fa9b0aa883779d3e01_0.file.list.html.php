<?php /* Smarty version 3.1.27, created on 2016-08-20 16:59:28
         compiled from "/mnt/www/wx.fenxiao.com/application/modules/Member/views/member/list.html" */ ?>
<?php
/*%%SmartyHeaderCode:190219402457b81bf0223342_84312653%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9ac2fb6a929bd9a15d7c05fa9b0aa883779d3e01' => 
    array (
      0 => '/mnt/www/wx.fenxiao.com/application/modules/Member/views/member/list.html',
      1 => 1471683504,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '190219402457b81bf0223342_84312653',
  'variables' => 
  array (
    'pageTitle' => 0,
    'userData' => 0,
    'promoterNumber' => 0,
    'smid' => 0,
    'promoterList' => 0,
    'v' => 0,
    'total' => 0,
    'pageSize' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57b81bf02916a8_83433176',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57b81bf02916a8_83433176')) {
function content_57b81bf02916a8_83433176 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '190219402457b81bf0223342_84312653';
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?php echo $_smarty_tpl->tpl_vars['pageTitle']->value;?>
</title>
    <link rel="stylesheet" type="text/css" href="/public/css/style.css">
    <link rel="stylesheet" type="text/css" href="/public/css/iconfont.css">
    <link rel="stylesheet" type="text/css" href="/public/css/dropload.css">
</head>
<style>
    .dropload-down{position: absolute;bottom:-13vw; width:200px;margin:0 0 0 -100px;left:50%;text-align: center;}
</style>
<body>
<?php echo $_smarty_tpl->getSubTemplate ("application/views/common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

<div class="member-header">
    <a class="set" href="member_set.html"><i class="icon iconfont">&#xe626;</i></a>
    <i class="shadow"></i>
    <div class="user">
        <div class="img">
            <p><?php echo $_smarty_tpl->tpl_vars['userData']->value['m_nickname'];?>
</p>
            <img src="<?php echo $_smarty_tpl->tpl_vars['userData']->value['m_avatar'];?>
"></div>
    </div>
</div>

<div class="orders-list2">
    <div class="title">我是代言人：<span>一级代言人(<?php echo $_smarty_tpl->tpl_vars['promoterNumber']->value;?>
)人</span></div>
    <!-- 搜索 -->
    <div class="search">
        <form action="/member/member/list/?mid=<?php echo $_smarty_tpl->tpl_vars['userData']->value['m_id'];?>
" id="searchFrom" method="post">
            <i><img src="http://static.comylife.com//private/life/index/images/home_search_icon.png"></i>
            <input name="smid" type="text" value="<?php if ($_smarty_tpl->tpl_vars['smid']->value) {
echo $_smarty_tpl->tpl_vars['smid']->value;
} else {
}?>" placeholder="请输入会员ID">
        </form>
    </div>
    <ul id="promoter_list" style="position: relative;">
        <?php if ($_smarty_tpl->tpl_vars['promoterList']->value) {?>
        <?php
$_from = $_smarty_tpl->tpl_vars['promoterList']->value;
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
            <img src="<?php echo @constant('IMAGE_URL');
echo $_smarty_tpl->tpl_vars['v']->value['m_avatar'];?>
" width="185" height="185">
            <div class="text">
                <p>昵称：<?php echo $_smarty_tpl->tpl_vars['v']->value['m_nickname'];?>
</p>
                <p>会员：<?php if ($_smarty_tpl->tpl_vars['v']->value['m_vip'] == 2) {?>是<?php } else { ?>否<?php }?></p>
                <p>关注时间：<?php echo $_smarty_tpl->tpl_vars['v']->value['m_addtime'];?>
</p>
                <p>会员ID：<?php echo $_smarty_tpl->tpl_vars['v']->value['sp_spokesman'];?>
</p>
            </div>
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
 src="/public/js/dropload.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
    $(document).ready(function(){
        var page = 2;
        var total    = parseInt('<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
');
        var pageSize = parseInt('<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
');
        var mid      = parseInt('<?php echo $_smarty_tpl->tpl_vars['userData']->value['m_id'];?>
');
        var smid     = parseInt('<?php echo $_smarty_tpl->tpl_vars['smid']->value;?>
');
        if(total >= pageSize) {
            $("#promoter_list").dropload({
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
                        url : "/member/member/list/?type=load&page=" + page + '&mid=' + mid + '&smid=' + smid,
                        dataType: 'html',
                        success: function(data){
                            if(data) {
                                //赋值数据
                                $("#promoter_list").append(data);
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
<?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
?>