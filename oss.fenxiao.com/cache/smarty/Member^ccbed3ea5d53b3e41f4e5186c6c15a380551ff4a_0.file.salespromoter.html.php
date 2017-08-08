<?php /* Smarty version 3.1.27, created on 2016-08-29 09:13:36
         compiled from "/mnt/www/oss.fenxiao.com/application/views/default/member/salespromoter.html" */ ?>
<?php
/*%%SmartyHeaderCode:104515753657c38c408cca51_43451326%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ccbed3ea5d53b3e41f4e5186c6c15a380551ff4a' => 
    array (
      0 => '/mnt/www/oss.fenxiao.com/application/views/default/member/salespromoter.html',
      1 => 1471847153,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '104515753657c38c408cca51_43451326',
  'variables' => 
  array (
    'startTime' => 0,
    'endTime' => 0,
    'data' => 0,
    'row' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57c38c4097ddf6_46983757',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57c38c4097ddf6_46983757')) {
function content_57c38c4097ddf6_46983757 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '104515753657c38c408cca51_43451326';
echo $_smarty_tpl->getSubTemplate ("common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


<div class="main">
    <?php echo $_smarty_tpl->getSubTemplate ("common/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


    <div id="right">
        <!--面包屑导航-->
        <ol class="breadcrumb">
            <li><a href="/member/index">会员列表 </a></li>
            <li class="active">推广人列表</li>
        </ol>
        <div class="right_con">
            <!--搜索区域-->
            <form class="form-inline pull-left">
                <div class="form-group">关注时间:
                    <input type="text" class="form-control" name="startTime" id="startTime" value="<?php echo $_smarty_tpl->tpl_vars['startTime']->value;?>
" style="width:180px; display: inline-block;"> ~
                    <input type="text" class="form-control" name="endTime" id="endTime" value="<?php echo $_smarty_tpl->tpl_vars['endTime']->value;?>
" style="width:180px; display: inline-block;">&nbsp;&nbsp;
                </div>
                <button type="submit" class="btn btn-default" >搜索</button>
            </form>
            <button type="button" class="btn btn-default pull-right" onclick="window.location.reload();">刷新界面</button>
            <div class="clear10"></div>

            <!-- 表格 -->
            <table class="table table-bordered table-striped">
                <tr>
                    <td>推广人昵称</td>
                    <td>推广人用户ID</td>
                    <td>状态</td>
                    <td>关注时间</td>
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
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['m_nickname'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['sp_spokesman'];?>
</td>
                    <td><?php if ($_smarty_tpl->tpl_vars['row']->value['sp_status'] == 1) {?>
                        <span class="label label-success">正常</span>
                        <?php } elseif ($_smarty_tpl->tpl_vars['row']->value['sp_status'] == 2) {?><span class="label label-danger">解除</span>
                        <?php }?></td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['sp_addtime'];?>
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