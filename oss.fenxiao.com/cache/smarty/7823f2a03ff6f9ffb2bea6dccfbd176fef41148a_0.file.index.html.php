<?php /* Smarty version 3.1.27, created on 2016-11-22 14:49:02
         compiled from "/mnt/www/oss.fenxiao.com/application/views/default/cashlog/index.html" */ ?>
<?php
/*%%SmartyHeaderCode:11046863655833ea5e254034_91284577%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7823f2a03ff6f9ffb2bea6dccfbd176fef41148a' => 
    array (
      0 => '/mnt/www/oss.fenxiao.com/application/views/default/cashlog/index.html',
      1 => 1471937825,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11046863655833ea5e254034_91284577',
  'variables' => 
  array (
    'startTime' => 0,
    'endTime' => 0,
    'data' => 0,
    'row' => 0,
    'status' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5833ea5e32d9e7_94906714',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5833ea5e32d9e7_94906714')) {
function content_5833ea5e32d9e7_94906714 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '11046863655833ea5e254034_91284577';
echo $_smarty_tpl->getSubTemplate ("common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


<div class="main">
    <?php echo $_smarty_tpl->getSubTemplate ("common/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


    <div id="right">
        <!--面包屑导航-->
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);"> 财务管理</a></li>
            <li class="active">提现记录</li>
        </ol>
        <div class="right_con">
            <!--搜索区域-->
            <form class="form-inline pull-left">
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
                    <td>用户ID</td>
                    <td>用户昵称</td>
                    <td>提现金额</td>
                    <td>提现状态</td>
                    <td>添加时间</td>
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
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['pw_id'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['m_id'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['m_nickname'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['pw_money'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['status']->value[$_smarty_tpl->tpl_vars['row']->value['pw_status']];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['pw_addtime'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['pw_updatetime'];?>
</td>
                    <td>
                        <?php if ($_smarty_tpl->tpl_vars['row']->value['pw_status'] == 1) {?>
                        <a href="#" data-json="确认要给用户提现吗？" data-href="/ajax/withdraw/deal/id/<?php echo $_smarty_tpl->tpl_vars['row']->value['pw_id'];?>
">
                            <i class="glyphicon glyphicon-yen" title="处理提现"></i>
                            <span class="label label-success">发送红包</span>
                        </a>
                        <?php }?>
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