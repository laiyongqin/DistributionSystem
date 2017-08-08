<?php /* Smarty version 3.1.27, created on 2016-09-05 15:59:55
         compiled from "/mnt/www/oss.fenxiao.com/application/views/default/order/details.html" */ ?>
<?php
/*%%SmartyHeaderCode:150883483457cd25fbd3fa70_51171905%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '108e8838bba89cae8201422482571165025fffec' => 
    array (
      0 => '/mnt/www/oss.fenxiao.com/application/views/default/order/details.html',
      1 => 1473062395,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '150883483457cd25fbd3fa70_51171905',
  'variables' => 
  array (
    'breadTitle' => 0,
    'data' => 0,
    'address' => 0,
    'profileData' => 0,
    'v' => 0,
    'progressData' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57cd25fbdb6333_28307646',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57cd25fbdb6333_28307646')) {
function content_57cd25fbdb6333_28307646 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '150883483457cd25fbd3fa70_51171905';
echo $_smarty_tpl->getSubTemplate ("common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

<style>
    .hide{display: none;}
    .panel-body > p > b{width:100px; display: inline-block;border-right: dashed 1px #d5d5d5;margin-right:2%;}
    .panel-body > p{padding-bottom: 15px;border-bottom: dashed 1px #c5c5c5;}
    .panel_header{background: #999;width: 100%;padding:5px 0px 5px 20px; font-size:16px;margin-bottom:10px;color:#fff;}
    .table > thead > tr > th{border:none;}
    .clearafter:after{ clear:both; content:"."; height:0px; font-size:0px; visibility:hidden; display:block; }
    .order_content li{width: 48%; float: left;padding:10px;border-bottom: dashed 1px #c5c5c5;}
    .order_content li > b{width:100px; display: inline-block;margin-right:2%;}
</style>
<div class="main">
    <?php echo $_smarty_tpl->getSubTemplate ("common/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

    <div id="right">
        <!--面包屑导航-->
        <ol class="breadcrumb">
            <li><a href="/order/index/">订单列表 </a></li>
            <li class="active"><?php echo $_smarty_tpl->tpl_vars['breadTitle']->value;?>
</li>
        </ol>
        <div class="right_con form-horizontal">
            <div class="row">
                <div class="col-md-7">
                    <div class="panel panel-success">
                        <!-- Default panel contents -->
                        <div class="panel-heading">购买人信息</div>
                        <div class="panel-body">
                            <div class="panel_header" >订单信息</div>
                            <ul class="order_content clearafter">
                            <li><b>订单ID:</b>&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['data']->value['o_id'];?>
</li>
                            <li><b>订单编号:</b>&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['data']->value['o_order_no'];?>
</li>
                            <li><b>用户ID:</b>&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['data']->value['m_id'];?>
</li>
                            <li><b>商品名称:</b>&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['data']->value['p_title'];?>
</li>
                            <li><b>套餐名称:</b>&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['data']->value['pp_title'];?>
</li>
                            <li><b>商品单价:</b>&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['data']->value['p_price'];?>
</li>
                            <li><b>购买数量:</b>&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['data']->value['o_number'];?>
</li>
                            <li><b>订单总额:</b>&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['data']->value['o_order_amount'];?>
</li>
                            <li><b>实付金额:</b>&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['data']->value['o_payment_amount'];?>
</li>
                            <li><b>分成金额:</b>&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['data']->value['o_award_amount'];?>
</li>
                            <li><b>支付状态:</b>&nbsp;&nbsp;
                                <?php if ($_smarty_tpl->tpl_vars['data']->value['o_pay_status'] == 1) {?><span class="label label-danger">未支付</span><?php } elseif ($_smarty_tpl->tpl_vars['data']->value['o_pay_status'] == 2) {?><span class="label label-danger">取消订单</span><?php } elseif ($_smarty_tpl->tpl_vars['data']->value['o_pay_status'] == 3) {?><span class="label label-success">已支付</span><?php }?>
                            </li>
                            <li><b>订单状态:</b>&nbsp;&nbsp;
                                <?php if ($_smarty_tpl->tpl_vars['data']->value['o_order_status'] == 1) {?><span class="label label-danger">未发货</span><?php } elseif ($_smarty_tpl->tpl_vars['data']->value['o_order_status'] == 2) {?><span class="label label-danger">已发货</span><?php } elseif ($_smarty_tpl->tpl_vars['data']->value['o_order_status'] == 3) {?><span class="label label-success">确认收货</span><?php }?>
                            </li>
                            <li><b>订单添加时间:</b>&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['data']->value['o_addtime'];?>
</li>
                            <li><b>订单更新时间:</b>&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['data']->value['o_updatetime'];?>
</li>
                                </ul>
                            <div class="panel_header" style="">快递信息</div>
                            <ul class="order_content clearafter">
                            <li><b>快递公司:</b>&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['data']->value['o_express_company'];?>
</li>
                            <li><b>快递单号:</b>&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['data']->value['o_express_number'];?>
</li>
                            <li><b>客户留言:</b>&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['data']->value['o_memo'];?>
</li>
                            <?php if ($_smarty_tpl->tpl_vars['data']->value['o_close_remark']) {?><p><b>关闭订单备注:</b>&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['data']->value['o_close_remark'];?>
</p><?php }?>
                                </ul>
                            <?php if ($_smarty_tpl->tpl_vars['address']->value) {?>
                            <div class="panel_header" style="">发货地址信息</div>
                            <ul class="order_content clearafter">
                            <li><b>联系人:</b>&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['address']->value['a_realname'];?>
</li>
                                <li><b>联系电话:</b>&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['address']->value['a_phone'];?>
</li>
                            <li><b>微信号:</b>&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['address']->value['a_wechat_id'];?>
</li>
                            <li><b>地址:</b>&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['address']->value['a_province'];?>
-<?php echo $_smarty_tpl->tpl_vars['address']->value['a_city'];?>
-<?php echo $_smarty_tpl->tpl_vars['address']->value['a_area'];?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['address']->value['a_address'];?>
</li>
                                </ul>
                            <?php }?>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <!--<?php if ($_smarty_tpl->tpl_vars['profileData']->value) {?>-->
                    <!--<div class="panel panel-primary">-->
                        <!--<div class="panel-heading">套餐列表</div>-->
                        <!--<div class="table-responsive" >-->
                            <!--<table class="table">-->
                                <!--<thead style="border-bottom: solid 2px #3279bb;">-->
                                <!--<tr>-->
                                    <!--<th>套餐名称</th>-->
                                    <!--<th>套餐类型</th>-->
                                    <!--<th>销量</th>-->
                                    <!--<th>库存</th>-->
                                    <!--<th>成本</th>-->
                                    <!--<th>原价</th>-->
                                    <!--<th>活动价</th>-->
                                <!--</tr>-->
                                <!--</thead>-->
                                <!--<tbody>-->
                                <!--<?php
$_from = $_smarty_tpl->tpl_vars['profileData']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['v'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['v']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
$foreach_v_Sav = $_smarty_tpl->tpl_vars['v'];
?>-->
                                <!--<tr>-->
                                    <!--<td><?php echo $_smarty_tpl->tpl_vars['v']->value['pp_name'];?>
</td>-->
                                    <!--<td><?php echo $_smarty_tpl->tpl_vars['v']->value['pt_name'];?>
</td>-->
                                    <!--<td><?php echo $_smarty_tpl->tpl_vars['v']->value['pp_sales'];?>
</td>-->
                                    <!--<td><?php echo $_smarty_tpl->tpl_vars['v']->value['pp_stock'];?>
</td>-->
                                    <!--<td><?php echo $_smarty_tpl->tpl_vars['v']->value['pp_cost'];?>
</td>-->
                                    <!--<td><?php echo $_smarty_tpl->tpl_vars['v']->value['pp_original_price'];?>
</td>-->
                                    <!--<td><?php echo $_smarty_tpl->tpl_vars['v']->value['pp_event_price'];?>
</td>-->
                                <!--</tr>-->
                                <!--<?php
$_smarty_tpl->tpl_vars['v'] = $foreach_v_Sav;
}
?>-->
                                <!--</tbody>-->
                            <!--</table>-->
                        <!--</div>-->
                    <!--</div>-->
                    <!--<?php }?>-->
                    <?php if ($_smarty_tpl->tpl_vars['progressData']->value) {?>
                    <div class="panel panel-danger">
                        <!-- Default panel contents -->
                        <div class="panel-heading">订单进度</div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead style="border-bottom: solid 2px #c33;">
                                    <tr>
                                        <th>时间</th>
                                        <th>信息</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
$_from = $_smarty_tpl->tpl_vars['progressData']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['v'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['v']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
$foreach_v_Sav = $_smarty_tpl->tpl_vars['v'];
?>
                                    <tr>
                                        <td><?php echo $_smarty_tpl->tpl_vars['v']->value['op_addtime'];?>
</td>
                                        <td><?php echo $_smarty_tpl->tpl_vars['v']->value['op_memo'];?>
</td>
                                    </tr>
                                    <?php
$_smarty_tpl->tpl_vars['v'] = $foreach_v_Sav;
}
?>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['data']->value['o_express_number']) {?>
                    <!--快递跟踪-->
                    <div class="panel panel-info" style="position:relative ">
                        <!-- Default panel contents -->
                        <div class="panel-heading">快递跟踪</div>
                        <div id="expres_load"></div>

                        <!--快递load--->
                        <div id="loadgif" style="width:100%; text-align: center;">
                            　　<img src="<?php echo @constant('IMAGE_URL');?>
/public/images/load.gif" style="">
                        </div>
                    </div>
                    <?php }?>

                </div>
            </div>

            <div class="clear10"></div>
        </div>
    </div>
    <div class="clear"></div>
</div>
<?php echo '<script'; ?>
>
    //查订单
    var number = '<?php echo $_smarty_tpl->tpl_vars['data']->value['o_express_number'];?>
';
    $("#loadgif").show();
    if(number){
        $.ajax({
            type: 'GET',
            url : "/order/getAjaxExpress/number/" + number,
            dataType: 'html',
            success: function(data){
                if(data) {
                    $("#loadgif").hide();
                    //赋值数据
                    $("#expres_load").append(data);
                } else {
                    $('#expres_load').hide();
                }

            },
        });
    }
<?php echo '</script'; ?>
>
<?php echo $_smarty_tpl->getSubTemplate ("common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


<?php }
}
?>