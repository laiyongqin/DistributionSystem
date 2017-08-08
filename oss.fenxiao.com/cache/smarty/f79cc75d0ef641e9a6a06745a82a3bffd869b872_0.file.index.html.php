<?php /* Smarty version 3.1.27, created on 2016-09-07 10:42:21
         compiled from "/mnt/www/oss.fenxiao.com/application/views/default/config/index.html" */ ?>
<?php
/*%%SmartyHeaderCode:198772395057cf7e8dae7173_32000423%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f79cc75d0ef641e9a6a06745a82a3bffd869b872' => 
    array (
      0 => '/mnt/www/oss.fenxiao.com/application/views/default/config/index.html',
      1 => 1471919736,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '198772395057cf7e8dae7173_32000423',
  'variables' => 
  array (
    'typeList' => 0,
    'tid' => 0,
    'key' => 0,
    'vo' => 0,
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57cf7e8dba95b5_09699794',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57cf7e8dba95b5_09699794')) {
function content_57cf7e8dba95b5_09699794 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '198772395057cf7e8dae7173_32000423';
echo $_smarty_tpl->getSubTemplate ("common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


<div class="main">
    <?php echo $_smarty_tpl->getSubTemplate ("common/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


    <div id="right">
        <!--面包屑导航-->
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);">系统管理 </a></li>
            <li class="active">配置管理</li>
        </ol>

        <div class="right_con">
            <div class="tabbable" >
                <ul class="nav nav-tabs">
                    <?php
$_from = $_smarty_tpl->tpl_vars['typeList']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['vo'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['vo']->_loop = false;
$_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['vo']->value) {
$_smarty_tpl->tpl_vars['vo']->_loop = true;
$foreach_vo_Sav = $_smarty_tpl->tpl_vars['vo'];
?>
                    <li <?php if ($_smarty_tpl->tpl_vars['tid']->value == $_smarty_tpl->tpl_vars['key']->value) {?>class="active"<?php }?>><a href="/config/index?tid=<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" ><?php echo $_smarty_tpl->tpl_vars['vo']->value;?>
</a></li>
                    <?php
$_smarty_tpl->tpl_vars['vo'] = $foreach_vo_Sav;
}
?>
                </ul>
                <div class="tab-content">
                    <form class="form-horizontal" id="form-save" action="/config/save/">
                        <div class="tab-pane active" id="basic_right" style="padding-top: 50px;">
                            <?php if ($_smarty_tpl->tpl_vars['tid']->value == 1) {?>
                            <input type="hidden" name="id_<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['bc_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['bc_id'];?>
" />
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo $_smarty_tpl->tpl_vars['data']->value[0]['bc_title'];?>
</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="bc_value_<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['bc_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['bc_value'];?>
" placeholder="内容" datatype="*" nullmsg="请填写名称"/>
                                </div>
                            </div>
                            <input type="hidden" name="id_<?php echo $_smarty_tpl->tpl_vars['data']->value[1]['bc_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[1]['bc_id'];?>
" />
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo $_smarty_tpl->tpl_vars['data']->value[1]['bc_title'];?>
</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="bc_value_<?php echo $_smarty_tpl->tpl_vars['data']->value[1]['bc_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[1]['bc_value'];?>
" placeholder="内容" datatype="*" nullmsg="请填写名称"/>
                                </div>
                            </div>

                            <input type="hidden" name="id_<?php echo $_smarty_tpl->tpl_vars['data']->value[2]['bc_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[2]['bc_id'];?>
" />
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo $_smarty_tpl->tpl_vars['data']->value[2]['bc_title'];?>
</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="bc_value_<?php echo $_smarty_tpl->tpl_vars['data']->value[2]['bc_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[2]['bc_value'];?>
" placeholder="内容" datatype="*" nullmsg="请填写名称"/>
                                </div>
                            </div>

                            <input type="hidden" name="id_<?php echo $_smarty_tpl->tpl_vars['data']->value[3]['bc_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[3]['bc_id'];?>
" />
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo $_smarty_tpl->tpl_vars['data']->value[3]['bc_title'];?>
</label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" name="bc_value_<?php echo $_smarty_tpl->tpl_vars['data']->value[3]['bc_id'];?>
" placeholder="内容" datatype="*" nullmsg="请填写名称" style="height:100px;" ><?php echo $_smarty_tpl->tpl_vars['data']->value[3]['bc_value'];?>
</textarea>
                                </div>
                            </div>

                            <input type="hidden" name="id_<?php echo $_smarty_tpl->tpl_vars['data']->value[4]['bc_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[4]['bc_id'];?>
" />
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo $_smarty_tpl->tpl_vars['data']->value[4]['bc_title'];?>
</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="bc_value_<?php echo $_smarty_tpl->tpl_vars['data']->value[4]['bc_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[4]['bc_value'];?>
" placeholder="内容" datatype="*" nullmsg="请填写名称"/>
                                </div>
                            </div>
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['tid']->value == 2) {?>
                            <input type="hidden" name="id_<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['bc_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['bc_id'];?>
" />
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo $_smarty_tpl->tpl_vars['data']->value[0]['bc_title'];?>
</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="bc_value_<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['bc_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['bc_value'];?>
" placeholder="内容" datatype="*" nullmsg="请填写名称"/>
                                </div>
                            </div>
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['tid']->value == 4) {?>
                            <input type="hidden" name="id_<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['bc_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['bc_id'];?>
" />
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo $_smarty_tpl->tpl_vars['data']->value[0]['bc_title'];?>
</label>
                                <div class="col-sm-1">
                                    <input type="text" class="form-control" name="bc_value_<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['bc_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['bc_value'];?>
" placeholder="内容" datatype="*" nullmsg="请填写名称"/>
                                </div>
                                <label class="col-sm-1 control-label">单位:(小时)</label>
                            </div>
                            <input type="hidden" name="id_<?php echo $_smarty_tpl->tpl_vars['data']->value[1]['bc_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[1]['bc_id'];?>
" />
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo $_smarty_tpl->tpl_vars['data']->value[1]['bc_title'];?>
</label>
                                <div class="col-sm-1">
                                    <input type="text" class="form-control" name="bc_value_<?php echo $_smarty_tpl->tpl_vars['data']->value[1]['bc_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[1]['bc_value'];?>
" placeholder="内容" datatype="*" nullmsg="请填写名称"/>
                                </div>
                                <label class="col-sm-1 control-label"></label>
                            </div>
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['tid']->value == 5) {?>
                            <input type="hidden" name="id_<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['bc_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['bc_id'];?>
" />
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo $_smarty_tpl->tpl_vars['data']->value[0]['bc_title'];?>
</label>
                                <div class="col-sm-1">
                                    <input type="text" class="form-control" name="bc_value_<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['bc_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['bc_value'];?>
" placeholder="内容" datatype="*" nullmsg="请填写名称"/>
                                </div>
                                <label class="col-sm-1 control-label">单位:(天)</label>
                            </div>
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['tid']->value == 6) {?>
                            <input type="hidden" name="id_<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['bc_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['bc_id'];?>
" />
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo $_smarty_tpl->tpl_vars['data']->value[0]['bc_title'];?>
</label>
                                <div class="col-sm-1">
                                    <input type="text" class="form-control" name="bc_value_<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['bc_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[0]['bc_value'];?>
" placeholder="内容" datatype="*" nullmsg="请填写名称"/>
                                </div>
                                <label class="col-sm-1 control-label">单位:(元)</label>
                            </div>
                            <input type="hidden" name="id_<?php echo $_smarty_tpl->tpl_vars['data']->value[1]['bc_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[1]['bc_id'];?>
" />
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo $_smarty_tpl->tpl_vars['data']->value[1]['bc_title'];?>
</label>
                                <div class="col-sm-1">
                                    <input type="text" class="form-control" name="bc_value_<?php echo $_smarty_tpl->tpl_vars['data']->value[1]['bc_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[1]['bc_value'];?>
" placeholder="内容" datatype="*" nullmsg="请填写名称"/>
                                </div>
                                <label class="col-sm-1 control-label">单位:(次数)</label>
                            </div>

                            <!--<input type="hidden" name="id_<?php echo $_smarty_tpl->tpl_vars['data']->value[2]['bc_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[2]['bc_id'];?>
" />-->
                            <!--<div class="form-group">-->
                                <!--<label class="col-sm-2 control-label"><?php echo $_smarty_tpl->tpl_vars['data']->value[2]['bc_title'];?>
</label>-->
                                <!--<div class="col-sm-1">-->
                                    <!--<input type="text" class="form-control" name="bc_value_<?php echo $_smarty_tpl->tpl_vars['data']->value[2]['bc_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[2]['bc_value'];?>
" placeholder="内容" datatype="*" nullmsg="请填写名称"/>-->
                                <!--</div>-->
                                <!--<label class="col-sm-1 control-label">单位:(元)</label>-->
                            <!--</div>-->
                            <input type="hidden" name="id_<?php echo $_smarty_tpl->tpl_vars['data']->value[3]['bc_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[3]['bc_id'];?>
" />
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo $_smarty_tpl->tpl_vars['data']->value[3]['bc_title'];?>
</label>
                                <div class="col-sm-1">
                                    <input type="text" class="form-control" name="bc_value_<?php echo $_smarty_tpl->tpl_vars['data']->value[3]['bc_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[3]['bc_value'];?>
" placeholder="内容" datatype="*" nullmsg="请填写名称"/>
                                </div>
                                <label class="col-sm-1 control-label">单位:(元)</label>
                            </div>
                            <?php }?>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-4">
                                <button class="btn btn-primary" type="submit">保存</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
<?php echo $_smarty_tpl->getSubTemplate ("common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);

}
}
?>