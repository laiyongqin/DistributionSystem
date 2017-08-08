<?php /* Smarty version 3.1.27, created on 2016-11-22 15:09:13
         compiled from "/mnt/www/oss.fenxiao.com/application/views/default/ordersales/index.html" */ ?>
<?php
/*%%SmartyHeaderCode:11885155645833ef19042e42_57376615%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9812f7cea1e106a5b9c851a84eedce1c823bdcd0' => 
    array (
      0 => '/mnt/www/oss.fenxiao.com/application/views/default/ordersales/index.html',
      1 => 1472691689,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11885155645833ef19042e42_57376615',
  'variables' => 
  array (
    'typeOption' => 0,
    'orderSn' => 0,
    'data' => 0,
    'row' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5833ef190c7446_26504328',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5833ef190c7446_26504328')) {
function content_5833ef190c7446_26504328 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '11885155645833ef19042e42_57376615';
echo $_smarty_tpl->getSubTemplate ("common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


<div class="main">
    <?php echo $_smarty_tpl->getSubTemplate ("common/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


    <div id="right">
        <!--面包屑导航-->
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);">分销管理 </a></li>
            <li class="active">佣金明细列表</li>
        </ol>
        <div class="right_con">
            <!--搜索区域-->
            <form class="form-inline pull-left">
                <div class="form-group">
                    订单状态：<select name="tid" id="tid" class="form-control">
                    <?php echo $_smarty_tpl->tpl_vars['typeOption']->value;?>

                </select>
                </div>
                <div class="form-group">订单编号：
                    <input type="text" name="orderSn" value="<?php echo $_smarty_tpl->tpl_vars['orderSn']->value;?>
" class="form-control" placeholder="订单编号">
                </div>
                <button type="submit" class="btn btn-default">搜索</button>
            </form>
            <button type="button" class="btn btn-default pull-right" onclick="window.location.reload();">刷新界面</button>
            <div class="clear10"></div>

            <!-- 表格 -->
            <table class="table table-bordered table-striped">
                <tr>
                    <td>ID</td>
                    <td>状态</td>
                    <td>代言人ID</td>
                    <td>推广人ID</td>
                    <td>订单号</td>
                    <td>佣金金额</td>
                    <td>添加时间</td>
                    <td>更新时间</td>
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
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['so_id'];?>
</td>
                    <td><?php if ($_smarty_tpl->tpl_vars['row']->value['so_type'] == 1) {?>
                        <span class="label label-danger"><i class="glyphicon glyphicon-remove"></i>&nbsp;下单未购买</span>
                        <?php } elseif ($_smarty_tpl->tpl_vars['row']->value['so_type'] == 2) {?><span class="label label-primary"><i class="glyphicon glyphicon-ok"></i>&nbsp;下单已购买</span>
                        <?php } elseif ($_smarty_tpl->tpl_vars['row']->value['so_type'] == 3) {?><span class="label label-success"><i class="glyphicon glyphicon-ok"></i>&nbsp;已收货</span>
                        <?php } elseif ($_smarty_tpl->tpl_vars['row']->value['so_type'] == 4) {?><span class="label label-info"><i class="glyphicon glyphicon-ok"></i>&nbsp;已完成</span>
                        <?php }?></td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['m_id'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['so_spokesman'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['so_order_no'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['so_money'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['so_addtime'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['so_updatetime'];?>
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
<?php echo $_smarty_tpl->getSubTemplate ("common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

<?php }
}
?>