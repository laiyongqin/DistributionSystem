<?php /* Smarty version 3.1.27, created on 2016-08-29 09:10:21
         compiled from "/mnt/www/oss.fenxiao.com/application/views/default/memberwealth/index.html" */ ?>
<?php
/*%%SmartyHeaderCode:114896838357c38b7d59d2f9_20901361%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '72d83379f3fdd79a5ff0cf413a70395a9bde902d' => 
    array (
      0 => '/mnt/www/oss.fenxiao.com/application/views/default/memberwealth/index.html',
      1 => 1471937825,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '114896838357c38b7d59d2f9_20901361',
  'variables' => 
  array (
    'mid' => 0,
    'startTime' => 0,
    'endTime' => 0,
    'data' => 0,
    'row' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57c38b7d67ffd2_44524076',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57c38b7d67ffd2_44524076')) {
function content_57c38b7d67ffd2_44524076 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '114896838357c38b7d59d2f9_20901361';
echo $_smarty_tpl->getSubTemplate ("common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


<div class="main">
    <?php echo $_smarty_tpl->getSubTemplate ("common/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


    <div id="right">
        <!--面包屑导航-->
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);">会员管理 </a></li>
            <li class="active">用户财富管理</li>
        </ol>
        <div class="right_con">
            <!--搜索区域-->
            <form class="form-inline pull-left">
                <div class="form-group">用户id：
                    <input type="text" name="mid" value="<?php echo $_smarty_tpl->tpl_vars['mid']->value;?>
" class="form-control" placeholder="用户id">
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
                    <td>用户ID</td>
                    <td>用户昵称</td>
                    <td>已经提现金额</td>
                    <td>未提现金额</td>
                    <td>提现金额</td>
                    <td>销售额</td>
                    <td>奖励金额</td>
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
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['m_id'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['m_nickname'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['mw_had_withdraw_money'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['mw_not_withdraw_money'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['mw_withdraw_money'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['mw_sales_money'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['mw_award_money'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['mw_addtime'];?>
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