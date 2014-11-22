<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl();?>/statics/plugins/xheditor/xheditor-1.1.14-zh-cn.min.js"></script>
<script>
$(function(){
        $('#MattersModel_content').xheditor({tools:'Cut,Copy,Paste,Pastetext,|,Blocktag,Fontface,FontSize,Bold,Italic,Underline,Strikethrough,FontColor,BackColor,Align,List,Outdent,Indent,Link,Unlink,Preview,Fullscreen'});
});
</script>
<style>
.matterTextArea{width:600px;}
</style>
<table width="650" align="center" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td height="50" align="center" class="matter_title">事项详情</td>
    </tr>
</table>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
<table width="650" align="center" cellpadding="0" cellspacing="0" id="matter_table">
    <tr>
      <td width="80" align="right" class="matter_td"><label>创&nbsp;建&nbsp;人：&nbsp;</label></td>
        <td width="539" class="matter_td"><?php echo $model->add_user->username; ?></td>
    </tr>
    <tr>
      <td align="right" class="matter_td"><label>创建时间：</label></td>
        <td class="matter_td"><?php echo $model->add_time; ?></td>
    </tr>
    <tr>
      <td align="right" class="matter_td"><label>事项标题：</label></td>
        <td class="matter_td"><?php echo $model->title; ?></td>
    </tr>

    <tr>
      <td align="right" class="matter_td"><label>事项类别：</label></td>
        <td class="matter_td"><?php echo $model->type; ?></td>
    </tr>
    <tr>
      <td align="right" class="matter_td"><label>责任处室：</label></td>
      <td class="matter_td"><?php echo $model->duty_department; ?></td>
    </tr>
    <tr>
      <td align="right" class="matter_td"><label>责&nbsp;任&nbsp;人：</label></td>
      <td class="matter_td"><?php echo $model->duty_user->username; ?></td>
    </tr>
    <tr>
      <td align="right" class="matter_td"><label>截至日期：</label></td>
      <td class="matter_td"><?php echo $model->handle_date; ?></td>
    </tr>
    <tr>
      <td align="right" class="matter_td"><label>事项依据：</label><br /></td>
        <td class="matter_td"><?php echo $form->textArea($model,'content',array('rows'=>16,'class'=>'matterTextArea')); ?></td>
    </tr>

    <?php if ($model->add_user_id == Yii::app()->adminuser->user_id): ?>
        <tr>
            <td colspan="2" align="center" class="matter_td">
              <input type="submit" name="button" id="button" value="提交" />
              &nbsp;&nbsp;
            <input type="button" name="button" class="button_return" value="取消" /></td>
        </tr>
    <?php endif; ?>
</table>
<?php $this->endWidget(); ?>
<script>
    $(function() {
		$('.button_return').click(function(){
			history.back();
			return true;
		});
    });
</script>
