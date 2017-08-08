<?php /* Smarty version 3.1.27, created on 2016-11-25 17:51:52
         compiled from "/mnt/www/wx.fenxiao.com/application/modules/Member/views/member/index.html" */ ?>
<?php
/*%%SmartyHeaderCode:1735845917583809b8e6c596_85201843%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '477f272089981a6854dd7bc169396cd9eefacc17' => 
    array (
      0 => '/mnt/www/wx.fenxiao.com/application/modules/Member/views/member/index.html',
      1 => 1480067473,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1735845917583809b8e6c596_85201843',
  'variables' => 
  array (
    'pageTitle' => 0,
    'userData' => 0,
    'spokesman' => 0,
    'configName' => 0,
    'wealth' => 0,
    'promoterNumber' => 0,
    'salesOrderAlread' => 0,
    'salesOrderEnd' => 0,
    'noPayData' => 0,
    'goPayData' => 0,
    'takeData' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_583809b8ed56c7_76690360',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_583809b8ed56c7_76690360')) {
function content_583809b8ed56c7_76690360 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1735845917583809b8e6c596_85201843';
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?php echo $_smarty_tpl->tpl_vars['pageTitle']->value;?>
</title>
    <link rel="stylesheet" type="text/css" href="/public/css/style.min.css">
</head>

<body>
<?php echo $_smarty_tpl->getSubTemplate ("application/views/common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

<!-- 头像  -->
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

<!-- 会员信息  -->
<div class="member-form">
    <ul>
        <li><i></i>ID：<?php echo $_smarty_tpl->tpl_vars['userData']->value['m_id'];?>
</li>
        <li><i></i>您是由[<?php if ($_smarty_tpl->tpl_vars['spokesman']->value['m_nickname']) {
echo $_smarty_tpl->tpl_vars['spokesman']->value['m_nickname'];
} else {
echo $_smarty_tpl->tpl_vars['configName']->value;
}?>]推荐</li>
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
            <a href="/member/qrcode/index/">我的推广二维码</a>
            <?php }?>
        </span></li>
        <li>
            <i></i>
            <p><strong><?php if ($_smarty_tpl->tpl_vars['wealth']->value['mw_sales_money']) {
echo $_smarty_tpl->tpl_vars['wealth']->value['mw_sales_money'];
} else { ?>0<?php }?>元</strong></p>
            <p>销售额</p>
        </li>
        <li>
            <i></i>
            <p><strong><?php if ($_smarty_tpl->tpl_vars['wealth']->value['mw_award_money']) {
echo $_smarty_tpl->tpl_vars['wealth']->value['mw_award_money'];
} else { ?>0<?php }?>元</strong></p>
            <p>我的奖励</p>
        </li>
    </ul>
</div>

<!-- menu  -->
<div class="member-menu">
    <ul>
        <li class="on">
            <div class="title">
                <i class="icon iconfont">&#xe788;</i>
                我是代言人
                <em>(<?php echo $_smarty_tpl->tpl_vars['promoterNumber']->value;?>
)</em>
                <span class="icon iconfont">&#xe772;</span>
            </div>
            <ul>
                <li><a href="/member/member/list/">代言人推广<strong>(<?php echo $_smarty_tpl->tpl_vars['promoterNumber']->value;?>
)</strong></a></li>
            </ul>
        </li>

        <li>
            <div class="title">
                <i class="icon iconfont">&#xe746;</i>
                代言人推广
                <em><?php echo $_smarty_tpl->tpl_vars['salesOrderAlread']->value+$_smarty_tpl->tpl_vars['salesOrderEnd']->value;?>
单(￥<?php echo $_smarty_tpl->tpl_vars['noPayData']->value+$_smarty_tpl->tpl_vars['goPayData']->value+$_smarty_tpl->tpl_vars['takeData']->value;?>
)</em>
                <span class="icon iconfont">&#xe772;</span>
            </div>
            <ul>
                <li><a href="/member/member/order/?type=1">下单未购买<strong><?php echo $_smarty_tpl->tpl_vars['salesOrderAlread']->value;?>
单(￥<?php echo $_smarty_tpl->tpl_vars['noPayData']->value;?>
)</strong></a></li>
                <li><a href="/member/member/order/?type=2">下单已购买<strong><?php echo $_smarty_tpl->tpl_vars['salesOrderEnd']->value;?>
单(￥<?php echo $_smarty_tpl->tpl_vars['goPayData']->value+$_smarty_tpl->tpl_vars['takeData']->value;?>
)</strong></a></li>
            </ul>
        </li>
        <li>
            <div class="title">
                <i class="icon iconfont">&#xe756;</i>
                我的财富
                <strong>￥<?php echo $_smarty_tpl->tpl_vars['noPayData']->value+$_smarty_tpl->tpl_vars['goPayData']->value+$_smarty_tpl->tpl_vars['takeData']->value;?>
</strong>
                <span class="icon iconfont">&#xe772;</span>
            </div>
            <ul>
                <li>未付款订单财富<strong><?php if ($_smarty_tpl->tpl_vars['noPayData']->value) {
echo $_smarty_tpl->tpl_vars['noPayData']->value;
} else { ?>0<?php }?></strong></li>
                <li>已付款订单财富<strong><?php if ($_smarty_tpl->tpl_vars['goPayData']->value) {
echo $_smarty_tpl->tpl_vars['goPayData']->value;
} else { ?>0<?php }?></strong></li>
                <li>已收货订单财富<strong><?php if ($_smarty_tpl->tpl_vars['takeData']->value) {
echo $_smarty_tpl->tpl_vars['takeData']->value;
} else { ?>0<?php }?></strong></li>
                <li>已提现财富<strong><?php if ($_smarty_tpl->tpl_vars['wealth']->value['mw_had_withdraw_money']) {
echo $_smarty_tpl->tpl_vars['wealth']->value['mw_had_withdraw_money'];
} else { ?>0<?php }?></strong></li>
                <li>可提现财富<strong><?php echo $_smarty_tpl->tpl_vars['wealth']->value['mw_not_withdraw_money'];?>
</strong></li>
            </ul>
        </li>

    </ul>
    <a class="cash" href="/member/withdraw/index/"><i class="icon iconfont">&#xe785;</i>申请提现<span class="icon iconfont">&#xe61c;</span></a>
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