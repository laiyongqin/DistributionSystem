<?php /* Smarty version 3.1.27, created on 2016-11-25 17:52:44
         compiled from "/mnt/www/wx.fenxiao.com/application/modules/Mall/views/order/index.html" */ ?>
<?php
/*%%SmartyHeaderCode:157215310583809ecd81549_10073382%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '846fd6bd1deb03f2e270cfbb292a85403d4093b7' => 
    array (
      0 => '/mnt/www/wx.fenxiao.com/application/modules/Mall/views/order/index.html',
      1 => 1480067563,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '157215310583809ecd81549_10073382',
  'variables' => 
  array (
    'allData' => 0,
    'vo' => 0,
    'payStatus' => 0,
    'orderStatus' => 0,
    'total' => 0,
    'pageSize' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_583809ece00125_00698978',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_583809ece00125_00698978')) {
function content_583809ece00125_00698978 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '157215310583809ecd81549_10073382';
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>我的订单</title>
    <link rel="stylesheet" type="text/css" href="/public/css/dropload.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/style.min.css">
</head>
<style>
    .end                 { display: none; position: absolute; top: 61.5vw; left: 25vw;}
    .express_name a{ background: #fd7632;color:#fff; padding: 3px 8px; display: inline-block;border-radius: 5px;}
    .orders-list ul li{
        cursor:pointer
    }
</style>

<body style="background:#f0f0f0;">
<?php echo $_smarty_tpl->getSubTemplate ("application/views/common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


<div class="orders-header">
    <i class="icon iconfont">&#xe737;</i>我的订单
</div>

<div class="orders-list" id="list">
    <ul id="orderList">
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
                <li id="li_<?php echo $_smarty_tpl->tpl_vars['vo']->value['o_order_no'];?>
">
                    订单编号:<?php echo $_smarty_tpl->tpl_vars['vo']->value['o_order_no'];?>
<i class="icon iconfont">&#xe772;</i>
                    <div class="con">
                        <div class="hang"><strong>订单金额：</strong><?php echo $_smarty_tpl->tpl_vars['vo']->value['o_payment_amount'];?>
元</div>
                        <div class="hang"><strong>订单时间：</strong><?php echo $_smarty_tpl->tpl_vars['vo']->value['o_addtime'];?>
</div>
                        <div class="hang"><strong>支付状态：</strong><?php echo $_smarty_tpl->tpl_vars['payStatus']->value[$_smarty_tpl->tpl_vars['vo']->value['o_pay_status']];?>
</div>
                        <div class="hang"><strong>订单状态：</strong><?php echo $_smarty_tpl->tpl_vars['orderStatus']->value[$_smarty_tpl->tpl_vars['vo']->value['o_order_status']];?>
</div>
                        <div class="hang"><strong>商品名称：</strong><?php echo $_smarty_tpl->tpl_vars['vo']->value['p_title'];?>
</div>
                        <div class="hang"><strong>订单详情：</strong><?php echo $_smarty_tpl->tpl_vars['vo']->value['pp_title'];?>
</div>
                        <!--<?php if ($_smarty_tpl->tpl_vars['vo']->value['pp_title']) {?><p><strong>订单详情：</strong><?php echo $_smarty_tpl->tpl_vars['vo']->value['pp_title'];?>
</p><?php }?>-->
                        <?php if ($_smarty_tpl->tpl_vars['vo']->value['o_pay_status'] == 3) {?>
                        <div class="hang"><strong>快递公司：</strong><?php echo $_smarty_tpl->tpl_vars['vo']->value['o_express_company'];?>
</div>
                        <div class="hang"><strong>快递单号：</strong><?php echo $_smarty_tpl->tpl_vars['vo']->value['o_express_number'];?>
</div>
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['vo']->value['o_express_number']) {?>
                        <p class="express_name"><a href="/mall/order/express?id=<?php echo $_smarty_tpl->tpl_vars['vo']->value['o_id'];?>
">查看物流信息</a></p>
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['vo']->value['o_pay_status'] == 1) {?>
                        <div class="hang"><strong>剩余支付时间：</strong><div class="yomibox" data="<?php echo $_smarty_tpl->tpl_vars['vo']->value['leftTime'];?>
"></div><span class="end">已过期</span></div>
                        <?php }?>
                        <div class="btn" id="<?php echo $_smarty_tpl->tpl_vars['vo']->value['o_order_no'];?>
">
                            <?php if ($_smarty_tpl->tpl_vars['vo']->value['o_pay_status'] == 1 && $_smarty_tpl->tpl_vars['vo']->value['leftTime'] > 0) {?>
                            <input name="" type="button" value="立即支付" id="repayBtn" orderID="<?php echo $_smarty_tpl->tpl_vars['vo']->value['o_order_no'];?>
">
                            <input name="" type="button" value="取消订单" id="cancelBtn" orderID="<?php echo $_smarty_tpl->tpl_vars['vo']->value['o_order_no'];?>
">
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['vo']->value['o_pay_status'] == 3 && $_smarty_tpl->tpl_vars['vo']->value['o_order_status'] != 3) {?>
                            <input name="" type="button" value="确认收货" id="confirmBtn" orderID="<?php echo $_smarty_tpl->tpl_vars['vo']->value['o_order_no'];?>
">
                            <?php }?>
                        </div>
                    </div>
                </li>
            <?php
$_smarty_tpl->tpl_vars['vo'] = $foreach_vo_Sav;
}
?>
        <?php }?>

    </ul>
    <!--<p class="down">下拉加载更多...</p>-->
</div>

<?php echo '<script'; ?>
 src="/public/js/jquery-2.1.4.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/public/js/dropload.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/public/js/weui/jquery-weui.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/public/js/countdown/jquery.countdown.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
    $(document).ready(function(){
        $(document).on('click', '#repayBtn', function(){
            var orderID = $(this).attr('orderID');
            $.post('/ajax/order/repay', {orderNo : orderID}, function(data){
                if(data.status == 'y'){
                    location.href = '/payment/order/orderNo/' + orderID;
                }else{
                    $.alert(data.info);
                }
            }, 'json')
        });

        $(document).on('click', '#cancelBtn', function(){
            var orderID = $(this).attr('orderID');
            $.post('/ajax/order/cancel', {orderNo : orderID}, function(data){
                if(data.status == 'y'){
                    $.alert(data.info);
                    $('#li_' + orderID).remove();
                }else{
                    $.alert(data.info);
                }
            }, 'json')
        });

        $(document).on('click', '#confirmBtn', function(){
            var orderID = $(this).attr('orderID');
            $.post('/ajax/order/confirm', {orderNo : orderID}, function(data){
                if(data.status == 'y'){
                    $.alert(data.info);
                    $('#' + orderID).hide();
                }else{
                    $.alert(data.info);
                }
            }, 'json')
        });

        $(document).on('click', '.orders-list ul li', function(){
            if( $(this).hasClass("on"))
            {
                $(this).removeClass("on")
            }

            else
            {
                $(this).addClass("on")
            }
        });

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
                        url : "/mall/order/index/page/" + page  + '/?type=load',
                        dataType: 'html',
                        success: function(data){
                            if(data) {
                                //赋值数据
                                $("#orderList").append(data);
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
    });
<?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
?>