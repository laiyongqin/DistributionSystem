<?php /* Smarty version 3.1.27, created on 2016-08-19 09:13:54
         compiled from "/mnt/www/wx.fenxiao.com/application/modules/Member/views/member/index.html" */ ?>
<?php
/*%%SmartyHeaderCode:149603964357b65d526b52c6_33118416%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '477f272089981a6854dd7bc169396cd9eefacc17' => 
    array (
      0 => '/mnt/www/wx.fenxiao.com/application/modules/Member/views/member/index.html',
      1 => 1471510490,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '149603964357b65d526b52c6_33118416',
  'variables' => 
  array (
    'pageTitle' => 0,
    'userData' => 0,
    'spokesman' => 0,
    'wealth' => 0,
    'noPayData' => 0,
    'goPayData' => 0,
    'takeData' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57b65d527d2909_32956699',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57b65d527d2909_32956699')) {
function content_57b65d527d2909_32956699 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '149603964357b65d526b52c6_33118416';
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
</head>

<body>
<nav>
    <a class="on" href="index.html"><i class="icon iconfont">&#xe613;</i><p>进入商城</p></a>
    <a href="orders.html"><i class="icon iconfont">&#xe614;</i><p>我的订单</p></a>
    <a href="member.html"><i class="icon iconfont">&#xe615;</i><p>会员中心</p></a>
    <a><i class="icon iconfont">&#xe616;</i><p>我的二维码</p></a>
</nav>

<!-- 头像  -->
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

<!-- 会员信息  -->
<div class="member-form">
    <ul>
        <li><i></i>ID：<?php echo $_smarty_tpl->tpl_vars['userData']->value['m_id'];?>
</li>
        <li><i></i>您是由[<?php echo $_smarty_tpl->tpl_vars['spokesman']->value['m_nickname'];?>
]推荐</li>
        <li><i></i><?php if ($_smarty_tpl->tpl_vars['userData']->value['m_vip'] == 1) {?>
            会员：我还不是代言人
            <?php } else { ?>
            会员：我是代言人
            <?php }?>
        </li>
        <li><i></i><span>
            <?php if ($_smarty_tpl->tpl_vars['userData']->value['m_vip'] == 1) {?>
            <a href="/index">点击链接成为会员</a>
            <?php } else { ?>
            <a href="/index">我的推广二维码</a>
            <?php }?>
        </span></li>
        <li>
            <i></i>
            <p><strong><?php echo $_smarty_tpl->tpl_vars['wealth']->value['mw_sales_money'];?>
元</strong></p>
            <p>销售额</p>
        </li>
        <li>
            <i></i>
            <p><strong><?php echo $_smarty_tpl->tpl_vars['wealth']->value['mw_award_money'];?>
元</strong></p>
            <p>我的奖励</p>
        </li>
    </ul>
</div>

<!-- menu  -->
<div class="member-menu">
    <ul>


        <li class="on">
            <div class="title">
                <i class="icon iconfont">&#xe61e;</i>
                我是代言人
                <em>0(0)</em>
                <span class="icon iconfont">&#xe61d;</span>
            </div>
            <ul>
                <li><a href="member_list.html">代言人推广<strong>0(0)</strong></a></li>
            </ul>
        </li>

        <li>
            <div class="title">
                <i class="icon iconfont">&#xe621;</i>
                代言人推广
                <em>0单(￥0)</em>
                <span class="icon iconfont">&#xe61d;</span>
            </div>
            <ul>
                <li><a href="member_orders.html">下单未购买<strong>0单(￥0)</strong></a></li>
                <li><a href="member_orders.html">下单已购买<strong>0单(￥0)</strong></a></li>
            </ul>
        </li>


        <li>
            <div class="title">
                <i class="icon iconfont">&#xe61f;</i>
                我的财富
                <strong>￥<?php echo $_smarty_tpl->tpl_vars['noPayData']->value+$_smarty_tpl->tpl_vars['goPayData']->value+$_smarty_tpl->tpl_vars['takeData']->value;?>
</strong>
                <span class="icon iconfont">&#xe61d;</span>
            </div>
            <ul>
                <li>未付款订单财富<strong><?php echo $_smarty_tpl->tpl_vars['noPayData']->value;?>
</strong></li>
                <li>已付款订单财富<strong><?php echo $_smarty_tpl->tpl_vars['goPayData']->value;?>
</strong></li>
                <li>已收货订单财富<strong><?php echo $_smarty_tpl->tpl_vars['takeData']->value;?>
</strong></li>
                <li>已提现财富<strong><?php echo $_smarty_tpl->tpl_vars['wealth']->value['mw_had_withdraw_money'];?>
</strong></li>
                <li>可提现财富<strong><?php echo $_smarty_tpl->tpl_vars['wealth']->value['mw_not_withdraw_money'];?>
</strong></li>
            </ul>
        </li>

    </ul>
    <a class="cash" href="cash.html"><i class="icon iconfont">&#xe620;</i>申请提现<span class="icon iconfont">&#xe61c;</span></a>
</div>


<?php echo '<script'; ?>
 src="/public/js/jquery-2.1.4.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
    $(document).ready(function(){
        $(".member-menu ul li").click(function(){
            if( $(this).hasClass("on")) {
                $(this).removeClass("on")
            } else {
                $(this).addClass("on")
            }
        });
    });
<?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
?>