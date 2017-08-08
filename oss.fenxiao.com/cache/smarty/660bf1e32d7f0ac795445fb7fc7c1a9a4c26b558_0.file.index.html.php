<?php /* Smarty version 3.1.27, created on 2016-08-26 10:03:44
         compiled from "/mnt/www/oss.fenxiao.com/application/views/default/focus/index.html" */ ?>
<?php
/*%%SmartyHeaderCode:70361181057bfa380790045_78896875%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '660bf1e32d7f0ac795445fb7fc7c1a9a4c26b558' => 
    array (
      0 => '/mnt/www/oss.fenxiao.com/application/views/default/focus/index.html',
      1 => 1471850541,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '70361181057bfa380790045_78896875',
  'variables' => 
  array (
    'subscribeCate' => 0,
    'ktitle' => 0,
    'subscribeType' => 0,
    'statusType' => 0,
    'allsubscribeData' => 0,
    'v' => 0,
    'subscribeCateList' => 0,
    'subscribeList' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57bfa38083d287_47058462',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57bfa38083d287_47058462')) {
function content_57bfa38083d287_47058462 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '70361181057bfa380790045_78896875';
echo $_smarty_tpl->getSubTemplate ("common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


<div class="main">
    <?php echo $_smarty_tpl->getSubTemplate ("common/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


    <div id="right">
        <!--面包屑导航-->
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);">微信管理 </a></li>
            <li class="active">关注回复配置</li>
        </ol>

        <div class="right_con">
            <!--搜索区域-->
            <form class="form-inline pull-left">
                <div class="form-group">模板：
                    <select class="form-control" name="kcate" id="kcate" class="input-medium" style="width:120px;">
                        <?php echo $_smarty_tpl->tpl_vars['subscribeCate']->value;?>

                    </select>
                </div>
                <div class="form-group">标题：
                    <input type="text" name="ktitle" value="<?php echo $_smarty_tpl->tpl_vars['ktitle']->value;?>
" class="form-control" placeholder="标题">
                </div>
                <div class="form-group">内容类型：
                    <select class="form-control" name="ktype" id="ktype" class="input-medium" style="width:120px;">
                    <?php echo $_smarty_tpl->tpl_vars['subscribeType']->value;?>

                    </select>
                </div>
                <div class="form-group">状态：
                    <select class="form-control" name="kstatus" id="kstatus"  class="input-medium" style="width:120px;">
                    <?php echo $_smarty_tpl->tpl_vars['statusType']->value;?>


                    </select>
                </div>
                <button type="submit" class="btn btn-default">搜索</button>
            </form>
            <button type="button" class="btn btn-default pull-right" onclick="window.location.reload();">刷新界面</button>
            <button type="button" class="btn btn-primary pull-right"  onclick="location.href='/focus/add/'">添加</button>

            <div class="clear10"></div>

            <!-- 表格 -->
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <!--<th>标题</th>-->
                    <!--<th>关键字</th>-->
                    <th>回复模板</th>
                    <th>内容类型</th>
                    <!--<th>跳转链接</th>-->
                    <th>状态</th>
                    <th>开始时间</th>
                    <th>结束时间</th>
                    <th>发布时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if ($_smarty_tpl->tpl_vars['allsubscribeData']->value) {?>
                <?php
$_from = $_smarty_tpl->tpl_vars['allsubscribeData']->value;
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
                    <!--<td ><?php echo $_smarty_tpl->tpl_vars['v']->value['s_title'];?>
</td>-->
                    <!--<td ><?php echo $_smarty_tpl->tpl_vars['v']->value['k_keys'];?>
</td>-->
                    <td ><?php echo $_smarty_tpl->tpl_vars['subscribeCateList']->value[$_smarty_tpl->tpl_vars['v']->value['s_cate']];?>
</td>
                    <td ><?php echo $_smarty_tpl->tpl_vars['subscribeList']->value[$_smarty_tpl->tpl_vars['v']->value['s_type']];?>
</td>
                    <!--<td ><?php echo $_smarty_tpl->tpl_vars['v']->value['s_url'];?>
</td>-->
                    <td >
                        <a href="javascript:void(0);" data-json="确认要更改状态吗？" data-href="/focus/status/id/<?php echo $_smarty_tpl->tpl_vars['v']->value['s_id'];?>
/status/<?php echo $_smarty_tpl->tpl_vars['v']->value['s_status'];?>
">
                            <i class="glyphicon <?php if ($_smarty_tpl->tpl_vars['v']->value['s_status'] == 1) {?>glyphicon-eye-open<?php } else { ?>glyphicon-eye-close<?php }?>" title="<?php if ($_smarty_tpl->tpl_vars['v']->value['s_status'] == 2) {?>禁用<?php } else { ?>正常<?php }?>"></i>
                            <?php if ($_smarty_tpl->tpl_vars['v']->value['s_status'] == 1) {?><span class="label label-success">正常</span><?php } else { ?><span class="label label-warning">禁用</span><?php }?>
                        </a>
                       
                    </td>
                    <td ><?php if ($_smarty_tpl->tpl_vars['v']->value['s_cate'] != 1) {
echo $_smarty_tpl->tpl_vars['v']->value['s_beginTime'];
}?> </td>
                    <td ><?php if ($_smarty_tpl->tpl_vars['v']->value['s_cate'] != 1) {
echo $_smarty_tpl->tpl_vars['v']->value['s_endTime'];
}?>  </td>
                    <td ><?php echo $_smarty_tpl->tpl_vars['v']->value['addtime'];?>
 </td>
                    <td>
                        <a title="编辑关键字" data-target="#formModal" href="/focus/add/id/<?php echo $_smarty_tpl->tpl_vars['v']->value['s_id'];?>
" ><i class="glyphicon glyphicon-edit"></i></a>

                    </td>
                </tr>
                <?php
$_smarty_tpl->tpl_vars['v'] = $foreach_v_Sav;
}
?>
                <?php }?>
                </tbody>
            </table>

            <!-- 分页 -->
            <?php if ($_smarty_tpl->tpl_vars['allsubscribeData']->value) {?>
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

}
}
?>