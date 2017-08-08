<?php /* Smarty version 3.1.27, created on 2016-08-26 10:00:53
         compiled from "/mnt/www/oss.fenxiao.com/application/views/default/order/index.html" */ ?>
<?php
/*%%SmartyHeaderCode:66509139057bfa2d551c052_33120093%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '999646e32c4f3d94aedb7dd48b511d1360851094' => 
    array (
      0 => '/mnt/www/oss.fenxiao.com/application/views/default/order/index.html',
      1 => 1471848022,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '66509139057bfa2d551c052_33120093',
  'variables' => 
  array (
    'payOption' => 0,
    'orderOption' => 0,
    'title' => 0,
    'orderSn' => 0,
    'startTime' => 0,
    'endTime' => 0,
    'data' => 0,
    'row' => 0,
    'baseUrl' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57bfa2d5598818_04738414',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57bfa2d5598818_04738414')) {
function content_57bfa2d5598818_04738414 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '66509139057bfa2d551c052_33120093';
echo $_smarty_tpl->getSubTemplate ("common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


<div class="main">
    <?php echo $_smarty_tpl->getSubTemplate ("common/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


    <div id="right">
        <!--面包屑导航-->
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);">订单管理 </a></li>
            <li class="active">订单管理</li>
        </ol>


        <div class="right_con">
            <!--搜索区域-->
            <form class="form-inline pull-left">
                <div class="form-group">
                    <label style="display: block;">支付状态:</label>
                   <select name="psid" id="psid" class="form-control">
                    <?php echo $_smarty_tpl->tpl_vars['payOption']->value;?>

                </select>
                </div>
                <div class="form-group">
                    <label style="display: block;">订单状态:</label>
                    <select name="osid" id="osid" class="form-control">
                    <?php echo $_smarty_tpl->tpl_vars['orderOption']->value;?>

                </select>
                </div>
                <div class="form-group">
                    <label style="display: block;">商品名称:</label>
                    <input type="text" name="name" value="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
" class="form-control" placeholder="商品名称">
                </div>
                <div class="form-group">
                    <label style="display: block;">订单编号:</label>
                    <input type="text" name="orderSn" value="<?php echo $_smarty_tpl->tpl_vars['orderSn']->value;?>
" class="form-control" placeholder="订单编号">
                </div>
                <div class="form-group">
                    <label style="display: block;">订单创建时间:</label>
                    <input type="text" class="form-control" name="startTime" id="startTime" value="<?php echo $_smarty_tpl->tpl_vars['startTime']->value;?>
" style="width:180px; display: inline-block;"> ~
                    <input type="text" class="form-control" name="endTime" id="endTime" value="<?php echo $_smarty_tpl->tpl_vars['endTime']->value;?>
" style="width:180px; display: inline-block;">&nbsp;&nbsp;
                </div>

                <button type="submit" class="btn btn-default" style="width:100px;margin-top:20px;">搜索</button>
            </form>
            <button type="button" class="btn btn-default pull-right" onclick="window.location.reload();">刷新界面</button>
            <div class="clear10"></div>

            <!-- 表格 -->
            <table class="table table-bordered table-striped">
                <tr>
                    <td>编号</td>
                    <td>用户ID</td>
                    <td>订单编号</td>
                    <td>商品名称</td>
                    <td>套餐名称</td>
                    <td>单价</td>
                    <td>数量</td>
                    <td>实付金额</td>
                    <td>支付状态</td>
                    <td>创建时间</td>
                    <td>更新时间</td>
                    <td>操作</td>
                </tr>
                <?php if ($_smarty_tpl->tpl_vars['data']->value) {?>
                <?php
$_from = $_smarty_tpl->tpl_vars['data']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['row'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['row']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
$foreach_row_Sav = $_smarty_tpl->tpl_vars['row'];
?>
                <tr>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['o_id'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['m_id'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['o_order_no'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['p_title'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['pp_title'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['p_price'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['o_number'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['o_payment_amount'];?>
</td>
                    <td><?php if ($_smarty_tpl->tpl_vars['row']->value['o_pay_status'] == 1) {?><span class="label label-danger"><i class="glyphicon glyphicon-remove"></i>&nbsp;未支付</span><?php } elseif ($_smarty_tpl->tpl_vars['row']->value['o_pay_status'] == 2) {?><span class="label label-danger"><i class="glyphicon glyphicon-remove"></i>&nbsp;取消订单</span><?php } elseif ($_smarty_tpl->tpl_vars['row']->value['o_pay_status'] == 3) {?><span class="label label-success"><i class="glyphicon glyphicon-ok"></i>&nbsp;已支付</span><?php }?></td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['o_addtime'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['o_updatetime'];?>
</td>
                    <td>
                        <!--未支付 And 未发货--->
                        <?php if ($_smarty_tpl->tpl_vars['row']->value['o_order_status'] == 1 && $_smarty_tpl->tpl_vars['row']->value['o_pay_status'] == 1) {?>
                        <a data-toggle="modal" data-target="#priceModal" href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
priceForm/id/<?php echo $_smarty_tpl->tpl_vars['row']->value['o_id'];?>
" title="修改价格"><span class="label label-primary"><i class="glyphicon glyphicon-check"></i>&nbsp;改价</span></a>
                        <!--<a data-toggle="modal" data-target="#closeModal" href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
closeForm/id/<?php echo $_smarty_tpl->tpl_vars['row']->value['o_id'];?>
" title="关闭订单"><span class="label label-danger"><i class="glyphicon glyphicon-eye-close"></i>&nbsp;关闭订单</span></span></a>-->
                        <!--已支付 And 未发货--->
                        <?php } elseif ($_smarty_tpl->tpl_vars['row']->value['o_order_status'] == 1 && $_smarty_tpl->tpl_vars['row']->value['o_pay_status'] == 3) {?>
                        <a data-toggle="modal" data-target="#expressModal" href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
expressForm/id/<?php echo $_smarty_tpl->tpl_vars['row']->value['o_id'];?>
" title="填写快递"><span class="label label-info"><i class="glyphicon glyphicon-plane"></i>&nbsp;快递</span></span></a>
                        <a href="#" data-json="确认要发货么？" data-href="/order/send/id/<?php echo $_smarty_tpl->tpl_vars['row']->value['o_id'];?>
"><span class="label label-danger"><i class="glyphicon glyphicon-import"></i>&nbsp;发货</span></span></a>
                        <!--已支付 And 已发货--->
                        <?php } elseif ($_smarty_tpl->tpl_vars['row']->value['o_order_status'] == 2 && $_smarty_tpl->tpl_vars['row']->value['o_pay_status'] == 3) {?>
                        <a data-toggle="modal" data-target="#expressModal" href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
expressForm/id/<?php echo $_smarty_tpl->tpl_vars['row']->value['o_id'];?>
" title="修改快递"><span class="label label-info"><i class="glyphicon glyphicon-plane"></i>&nbsp;快递</span></a>
                        <!--<a href="#" data-json="确认要确认收货么？" data-href="/order/status/id/<?php echo $_smarty_tpl->tpl_vars['row']->value['o_id'];?>
">-->
                            <!--<?php if ($_smarty_tpl->tpl_vars['row']->value['o_order_status'] == 2 && $_smarty_tpl->tpl_vars['row']->value['o_pay_status'] == 3) {?>-->
                            <!--<span class="label label-primary"><i class="glyphicon glyphicon-ok"></i>&nbsp;确认收货</span>-->
                            <!--<?php }?>-->
                        <!--</a>-->
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['row']->value['o_order_status'] == 3 && $_smarty_tpl->tpl_vars['row']->value['o_pay_status'] == 3) {?>
                        <span class="label label-warning"><i class="glyphicon glyphicon-ok"></i>&nbsp;交易完成</span>
                        <?php }?>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
details/id/<?php echo $_smarty_tpl->tpl_vars['row']->value['o_id'];?>
" title="订单详情"><span class="label label-success"><i class="glyphicon glyphicon-eye-open"></i>&nbsp;详情</span></a>
                    </td>
                </tr>
                <?php
$_smarty_tpl->tpl_vars['row'] = $foreach_row_Sav;
}
?>
                <?php }?>
            </table>

            <!-- 分页 -->
            <?php if ($_smarty_tpl->tpl_vars['data']->value) {?>
            <nav>
                <ul class="pagination pull-right"><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
</ul>
            </nav>
            <?php }?>
        </div>

        <!--改价弹窗-->
        <form class="form-horizontal" action="/ajax/order/priceSave" method="post">
            <div class="modal fade" id="priceModal" tabindex="-1" role="dialog"></div>
        </form>
        <!--快递弹窗-->
        <form class="form-horizontal" action="/ajax/order/expressSave" method="post">
            <div class="modal fade" id="expressModal" tabindex="-1" role="dialog"></div>
        </form>
        <!--关闭弹窗-->
        <!--<form class="form-horizontal" action="/ajax/order/closeSave" method="post">-->
            <!--<div class="modal fade" id="closeModal" tabindex="-1" role="dialog"></div>-->
        <!--</form>-->
    </div>
    <div class="clear"></div>
</div>

<?php echo '<script'; ?>
>
    $("#form-save").Validform({
        ajaxPost: true,
        tipSweep: true,
        tiptype:function(msg,o,cssctl){
            if(o.type == 3)
                $.dialog.tips(msg);
        },
        beforeSubmit:function(curform){
        },
        callback:function(response){
            $.dialog.tips(response.info);
            if ( response.status == 'y' ) {
                window.setTimeout(function(){
                    location.reload();
                }, 2000)
            }
        }
    });

<?php echo '</script'; ?>
>
<link href="/public/css/bootstrap-datetimepicker.css" rel="stylesheet">
<?php echo '<script'; ?>
 src="/public/js/bootstrap-datetimepicker.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
    $("#startTime,#endTime").datetimepicker({
        format: "yyyy-mm-dd hh:ii",
        autoclose: 1,
        pickerPosition: "bottom-left"
    });
<?php echo '</script'; ?>
>
<?php echo $_smarty_tpl->getSubTemplate ("common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

<?php }
}
?>