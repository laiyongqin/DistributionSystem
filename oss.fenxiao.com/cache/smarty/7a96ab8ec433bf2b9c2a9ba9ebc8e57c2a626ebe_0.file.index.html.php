<?php /* Smarty version 3.1.27, created on 2016-09-07 09:48:33
         compiled from "/mnt/www/oss.fenxiao.com/application/views/default/member/index.html" */ ?>
<?php
/*%%SmartyHeaderCode:94936332157cf71f1ca3409_85156924%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7a96ab8ec433bf2b9c2a9ba9ebc8e57c2a626ebe' => 
    array (
      0 => '/mnt/www/oss.fenxiao.com/application/views/default/member/index.html',
      1 => 1473212567,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '94936332157cf71f1ca3409_85156924',
  'variables' => 
  array (
    'mid' => 0,
    'name' => 0,
    'phone' => 0,
    'vipOption' => 0,
    'statusOption' => 0,
    'data' => 0,
    'row' => 0,
    'baseUrl' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57cf71f1d33210_90007177',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57cf71f1d33210_90007177')) {
function content_57cf71f1d33210_90007177 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '94936332157cf71f1ca3409_85156924';
echo $_smarty_tpl->getSubTemplate ("common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


<div class="main">
    <?php echo $_smarty_tpl->getSubTemplate ("common/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


    <div id="right">
        <!--面包屑导航-->
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);">会员管理 </a></li>
            <!--<li><a href="/admin/index/">帐号管理</a></li>-->
            <li class="active">会员管理列表</li>
        </ol>

        <div class="right_con">
            <!--搜索区域-->
            <form class="form-inline pull-left">
                <div class="form-group">
                    用户id: <input type="text" name="mid" value="<?php echo $_smarty_tpl->tpl_vars['mid']->value;?>
" class="form-control" placeholder="用户id">&nbsp;&nbsp;
                   登陆名: <input type="text" name="name" value="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
" class="form-control" placeholder="登陆名">&nbsp;&nbsp;
                   联系电话: <input type="text" name="phone" value="<?php echo $_smarty_tpl->tpl_vars['phone']->value;?>
" class="form-control" placeholder="联系电话">&nbsp;&nbsp;
                    用户等级：<select name="vip" class="form-control">
                    <?php echo $_smarty_tpl->tpl_vars['vipOption']->value;?>

                </select>
                    用户状态：<select name="status" class="form-control">
                        <?php echo $_smarty_tpl->tpl_vars['statusOption']->value;?>

                    </select>
                </div>
                <button type="submit" class="btn btn-default">搜索</button>
            </form>
            <button type="button" class="btn btn-default pull-right" onclick="window.location.reload();">刷新界面</button>
            <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#adminModal" href="/member/form/">添加用户</button>

            <div class="clear10"></div>

            <!-- 表格 -->
            <table class="table table-bordered table-striped">
                <tr>
                    <td>用户id</td>
                    <td>Open ID</td>
                    <td>登录名</td>
                    <td>昵称</td>
                    <td>姓名</td>
                    <td>电话</td>
                    <td>会员类型</td>
                    <td>消费金额</td>
                    <td>状态</td>
                    <td>添加时间</td>
                    <td>分销订单查看</td>
                    <td>推广人查看</td>
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
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['m_id'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['m_openId'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['m_username'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['m_nickname'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['m_realname'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['m_phone'];?>
</td>
                    <td><?php if ($_smarty_tpl->tpl_vars['row']->value['m_vip'] == 1) {?><span class="label label-success">平台用户</span><?php } elseif ($_smarty_tpl->tpl_vars['row']->value['m_vip'] == 2) {?><span class="label label-info">代言人</span><?php }?></td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['m_consume'];?>
</td>
                    <td>
                        <a href="#" data-json="确认要更改状态吗？" data-href="/ajax/member/status/id/<?php echo $_smarty_tpl->tpl_vars['row']->value['m_id'];?>
/status/<?php echo $_smarty_tpl->tpl_vars['row']->value['m_status'];?>
">
                            <i class="glyphicon <?php if ($_smarty_tpl->tpl_vars['row']->value['m_status'] == 1) {?>glyphicon-eye-open<?php } else { ?>glyphicon-eye-close<?php }?>" title="<?php if ($_smarty_tpl->tpl_vars['row']->value['m_status'] == 2) {?>禁用<?php } else { ?>正常<?php }?>"></i>
                            <?php if ($_smarty_tpl->tpl_vars['row']->value['m_status'] == 1) {?><span class="label label-success">正常</span><?php } else { ?><span class="label label-warning">禁用</span><?php }?>
                        </a>
                    </td>
                    <!--<td>-->
                        <!--<a data-toggle="modal" href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
formPassword/id/<?php echo $_smarty_tpl->tpl_vars['row']->value['m_id'];?>
" data-target="#formPasswordModal" title="修改密码"><i class="glyphicon glyphicon-lock"></i></a>-->
                    <!--</td>-->
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['m_addtime'];?>
</td>
                    <td>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
sales/mid/<?php echo $_smarty_tpl->tpl_vars['row']->value['m_id'];?>
" title="分销订单">点击查看</a>
                    </td>
                    <td> <a href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
salespromoter/mid/<?php echo $_smarty_tpl->tpl_vars['row']->value['m_id'];?>
" title="分销订单">点击查看</a></td>
                    <td>
                        <a class="glyphicon glyphicon-edit" data-toggle="modal" data-target="#adminModal" href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
/form/id/<?php echo $_smarty_tpl->tpl_vars['row']->value['m_id'];?>
" title="编辑管理员"></a>&nbsp;&nbsp;
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

        <!--弹窗-->
        <form class="form-horizontal" action="/ajax/member/save/" method="post">
            <div class="modal fade" id="adminModal" tabindex="-1" role="dialog"></div>
        </form>
    </div>
    <div class="clear"></div>
</div>
<?php echo $_smarty_tpl->getSubTemplate ("common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);

}
}
?>