// JavaScript Document
/*
Author:sean.xiao
*/
(function($) {
var ValidatorDefault = {
	_defaults:{},
	//基础配置文件（默认）
	_options:{
		currentForm: '',//表单对象
		errorContainer: false,//是否固定错误信息显示位置，false|#id
		classError:'error',
		classSuccess:'success',
		classMessage:'showmsg',
		onkeyup:false,//当键盘弹起时触发,即输入结束时。
		onfocusin:false,	//获得焦点的时触发
		onfocusout: true,//失去焦点的时触发
		onloading:false,//在加载时触发
		onsubmit: true,//在提交时触发
		rules: {},
		textlimit:false,
		beforeSubmit: function() { return true; },
		ajaxSubmit:{
			options:null
		}
	},
	//基本验证规则
	validatesTypeText : {
		required:{type:'required'},//非空
		notZero:{type:'parseFloat'},//浮点数
		strlen:{type:'range',length:'string'},//范围控制，字符串长度
		numlen:{type:'range',length:'num'},//范围控制，数字大小范围
		checklen:{type:'range',length:'check'},//选择个数控制，数字大小范围
		eq:{type:'compare',etc:false},//比较，必须和一个对象的值相等
		neq:{type:'compare',etc:true},//比较，不能和一个对象的值相等
		string:{type:'exec',patrn:/^[A-Za-z]+$/},//必须为字符串
		username:{type:'exec',patrn:/^[A-Za-z0-9_]+$/},//一般用户名规则
		password:{type:'exec',patrn:/^(.+){6,16}$/},//一般密码规则
		email:{type:'exec',patrn:/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/},//email验证规则
		numeric:{type:'exec',patrn:/^\d+(\.\d+)?$/},//数字
		telphone:{type:'exec',patrn:/^((\(\d{2,3}\))|(\d{3}\-))?(\(0\d{2,3}\)|0\d{2,3}-)?[1-9]\d{6,7}(\-\d{1,4})?$/},//电话
		chinese:{type:'exec',patrn:/[\u4e00-\u9fa5]/},//必须为中文
		english:{type:'exec',patrn:/[\u4e00-\u9fa5]/,etc:true},//必须为英文
		currency:{type:'exec',patrn:/^\d+(?:\.\d{0,2})?$/},//货币单位
		idCard:{type:'exec',patrn:/^(\d{6})(18|19|20)?(\d{2})([01]\d)([0123]\d)(\d{3})(\d|X)?$/},//身份证
		url:{type:'exec',patrn: /http(s)?:\/\/([\w-]+\.)+[\w-]+(\/[\w- .\/?%&=]*)?/},
		exec:{type:'exec'},//自定义正则验证规范，在rules里，partrn属性必填
		ajax:{type:'ajax'}
	},
	//验证类型
	_validatesType : function(valiTypeName,_defaults,valname,obj_val,obj){
			var is_obj_flag  = true;
			var v = this.validatesTypeText[valiTypeName];
			var message = '';
			if(v){
				switch(v.type){
					case 'required':
						sType = obj.get(0).type;
						if(sType == 'checkbox' || sType == 'radio'){
							var falg = $('input[valname="'+valname+'"]:checked').size();
							if(falg <=0){ is_obj_flag = false; }
						}else if(sType == 'selected-one' || sType == 'selected-one'){
							if(obj.find('option:selected').size() <=0){ is_obj_flag = false; }
						}else{
							if (obj_val == '' || obj_val == null) { is_obj_flag = false;}
						}
						break;
					case 'exec':
						if(obj_val){
							var _patrn = v.patrn ? v.patrn : _defaults.rules[valname]['patrn'];
							var _etc = v.etc ? v.etc : (_defaults.rules[valname]['etc'] ? _defaults.rules[valname]['etc'] : false);
							if(_etc == false){
								if( !_patrn.exec(obj_val) ){ is_obj_flag = false;}
							}else{
								if(_patrn.exec(obj_val) ){ is_obj_flag = false;}
							}
						}
						break;
					case 'range':
						_min = parseInt(_defaults.rules[valname]['min'] ? _defaults.rules[valname]['min'] : $(this).attr('min'));
						_max = parseInt(_defaults.rules[valname]['max'] ? _defaults.rules[valname]['max'] : $(this).attr('max'));
						if(v.length=='string'){
							obj_val = obj_val.length;
							if (obj_val < _min || obj_val > _max) { is_obj_flag = false; }
						}else if(v.length=='num'){
							if (parseInt(obj_val) < _min || parseInt(obj_val) > _max) { is_obj_flag = false; }
						}else if(v.length=='check'){
							var obj_val = $('input[valname="'+valname+'"]:checked').length;
							if(_min>0){
								if(obj_val < _min){ is_obj_flag = false;}	
							}
							if(_max>0){
								if(obj_val > _max){ is_obj_flag = false;}	
							}
						}
						break;
					case 'compare':
						var compare = _defaults.rules[valname]['compare'] ? _defaults.rules[valname]['compare'] : $(this).attr('compare');
						if(compare.indexOf("#") >=0){
							var vals = $(compare).val();
						}else{
							var vals = compare	
						}
						if(v.etc == false){
							if (vals != obj_val && compare != obj_val) { is_obj_flag = false; }
						}else if(v.etc == true){
							if (vals == obj_val || compare == obj_val) { is_obj_flag = false; }
						}
						break;
					case "parseFloat":
						if (parseFloat(obj_val) == 0) { is_obj_flag = false; }
						break;
					case 'ajax':
						this._msg(_defaults,obj,'loading');
						var url = _defaults.rules[valname]['url'] ? _defaults.rules[valname]['url'] : $(this).attr('url');
						var response = $.ajax({url: url,data: "valname=" + obj_val,cache: false,async: false}).responseText;
						if(response != true){
							is_obj_flag = false; 
							if(response != ""){ message = response; }
						}
						break;
				}
			}else{
				is_obj_flag = false;	
			}
			var result = {
				state:is_obj_flag,
				msg:message	
			}
			return result;
	},
	//验证方法
	_valid : function(_defaults,obj){
		var valname = obj.attr('valname');
		var validates = valname in _defaults.rules ? _defaults.rules[valname]['valid'] : obj.attr('valid');
		var errmsg = valname in _defaults.rules ? _defaults.rules[valname]['errmsg'] : obj.attr('errmsg');
		
		if (validates) validates = validates.split('|'); else return true;
		if (errmsg) errmsg = errmsg.split('|'); else return true;
		var obj_val = obj.val();
		for (j=0; j<validates.length; j++) {
			var validate = validates[j];
			var message = errmsg[j];
			var is_obj_flag = true;
			
			var result = this._validatesType(validate,_defaults,valname,obj_val,obj);
			is_obj_flag = result.state;
			message = result.msg!='' ? result.msg : message;
			if(is_obj_flag == false){
				this._msg(_defaults,obj,'error',message);
				return false;
			}
		}
		this._msg(_defaults,obj,'success');
		return true;
		
	},
	//消息控制
	_msg : function(_defaults,obj,type,message){
		var valname = $(obj).attr('valname') ? $(obj).attr('valname') : $(obj).attr('id');
		if(message == null){message = '';}
		if(type == null || type == 'msg'){
			var msg = valname in _defaults.rules ? _defaults.rules[valname]['msg'] : "";
			if(msg == "") {return false;}
			var htmlSpanClass = _defaults.classMessage,htmlSpanContent = msg;
		}else if(type == 'success'){
			var htmlSpanClass = _defaults.classSuccess,htmlSpanContent = '正确';
		}else if(type == 'error'){
			var htmlSpanClass = _defaults.classError,htmlSpanContent = message;	
		}else if(type == 'loading'){
			var htmlSpanClass = 'showloading',htmlSpanContent = message;
		}
		this._appendHtml(_defaults,obj,valname,type,htmlSpanClass,htmlSpanContent);
	},
	//添加消息显示
	_appendHtml : function(_defaults,obj,valname,type,htmlSpanClass,htmlSpanContent){
		var _defaults = _defaults;
		if(type == 'error'){
			$(obj).addClass('invalid');	//如果是错误提示，当前输入框加亮。
		}
		if($('#'+valname+'_invalid').size() > 0){
			//$('#'+valname+'_invalid').replaceWith(html);
			$('#'+valname+'_invalid').removeClass().addClass(htmlSpanClass).empty().text(htmlSpanContent);
			return true;
		}
		//var html = '<div id="'+valname+'_invalid" class="'+htmlSpanClass+'">'+htmlSpanContent+'</span>';
		var html = htmlSpanContent;
		if (_defaults.errorContainer) {
			$(_defaults.errorContainer).show().append(html);
		} else {
			var container = _defaults.rules[valname]['container'] ? _defaults.rules[valname]['container'] : '';
			if(container){
				$(container).empty().append(html);
			}else{
				$(obj).parent().append(html);
			}
		}
	}
};
$.fn.validator = function(options){
	var _defaults = $.fn.extend({},ValidatorDefault._options,options);
	_defaults.currentForm = $(this).attr('id');
	if (_defaults.errorContainer) {
		$(_defaults.errorContainer).hide();
	}
	//$('input,select,textarea', this).each(function(i,obj) {
	//对表单内的所有表单属性对象循环，添加相关的事件
	
	$(this).find('input,select,textarea').each(function(i) {
		var type = $(this).attr('type');
		var valname = $(this).attr('valname');
		if(type != 'submit' && type != 'button' && valname != ''){
			if (_defaults.onfocusout) {
				$(this).focusout(function() { ValidatorDefault._valid(_defaults,$(this)) });
			}
			if (_defaults.onfocusin) {
				$(this).bind('focusin',function() {ValidatorDefault._msg(_defaults,$(this),'msg');});
			}
			if (_defaults.onloading) {
				ValidatorDefault._msg(_defaults,$(this),'msg');
			}
			if (_defaults.onkeyup) {
				$(this).keyup(function() {ValidatorDefault. _valid(_defaults,$(this)) });
			}
		}
	});
	//特别情况，txt字数的控制显示
	if(typeof _defaults.textlimit == 'object'){
		$(_defaults.textlimit.obj).textlimit(_defaults.textlimit.counter,_defaults.textlimit.length);	
	}
	//表单提交时
	$(this).submit(function () {
		var flag = true;
		//表单提交前判断
		flag = _defaults.beforeSubmit(this, _defaults);
		var n = 0;
		$(this).find('input,select,textarea').each(function(i) {
			var type = $(this).attr('type');
			if(type != 'submit' && type != 'button'){
				if(ValidatorDefault._valid(_defaults,$(this))==false){
					n+=1;	
				}
			}
		});
		if(n>0){
			flag = false;	
		}
		//ajax表单提交方式控制
		if(flag == true && _defaults.ajaxSubmit.options != null){
			$(this).ajaxSubmit(_defaults.ajaxSubmit.options);
			return false;
		}
		return flag;
	});
};
$.fn.textlimit=function(counter_el, thelimit, speed) {
	var charDelSpeed = speed || 15;
	var toggleCharDel = speed != -1;
	var toggleTrim = true;
	var that = this[0];
	var isCtrl = false; 
	updateCounter();
	
	function updateCounter(){
		if(typeof that == "object"){
			var number = thelimit - that.value.length;
			jQuery(counter_el).text("还可以输入" + number +" 个字符");
		}
	};
	
	this.keydown (function(e){ 
		if(e.which == 17) isCtrl = true;
		var ctrl_a = (e.which == 65 && isCtrl == true) ? true : false; // detect and allow CTRL + A selects all.
		var ctrl_v = (e.which == 86 && isCtrl == true) ? true : false; // detect and allow CTRL + V paste.
		// 8 is 'backspace' and 46 is 'delete'
		if( this.value.length >= thelimit && e.which != '8' && e.which != '46' && ctrl_a == false && ctrl_v == false)
			e.preventDefault();
	})
	.keyup (function(e){
		updateCounter();
		if(e.which == 17)
			isCtrl=false;

		if( this.value.length >= thelimit && toggleTrim ){
			if(toggleCharDel){
				// first, trim the text a bit so the char trimming won't take forever
				// Also check if there are more than 10 extra chars, then trim. just in case.
				if ( (this.value.length - thelimit) > 10 )
					that.value = that.value.substr(0,thelimit+100);
				var init = setInterval
					( 
						function(){ 
							if( that.value.length <= thelimit ){
								init = clearInterval(init); updateCounter() 
							}
							else{
								// deleting extra chars (one by one)
								that.value = that.value.substring(0,that.value.length-1); jQuery(counter_el).text('Trimming... '+(thelimit - that.value.length));
							}
						} ,charDelSpeed 
					);
			}
			else this.value = that.value.substr(0,thelimit);
		}
	});
};

})(jQuery);