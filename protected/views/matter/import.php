<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl();?>/statics/plugins/My97DatePicker/WdatePicker.js"></script>
<h2 class="title-h4 bordBtm1">导出事项</h2>
<script>
    $(function() {
        $('.btn-link4 button').click(function() {
            var url = $(this).attr('url');
            location.href=url;
            return true;
        });
		$('#end_time').click(function(){
			var start_time = $('#start_time').val();
			if(!start_time){
				alert('请先选择开始时间！');
				return false;
			}
			WdatePicker({minDate:$('#start_time').val()});
		});
		$('#submit_search').click(function(){
			var start_time = $('#start_time').val();
			if(!start_time){
				alert('请选择开始时间！');
				return false;
			}
			var end_time = $('#end_time').val();
			if(!end_time){
				alert('请选择结束时间！');
				return false;
			}
			return true;
		});
    });
</script>
<div class="controlWrap">
<div class="searchModule">
        <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'search-form',
	'enableAjaxValidation'=>false,
)); ?>
            导出选项（按照事项创建时间）：
			从
			<input type="text" readonly="readonly" name="start_time" id="start_time" onClick="WdatePicker();">
			到
            <input type="text" readonly="readonly" name="end_time" id="end_time">
            
            <span class="btn-link btn-link5">
                <button hidefocus="true" class="button" title="查询" type="submit" id="submit_search">查询</button>
            </span>
        <?php $this->endWidget(); ?>
    </div>
</div>
