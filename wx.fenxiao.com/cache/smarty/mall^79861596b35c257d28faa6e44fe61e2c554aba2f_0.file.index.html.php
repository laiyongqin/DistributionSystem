<?php /* Smarty version 3.1.27, created on 2016-11-25 17:52:57
         compiled from "/mnt/www/wx.fenxiao.com/application/modules/Mall/views/news/index.html" */ ?>
<?php
/*%%SmartyHeaderCode:602449959583809f9a759d4_69372551%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '79861596b35c257d28faa6e44fe61e2c554aba2f' => 
    array (
      0 => '/mnt/www/wx.fenxiao.com/application/modules/Mall/views/news/index.html',
      1 => 1480067576,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '602449959583809f9a759d4_69372551',
  'variables' => 
  array (
    'adList' => 0,
    'vo' => 0,
    'cateList' => 0,
    'v' => 0,
    'alias' => 0,
    'allData' => 0,
    'total' => 0,
    'pageSize' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_583809f9ae90e8_07286687',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_583809f9ae90e8_07286687')) {
function content_583809f9ae90e8_07286687 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '602449959583809f9a759d4_69372551';
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>新闻资讯</title>
    <link rel="stylesheet" type="text/css" href="/public/css/dropload.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/swiper.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/style.min.css">
</head>

<body>
<?php echo $_smarty_tpl->getSubTemplate ("application/views/common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

<!-- banner -->
<div class="swiper-container banner">
    <div class="swiper-wrapper">
        <?php if ($_smarty_tpl->tpl_vars['adList']->value) {?>
        <?php
$_from = $_smarty_tpl->tpl_vars['adList']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['vo'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['vo']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['vo']->value) {
$_smarty_tpl->tpl_vars['vo']->_loop = true;
$foreach_vo_Sav = $_smarty_tpl->tpl_vars['vo'];
?>
        <div class="swiper-slide"><a href="<?php echo $_smarty_tpl->tpl_vars['vo']->value['a_link'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['vo']->value['a_picture'];?>
"></a></div>
        <?php
$_smarty_tpl->tpl_vars['vo'] = $foreach_vo_Sav;
}
?>
        <?php }?>
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
</div>
<!-- menu -->
<div class="menu">
    <?php if ($_smarty_tpl->tpl_vars['cateList']->value) {?>
    <?php
$_from = $_smarty_tpl->tpl_vars['cateList']->value;
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
    <a <?php if ($_smarty_tpl->tpl_vars['v']->value['nc_alias'] == $_smarty_tpl->tpl_vars['alias']->value) {?>class="on"<?php }?> href="/mall/news/index?alias=<?php echo $_smarty_tpl->tpl_vars['v']->value['nc_alias'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['nc_name'];?>
</a>
    <?php
$_smarty_tpl->tpl_vars['v'] = $foreach_v_Sav;
}
?>
    <?php }?>
</div>

<div class="news-list">
    <ul id="newsList">
        <?php if ($_smarty_tpl->tpl_vars['allData']->value) {?>
        <?php
$_from = $_smarty_tpl->tpl_vars['allData']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['vo'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['vo']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['vo']->value) {
$_smarty_tpl->tpl_vars['vo']->_loop = true;
$foreach_vo_Sav = $_smarty_tpl->tpl_vars['vo'];
?>
        <li><a href="/mall/news/details/id/<?php echo $_smarty_tpl->tpl_vars['vo']->value['n_id'];?>
"><i class="icon iconfont">&#xe78f;</i><?php echo $_smarty_tpl->tpl_vars['vo']->value['n_title'];?>
</a></li>
        <?php
$_smarty_tpl->tpl_vars['vo'] = $foreach_vo_Sav;
}
?>
        <?php }?>
    </ul>
</div>


<?php echo '<script'; ?>
 src="/public/js/jquery-2.1.4.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/public/js/swiper.jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/public/js/dropload.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/public/js/weui/jquery-weui.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>

    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        paginationClickable: true,
        spaceBetween: 30,
        centeredSlides: true,
        autoplay: 5000,
        autoplayDisableOnInteraction: false
    });

    $(document).ready(function(){
        var page = 2;
        var total = parseInt('<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
');
        var pageSize = parseInt('<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
');
        if(total >= pageSize) {
            $("#list").dropload({
                domDown : {                                                          // 下方DOM
                    domClass   : 'dropload-down',
                    domRefresh : '<div class="dropload-refresh">↑上拉加载更多</div>',
                    domLoad    : '<div class="dropload-load"><span class="loading"></span>加载中...</div>',
                    domNoData  : '<div class="dropload-noData">没有啦╮(╯_╰)╭</div>'
                },
                scrollArea : window,
                loadDownFn : function(me){
                    $.ajax({
                        type: 'GET',
                        url : "/mall/news/index/page/" + page  + '/?type=load&alias=<?php echo $_smarty_tpl->tpl_vars['alias']->value;?>
',
                        dataType: 'html',
                        success: function(data){
                            if(data) {
                                //赋值数据
                                $("#newsList").append(data);
                                page++;
                            } else {
                                // 锁定
                                me.lock();
                                // 无数据
                                me.noData();
                                $('.dropload-noData').hide();
                                $('.dropload-refresh').hide();
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