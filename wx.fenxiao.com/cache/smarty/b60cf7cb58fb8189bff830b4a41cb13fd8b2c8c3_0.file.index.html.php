<?php /* Smarty version 3.1.27, created on 2016-11-25 17:47:31
         compiled from "/mnt/www/wx.fenxiao.com/application/views/index/index.html" */ ?>
<?php
/*%%SmartyHeaderCode:1830454909583808b373fd00_30314822%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b60cf7cb58fb8189bff830b4a41cb13fd8b2c8c3' => 
    array (
      0 => '/mnt/www/wx.fenxiao.com/application/views/index/index.html',
      1 => 1480067250,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1830454909583808b373fd00_30314822',
  'variables' => 
  array (
    'adList' => 0,
    'vo' => 0,
    'title' => 0,
    'productList' => 0,
    'cateList' => 0,
    'key' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_583808b37b7967_21767133',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_583808b37b7967_21767133')) {
function content_583808b37b7967_21767133 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1830454909583808b373fd00_30314822';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>首页</title>
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


<!-- 搜索 -->
<form method="get" action="/index">
<div class="category">
    <div class="sorts"><i class="icon iconfont">&#xe616;</i></div>
    <div class="search">
        <i class="icon iconfont">&#xe608;</i>
        <input name="title" value="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
" type="text" placeholder="请输入商品名称">
    </div>
</div>
</form>


<div class="pro-list">
    <ul>
        <?php if ($_smarty_tpl->tpl_vars['productList']->value) {?>
            <?php
$_from = $_smarty_tpl->tpl_vars['productList']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['vo'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['vo']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['vo']->value) {
$_smarty_tpl->tpl_vars['vo']->_loop = true;
$foreach_vo_Sav = $_smarty_tpl->tpl_vars['vo'];
?>
                <li class="products cate_<?php echo $_smarty_tpl->tpl_vars['vo']->value['pc_id'];?>
">
                    <i></i>
                    <a href="/mall/product/details/id/<?php echo $_smarty_tpl->tpl_vars['vo']->value['p_id'];?>
">
                        <img src="<?php echo $_smarty_tpl->tpl_vars['vo']->value['p_cover'];?>
" >
                        <h4><?php echo $_smarty_tpl->tpl_vars['vo']->value['p_title'];?>
</h4>
                        <p>￥<?php echo $_smarty_tpl->tpl_vars['vo']->value['p_event_price'];?>
</p>
                    </a>
                </li>
        <?php
$_smarty_tpl->tpl_vars['vo'] = $foreach_vo_Sav;
}
?>
        <?php }?>

    </ul>
</div>

<p class="down"></p>

<!-- 产品分类-弹出框 -->
<div class="popup-bj"></div>
<div class="sorts-close"><i class="icon iconfont">&#xe725;</i></div>
<div class="sorts-popup">


    <div class="groups">
        <div class="title">产品目录</div>
        <ul>
            <?php if ($_smarty_tpl->tpl_vars['cateList']->value) {?>
            <?php
$_from = $_smarty_tpl->tpl_vars['cateList']->value;
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
            <li><span class="icon iconfont">&#xe7ab;</span><a href="index?pid=<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['vo']->value;?>
</a><i class="icon iconfont">&#xe775;</i></li>
            <?php
$_smarty_tpl->tpl_vars['vo'] = $foreach_vo_Sav;
}
?>
            <?php }?>
        </ul>
    </div>
</div>

<?php echo '<script'; ?>
 src="/public/js/jquery-2.1.4.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/public/js/swiper.jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/public/js/lp.js"><?php echo '</script'; ?>
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

    $('.menu a').click(function(){
        var cate = parseInt($(this).attr('cate'));
        if(cate >= 0){
            if(cate == 0){
                $('.products').show();
            }else{
                $('.products').hide();
                $('.cate_' + cate).show();
            }
        }

        $(this).addClass('on').siblings().removeClass('on');
    })

<?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
?>