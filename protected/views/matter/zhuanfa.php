<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl();?>/statics/plugins/xheditor/xheditor-1.1.14-zh-cn.min.js"></script>
<script>
$(function(){
        $('#MattersModel_content').xheditor({tools:'Cut,Copy,Paste,Pastetext,|,Blocktag,Fontface,FontSize,Bold,Italic,Underline,Strikethrough,FontColor,BackColor,Align,List,Outdent,Indent,Link,Unlink,Preview,Fullscreen'});
});
</script>
<style>
.matterTextArea{width:600px;}
</style>
<table width="750" border="0" align="center" cellspacing="0" cellpadding="0">
  <tr>
    <td height="40" align="center" class="matter_title">转发事项</td>
  </tr>
</table>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
<table width="800" align="center" cellpadding="0" cellspacing="0" bordercolor="red" id="matter_table">
  <tr>
    <td width="150" align="right" valign="middle" class="matter_td"><label>事项标题：</label></td>
    <td valign="middle" class="matter_td"><?php echo $form->textField($model,'title',array('class'=>'input_text','size'=>70)); ?> <?php echo EHtml::error($model,'title'); ?></td>
  </tr>
  
  <tr>
    <td align="right" valign="middle" class="matter_td"><label>事项类别：</label></td>
    <td valign="middle" class="matter_td"><?php echo $form->dropDownList($model,'type',$arr_type,array('class'=>'input_text'));?> <?php echo EHtml::error($model,'type'); ?></td>
  </tr>
  <tr>
    <td align="right" valign="middle" class="matter_td"><label>责任处室：</label></td>
    <td valign="middle" class="matter_td"><?php echo $form->dropDownList($model,'duty_department',$arr_duty_department,array('class'=>'input_text'));?> <?php echo EHtml::error($model,'duty_department'); ?></td>
  </tr>
  <tr>
    <td align="right" valign="middle" class="matter_td"><label>责&nbsp;任&nbsp;人：</label></td>
    <td valign="middle" class="matter_td"><?php echo $form->dropDownList($model,'duty_user_id',$arr_duty_user,array('class'=>'input_text'));?> <?php echo EHtml::error($model,'duty_user_id'); ?></td>
  </tr>
  <tr>
    <td align="right" valign="middle" class="matter_td"><label>截止日期：</label></td>
    <td valign="middle" class="matter_td"><?php echo $form->textField($model,'handle_date',array('class'=>'input_text','readonly'=>true,'onClick'=>'WdatePicker({minDate:"'.date('Y-m-d',time()).'"});')); ?> <?php echo EHtml::error($model,'handle_date'); ?></td>
  </tr>
  <tr>
    <td align="right" class="matter_td"><label>事项依据：</label></td>
    <td class="matter_td"><?php echo $form->textArea($model,'content',array('rows'=>16,'class'=>'matterTextArea')); ?></td>
  </tr>
  <tr>
    <td colspan="2" align="center" class="matter_td"><input type="submit" name="button" id="button" value="提交" />&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
</table>
<?php $this->endWidget(); ?>
