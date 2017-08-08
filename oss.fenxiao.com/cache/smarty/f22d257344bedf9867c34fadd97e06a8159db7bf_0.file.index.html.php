<?php /* Smarty version 3.1.27, created on 2016-08-26 10:03:27
         compiled from "/mnt/www/oss.fenxiao.com/application/views/default/diymenu/index.html" */ ?>
<?php
/*%%SmartyHeaderCode:191336687157bfa36f6d0bb9_69136978%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f22d257344bedf9867c34fadd97e06a8159db7bf' => 
    array (
      0 => '/mnt/www/oss.fenxiao.com/application/views/default/diymenu/index.html',
      1 => 1471488688,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '191336687157bfa36f6d0bb9_69136978',
  'variables' => 
  array (
    'menuOption' => 0,
    'statusOption' => 0,
    'data' => 0,
    'row' => 0,
    'menuList' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57bfa36f779be3_20621014',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57bfa36f779be3_20621014')) {
function content_57bfa36f779be3_20621014 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '191336687157bfa36f6d0bb9_69136978';
echo $_smarty_tpl->getSubTemplate ("common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


<div class="main">
    <?php echo $_smarty_tpl->getSubTemplate ("common/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


    <div id="right">
        <!--面包屑导航-->
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);">微信管理 </a></li>
            <li class="active">自定义菜单</li>
        </ol>

        <div class="right_con">
            <!--搜索区域-->
            <form class="form-inline pull-left">
                <div class="form-group">菜单：
                    <select name="pid" class="form-control">
                       <?php echo $_smarty_tpl->tpl_vars['menuOption']->value;?>

                    </select>
                </div>
                <div class="form-group">状态：
                    <select name="status" class="form-control">
                        <?php echo $_smarty_tpl->tpl_vars['statusOption']->value;?>

                    </select>
                </div>
                <button type="submit" class="btn btn-default">搜索</button>
            </form>
            <button type="button" class="btn btn-default pull-right" onclick="window.location.reload();">刷新界面</button>
            <a href="#" data-json="确认要生成菜单吗？" data-href="/diymenu/create/" type="button" class="btn btn-primary pull-right">生成菜单</a>
            <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#adminModal" href="/diymenu/form/">添加菜单</button>

            <div class="clear10"></div>

            <!-- 表格 -->
            <table class="table table-bordered table-striped">
                <tr>
                    <td>序号</td>
                    <td>上级菜单</td>
                    <td>菜单名称</td>
                    <td>菜单类型</td>
                    <td>菜单键值</td>
                    <td>排序</td>
                    <td>状态</td>
                    <td>添加时间</td>
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
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['wm_id'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['menuList']->value[$_smarty_tpl->tpl_vars['row']->value['wm_pid']];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['wm_name'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['wm_type'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['wm_key'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['wm_sort'];?>
</td>
                    <td><a href="#" data-json="确认要更改状态吗？" data-href="/ajax/diymenu/status/id/<?php echo $_smarty_tpl->tpl_vars['row']->value['wm_id'];?>
/status/<?php echo $_smarty_tpl->tpl_vars['row']->value['wm_status'];?>
">
                        <i class="glyphicon <?php if ($_smarty_tpl->tpl_vars['row']->value['wm_status'] == 1) {?>glyphicon-eye-open<?php } else { ?>glyphicon-eye-close<?php }?>" title="<?php if ($_smarty_tpl->tpl_vars['row']->value['wm_status'] == 2) {?>禁用<?php } else { ?>正常<?php }?>"></i>
                        <?php if ($_smarty_tpl->tpl_vars['row']->value['wm_status'] == 1) {?><span class="label label-success">正常</span><?php } else { ?><span class="label label-warning">禁用</span><?php }?>
                    </a></td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['wm_addtime'];?>
</td>
                    <td>
                        <a  data-toggle="modal" data-target="#adminModal" href="/diymenu/form/id/<?php echo $_smarty_tpl->tpl_vars['row']->value['wm_id'];?>
" title="编辑分类">编辑</a>&nbsp;&nbsp;
                    </td>
                </tr>
                <?php
$_smarty_tpl->tpl_vars['row'] = $foreach_row_Sav;
}
?>
                <?php }?>
            </table>

        </div>

        <!--弹窗-->
        <form class="form-horizontal" action="/ajax/diymenu/save" method="post">
            <div class="modal fade" id="adminModal" tabindex="-1" role="dialog"></div>
        </form>
    </div>
    <div class="clear"></div>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);

}
}
?>