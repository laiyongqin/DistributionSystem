<?php /* Smarty version 3.1.27, created on 2016-08-20 17:30:37
         compiled from "/mnt/www/wx.fenxiao.com/application/modules/Mall/views/product/buy.html" */ ?>
<?php
/*%%SmartyHeaderCode:39556740257b8233d582984_26935488%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f7d4217686c7d25170600be20b818db2eb2f146c' => 
    array (
      0 => '/mnt/www/wx.fenxiao.com/application/modules/Mall/views/product/buy.html',
      1 => 1471680222,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '39556740257b8233d582984_26935488',
  'variables' => 
  array (
    'data' => 0,
    'price' => 0,
    'ppids' => 0,
    'address' => 0,
    'ppList' => 0,
    'key' => 0,
    'ppType' => 0,
    'vo' => 0,
    'k' => 0,
    'v' => 0,
    'signPackage' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57b8233d5ddc46_09608041',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57b8233d5ddc46_09608041')) {
function content_57b8233d5ddc46_09608041 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '39556740257b8233d582984_26935488';
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>立即购买</title>
    <link rel="stylesheet" type="text/css" href="/public/js/weui/weui.min.css">
    <link rel="stylesheet" type="text/css" href="/public/js/weui/jquery-weui.css">
    <link rel="stylesheet" type="text/css" href="/public/css/style.css">
    <link rel="stylesheet" type="text/css" href="/public/css/iconfont.css">
</head>


<body style="padding-bottom:4vw;">

<div class="pay">
    <img src="<?php echo $_smarty_tpl->tpl_vars['data']->value['p_cover'];?>
">
    <div class="title"><?php echo $_smarty_tpl->tpl_vars['data']->value['p_title'];?>
</div>

    <form id="buyForm">
        <input type="hidden" name="p_id" id="p_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['p_id'];?>
">
        <input type="hidden" name="price" id="price" value="<?php echo $_smarty_tpl->tpl_vars['price']->value;?>
">
        <input type="hidden" name="ppList" id="ppList" value="<?php echo $_smarty_tpl->tpl_vars['ppids']->value;?>
">
        <!--<div class="title">今日限购剩余：<span>24</span>份</div>-->
        <div class="pay-form">
            <ul>
                <li><i>*</i><span>购买数量：</span><input type="text" name="num" maxlength="value" class="spinner" readonly/></li>
                <li><i>*</i><span>联系人：</span><input type="text" name="realname" id="realname" value="<?php echo $_smarty_tpl->tpl_vars['address']->value['a_realname'];?>
"></li>
                <li><i>*</i><span>联系电话：</span><input type="number" name="phone" id="phone" value="<?php echo $_smarty_tpl->tpl_vars['address']->value['a_phone'];?>
"></li>
                <li><i>*</i><span>微信号：</span><input type="text" name="wechat" id="wechat" value="<?php echo $_smarty_tpl->tpl_vars['address']->value['a_wechat_id'];?>
"></li>

                <li id="city"><i>*</i><span>所在地区：</span>
                    <div class="select-box">

                        <div class="select">
                            <i class="icon iconfont">&#xe61d;</i>
                            <select class="prov" name="prov" ></select>
                        </div>

                        <div class="select">
                            <i class="icon iconfont">&#xe61d;</i>
                            <select class="city" name="city" disabled="disabled"></select>
                        </div>

                        <div class="select">
                            <i class="icon iconfont">&#xe61d;</i>
                            <select class="dist" name="dist" disabled="disabled"></select>
                        </div>

                    </div>

                </li>

                <li><i>*</i><span>联系地址：</span><textarea name="address" id="address"><?php echo $_smarty_tpl->tpl_vars['address']->value['a_address'];?>
</textarea></li>
                <?php if ($_smarty_tpl->tpl_vars['ppList']->value) {?>
                    <?php
$_from = $_smarty_tpl->tpl_vars['ppList']->value;
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
                        <li><span><?php echo $_smarty_tpl->tpl_vars['ppType']->value[$_smarty_tpl->tpl_vars['key']->value];?>
：</span>
                            <?php
$_from = $_smarty_tpl->tpl_vars['vo']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['v'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['v']->_loop = false;
$_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
$foreach_v_Sav = $_smarty_tpl->tpl_vars['v'];
?>
                                <a <?php if ($_smarty_tpl->tpl_vars['k']->value == 0) {?>class="on"<?php }?> pp_id="<?php echo $_smarty_tpl->tpl_vars['v']->value['pp_id'];?>
" <?php if ($_smarty_tpl->tpl_vars['v']->value['pp_status'] == 1) {?>price = <?php echo $_smarty_tpl->tpl_vars['v']->value['pp_event_price'];
} else { ?>price=<?php echo $_smarty_tpl->tpl_vars['v']->value['pp_original_price'];
}?>><?php echo $_smarty_tpl->tpl_vars['v']->value['pp_name'];?>
</a>
                            <?php
$_smarty_tpl->tpl_vars['v'] = $foreach_v_Sav;
}
?>
                        </li>
                    <?php
$_smarty_tpl->tpl_vars['vo'] = $foreach_vo_Sav;
}
?>
                <?php }?>

                <li><span>备注：</span><textarea name="remark" id="remark"></textarea></li>
            </ul>
            <div class="title">已选：<span id="num">1</span>份　共计：￥<span id="total"><?php echo $_smarty_tpl->tpl_vars['price']->value;?>
</span>元</div>
            <input type="button" class="btn" value="立即购买" id="buyBtn">
        </div>
        </form>
</div>
<?php echo '<script'; ?>
 src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/public/js/jquery-2.1.4.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/public/js/city/city.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/public/js/city/jquery.cityselect.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/public/js/jquery.spinner.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/public/js/weui/jquery-weui.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>

    var appId     = '<?php echo $_smarty_tpl->tpl_vars['signPackage']->value['appId'];?>
';var timestamp = '<?php echo $_smarty_tpl->tpl_vars['signPackage']->value['timestamp'];?>
';
    var nonceStr  = '<?php echo $_smarty_tpl->tpl_vars['signPackage']->value['nonceStr'];?>
';var signature = '<?php echo $_smarty_tpl->tpl_vars['signPackage']->value['signature'];?>
';

    $(document).ready(function(){
        wx.config({
            debug : false,
            appId: appId,
            timestamp:timestamp,
            nonceStr: nonceStr,
            signature: signature,
            jsApiList: [
                'checkJsApi',
                'onMenuShareTimeline',
                'getLocation'
            ]
        });

        wx.ready(function () {
//            wx.checkJsApi({
//                jsApiList: [
//                    'getNetworkType',
//                    'previewImage'
//                ],
//                success: function (res) {
//                }
//            });

//            wx.getLocation({
//                type: 'wgs84',
//                success: function (res) {
//                    var latitude = res.latitude;
//                    var longitude = res.longitude;
//                    var speed = res.speed;
//                    var accuracy = res.accuracy;alert(latitude);
//                    $.post('/ajax/location/index', {latitude : latitude, longitude : longitude}, function(data){
//
//                    }, 'json')
//                }
//            });
        });

        $('#buyBtn').click(function(){
            $.ajax({
                type: 'POST',
                url : "/ajax/product/buy",
                data : $('#buyForm').serialize(),
                dataType: 'json',
                success: function(data){
                    if(data.status == 'y'){
                        location.href = '/payment/order/orderNo/' + data.info.orderNo;
                    }else{
                        $.alert(data.info);
                    }
                }
            });
        });

        //城市联动
        $.citySelect({
            obj: $('#city'),
            prov:"<?php echo $_smarty_tpl->tpl_vars['address']->value['a_province'];?>
",
            city:"<?php echo $_smarty_tpl->tpl_vars['address']->value['a_city'];?>
",
            dist:"<?php echo $_smarty_tpl->tpl_vars['address']->value['a_area'];?>
",
            nodata:"none"
        });

        $('.spinner').spinner({
            value:1,
            min : 1,
            target : 'productPrice'
        });

        $(".pay-form ul li a").click(function(){
            $(this).siblings().removeClass('on');
            $(this).addClass('on');
            var num = parseInt($('#num').html());
            var price = 0;
            var ppids = [];
            $(".pay-form ul li a").each(function(){
                if($(this).hasClass('on')){
                    price += parseInt($(this).attr('price'));
                    ppids.push($(this).attr('pp_id'));
                }
            });

            $('#price').val(price);
            $('#total').html(price * num);
            $('#ppList').val(ppids.join(','));
        });
    });

    function changeSpinner(target, val){
        var p = $('#price').val();
        $('#num').html(val);
        $('#total').html(val * p);
    }
<?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
?>