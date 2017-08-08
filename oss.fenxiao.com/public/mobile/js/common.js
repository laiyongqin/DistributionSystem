$(function() {
	$("[data-json]").bind('click', function() {
		var url = $(this).attr('data-href');
		$.dialog.confirm($(this).attr('data-json'), function(){
			$.getJSON(url, function(json) {
				$.dialog.tips(json.info);
				if ( json.status == 'y' ) 
					setTimeout( function() {window.location.reload()}, 1000);
			});
		}, function(){this.close()})
	});
	
	$(".form-horizontal").Validform({
		ajaxPost: true,
		tipSweep: true,
		tiptype:function(msg,o,cssctl){
			if ( o.type == 3 ) {
				lookForHelp(o.obj.parent()).next('.help-inline').html(msg).addClass('Validform_error');
			} else {
				lookForHelp(o.obj.parent()).next('.help-inline').html('').addClass('Validform_success');
			}
		},
		callback:function(json){
			var alert = $('.alert').eq(0);
			alert.show();
			if ( json.status == 'y' ) {
				alert.removeClass('alert-danger').addClass('alert-success').children('strong').html(json.info);
				setTimeout( function() {window.location.reload()}, 1000);
			} else {
				alert.addClass('alert-danger').children('strong').html(json.info);
			}
		}
	});

	// 查询错误提示父级对象，最多查四级
	function lookForHelp(obj, num){
		if(!num){
			num = 1;
		}

		if(num >= 4){
			return obj;
		}

		if(obj.next(0).hasClass('help-inline')){
			return obj;
		}else{
			return lookForHelp(obj.parent(), num+1);
		}
	}

	//ajax异步加载modal层
	$("[data-toggle='modal']").bind('click', function(){
		var target = $(this).attr('data-target');
		var url    = $(this).attr('href');
		if ( url != 'undefined') {
			$(target).load(url);
		}
	});

	//重新分页样式
	$('.pagination a').each( function() {
		$(this).hasClass('current') ? $(this).wrap('<li class="disabled" />') : $(this).wrap('<li />');
	});

	//Checkbox选中的时候高亮
	$("input:checkbox[name='id[]']").bind('change', function() {
		if ( $(this).is(':checked') == true ) {
			$(this).parentsUntil('tr').parent().addClass('info');
		} else {
			$(this).parentsUntil('tr').parent().removeClass('info');
		}
	});

	$("input:checkbox[name='id[]']").each(function() {
		var self = $(this);
		if ( $(this).parents('tr').length == 1 ) {
			var $parent = $(this).parents('tr');
		} else {
			var $parent = $(this).parents('div');
		}
		$parent.bind('click', function(event) {
			self.is(':checked') == true ?self.removeAttr('checked') : self.attr('checked', true);
			self.triggerHandler('change');
		});
	});

	//全选
	$("[data-choose='all']").bind('click', function(){
		$("input:checkbox[name='id[]']").each(function(){
			$(this).attr("checked", true );
			$(this).triggerHandler('change');
		});
	});
	//取消
	$("[data-choose='null']").bind('click',function(){
		$("input:checkbox[name='id[]']").each(function(){
		  	$("input:checkbox[name='id[]']").removeAttr("checked");
		  	$(this).triggerHandler('change');
		});
	});
	//反选
	$("[data-choose='opp']").bind('click',function(){
		$("input:checkbox[name='id[]']").each(function(){
			$(this).is(":checked") ? $(this).removeAttr("checked") : $(this).attr("checked",'true');
			$(this).triggerHandler('change');
		});
	});

});