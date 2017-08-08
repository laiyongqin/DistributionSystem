<?php /* Smarty version 3.1.27, created on 2016-11-25 17:06:27
         compiled from "/mnt/www/wx.fenxiao.com/application/modules/Mall/views/product/details.html" */ ?>
<?php
/*%%SmartyHeaderCode:8381688805837ff138d26a7_28737169%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2948f3e85dd76125c526fe8077c9c4a7eb1d7f4e' => 
    array (
      0 => '/mnt/www/wx.fenxiao.com/application/modules/Mall/views/product/details.html',
      1 => 1473234218,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8381688805837ff138d26a7_28737169',
  'variables' => 
  array (
    'data' => 0,
    'picBanner' => 0,
    'vo' => 0,
    'signPackage' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5837ff13a1dc00_92742456',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5837ff13a1dc00_92742456')) {
function content_5837ff13a1dc00_92742456 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '8381688805837ff138d26a7_28737169';
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>商品详情页</title>
    <link rel="stylesheet" type="text/css" href="/public/css/swiper.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/style.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/iconfont.css">
</head>

<body>

<div class="show-nav">
    <a href="/"><i class="icon iconfont">&#xe617;</i><p>返回首页</p></a>
    <a href="/mall/product/buy/id/<?php echo $_smarty_tpl->tpl_vars['data']->value['p_id'];?>
"><i class="icon iconfont">&#xe618;</i><p>立即购买</p></a>
</div>

<div class="show-title"><?php echo $_smarty_tpl->tpl_vars['data']->value['p_title'];?>
</div>
<!-- banner -->
<div class="swiper-container banner">
    <div class="swiper-wrapper">
        <?php if ($_smarty_tpl->tpl_vars['picBanner']->value) {?>
        <?php
$_from = $_smarty_tpl->tpl_vars['picBanner']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['vo'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['vo']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['vo']->value) {
$_smarty_tpl->tpl_vars['vo']->_loop = true;
$foreach_vo_Sav = $_smarty_tpl->tpl_vars['vo'];
?>
        <div class="swiper-slide"><a href="javascript:void(0);"><img src="<?php echo $_smarty_tpl->tpl_vars['vo']->value['pp_url'];?>
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

<div class="show-details">
    <div class="text">
        <?php if ($_smarty_tpl->tpl_vars['data']->value['p_event_price'] > 0) {?>
        <span><del>原价：￥<?php echo $_smarty_tpl->tpl_vars['data']->value['p_original_price'];?>
</del></span>
        <span>活动价：￥<?php echo $_smarty_tpl->tpl_vars['data']->value['p_event_price'];?>
</span>
        <?php } else { ?>
        <span>原价：￥<?php echo $_smarty_tpl->tpl_vars['data']->value['p_original_price'];?>
</span>
        <?php }?>
    </div>
</div>

<div class="show-content">
    <div class="title">商品简介<i></i></div>
    <?php echo $_smarty_tpl->tpl_vars['data']->value['p_content'];?>

</div>

<?php echo '<script'; ?>
 src="/public/js/jquery-2.1.4.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/public/js/swiper.jquery.min.js"><?php echo '</script'; ?>
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

    $(document).ready(function() {
        var size =$(".show-details .text").children("span").length
        if(size == 1)
        {
            $(".show-details .text").addClass("one")
        }
    });
<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
    var appId      = '<?php echo $_smarty_tpl->tpl_vars['signPackage']->value['appId'];?>
';var timestamp = '<?php echo $_smarty_tpl->tpl_vars['signPackage']->value['timestamp'];?>
';
    var nonceStr   = '<?php echo $_smarty_tpl->tpl_vars['signPackage']->value['nonceStr'];?>
';var signature = '<?php echo $_smarty_tpl->tpl_vars['signPackage']->value['signature'];?>
';
    var pid        = '<?php echo $_smarty_tpl->tpl_vars['data']->value['p_id'];?>
';
    var title      = "<?php echo $_smarty_tpl->tpl_vars['data']->value['p_title'];?>
";
    var main_title = '【上善网络】' + title;
    var link       = "<?php echo @constant('APP_DOMAIN');?>
";
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
    wx.config({
        appId: appId,
        timestamp:timestamp,
        nonceStr: nonceStr,
        signature: signature,
        jsApiList: [
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
            'onMenuShareQQ'
        ]
    });

    wx.ready(function () {
        wx.onMenuShareTimeline({
            title: main_title,
            desc:  title,
            link:  "<?php echo @constant('APP_DOMAIN');?>
mall/product/details/id/" + pid,
            imgUrl: '<?php echo $_smarty_tpl->tpl_vars['data']->value['p_cover'];?>
',
            trigger: function (res) {
            },
            success: function (res) {
                getShareBack();
            },
            cancel: function (res) {
            },
            fail: function (res) {
            }
        });

        wx.onMenuShareAppMessage({
            title: main_title,
            desc:  title,
            link:  "<?php echo @constant('APP_DOMAIN');?>
mall/product/details/id/" + pid,
            imgUrl: '<?php echo $_smarty_tpl->tpl_vars['data']->value['p_cover'];?>
',
            trigger: function (res) {
            },
            success: function (res) {
                getShareBack();
            },
            cancel: function (res) {
            },
            fail: function (res) {
            }
        });

        wx.onMenuShareQQ({
            title: main_title,
            desc:  title,
            link:  "<?php echo @constant('APP_DOMAIN');?>
mall/product/details/id/" + pid,
            imgUrl: '<?php echo $_smarty_tpl->tpl_vars['data']->value['p_cover'];?>
',
            trigger: function (res) {
            },
            success: function (res) {
                getShareBack();
            },
            cancel: function (res) {
            },
            fail: function (res) {
            }
        });
    });

    //分享回调数据
    function getShareBack(){
        //分享完成 回调数据
    }
<?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
?>