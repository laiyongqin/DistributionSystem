<?php /* Smarty version 3.1.27, created on 2016-08-26 10:00:36
         compiled from "/mnt/www/oss.fenxiao.com/application/views/default/payment/index.html" */ ?>
<?php
/*%%SmartyHeaderCode:43741532957bfa2c4c387b0_43976319%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5e45f9436589ce2eda74733f932e5048ee85aaa3' => 
    array (
      0 => '/mnt/www/oss.fenxiao.com/application/views/default/payment/index.html',
      1 => 1471937825,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '43741532957bfa2c4c387b0_43976319',
  'variables' => 
  array (
    'orderSn' => 0,
    'startTime' => 0,
    'endTime' => 0,
    'data' => 0,
    'row' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57bfa2c4d42726_62006924',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57bfa2c4d42726_62006924')) {
function content_57bfa2c4d42726_62006924 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '43741532957bfa2c4c387b0_43976319';
echo $_smarty_tpl->getSubTemplate ("common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


<div class="main">
    <?php echo $_smarty_tpl->getSubTemplate ("common/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


    <div id="right">
        <!--面包屑导航-->
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);"> 财务管理</a></li>
            <li class="active">支付明细</li>
        </ol>
        <div class="right_con">
            <!--搜索区域-->
            <form class="form-inline pull-left">
                <div class="form-group">订单编号：
                    <input type="text" name="orderSn" value="<?php echo $_smarty_tpl->tpl_vars['orderSn']->value;?>
" class="form-control" placeholder="订单编号">
                </div>
                <div class="form-group">添加时间：
                    <input type="text" class="form-control" name="beginTime" id="beginTime" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['startTime']->value;?>
" placeholder="开始时间" />&nbsp;&nbsp;至&nbsp;&nbsp;
                    <input type="text" class="form-control" name="endTime" id="endTime" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['endTime']->value;?>
" placeholder="结束时间" />
                </div>

                <button type="submit" class="btn btn-default">搜索</button>
            </form>
            <button type="button" class="btn btn-default pull-right" onclick="window.location.reload();">刷新界面</button>
            <div class="clear10"></div>

            <!-- 表格 -->
            <table class="table table-bordered table-striped">
                <tr>
                    <td>ID</td>
                    <td>用户id</td>
                    <td>用户昵称</td>
                    <td>订单号</td>
                    <td>第三方平台订单号</td>
                    <td>支付总金额</td>
                    <td>添加时间</td>
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
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['pp_id'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['m_id'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['m_nickname'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['pp_order_no'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['pp_transaction_id'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['pp_money'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['pp_addtime'];?>
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

    </div>
    <div class="clear"></div>
</div>
<?php echo '<script'; ?>
>

    $('#beginTime').datetimepicker({
        format: "yyyy-mm-dd hh:mm",
        autoclose: 1,
        pickerPosition: "bottom-left"
    });

    $('#endTime').datetimepicker({
        format: "yyyy-mm-dd hh:mm",
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