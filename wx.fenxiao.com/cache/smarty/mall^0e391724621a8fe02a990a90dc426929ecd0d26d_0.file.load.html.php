<?php /* Smarty version 3.1.27, created on 2016-11-25 17:53:16
         compiled from "/mnt/www/wx.fenxiao.com/application/modules/Mall/views/order/load.html" */ ?>
<?php
/*%%SmartyHeaderCode:138313980458380a0c9e7631_60115017%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0e391724621a8fe02a990a90dc426929ecd0d26d' => 
    array (
      0 => '/mnt/www/wx.fenxiao.com/application/modules/Mall/views/order/load.html',
      1 => 1480067595,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '138313980458380a0c9e7631_60115017',
  'variables' => 
  array (
    'allData' => 0,
    'vo' => 0,
    'payStatus' => 0,
    'orderStatus' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_58380a0ca4be64_14105312',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_58380a0ca4be64_14105312')) {
function content_58380a0ca4be64_14105312 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '138313980458380a0c9e7631_60115017';
if ($_smarty_tpl->tpl_vars['allData']->value) {?>
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
<?php }
}
}
?>