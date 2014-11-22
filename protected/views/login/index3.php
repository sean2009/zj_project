<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
<?php echo Yii::app()->name;?>
</title>
<style type="text/css">
.b1,.b2,.b3,.b4,.b1b,.b2b,.b3b,.b4b,.b{display:block;overflow:hidden;}
.b1,.b2,.b3,.b1b,.b2b,.b3b{height:2px;}
.b2,.b3,.b4,.b2b,.b3b,.b4b,.b{border-left:2px solid #75bafb;border-right:2px solid #75bafb;}
.b1,.b1b{margin:0 5px;background:#75bafb;}
.b2,.b2b{margin:0 3px;border-width:2px;}
.b3,.b3b{margin:0 2px;}
.b4,.b4b{height:2px;margin:0 1px;}
.d1{background:#effafe;}
.k {height:280px;width:570px;}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url(<?php echo Yii::app()->baseUrl?>/images/login_bg_2.jpg);
	background-size:100% 100%;
}
.input {
	border: 1px solid; border-color: #75bafb #75bafb #75bafb #75bafb;
	background: #effafe;	
}
.login_right_title {
	font-family: "方正姚体";
	font-size: 24px;
	color: #0E5AAF;
	font-weight: bold;
	line-height: 40px;
}
.login_right_title2 {
	font-family: "方正姚体";
	font-size: 13px;
	color: #0E5AAF;
	font-weight: bold;
	line-height: 20px;
}
</style>
</head>
<body>
<table border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td height="100">&nbsp;</td>
</tr>
<tr>
<td>
<div>
<b class="b1"></b><b class="b2 d1"></b><b class="b3 d1"></b><b class="b4 d1"></b>
<div class="b d1 k">
<font style="font-size:14px;color:#75bafb; margin:0px 10px;">
<table width="95%" align="center">
<tr><td>
<table width="100%" align="center">
<tr><td align="left" valign="middle">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td width="73" height="72">
<img src="<?php echo Yii::app()->baseUrl?>/images/login_guohui_2.jpg" width="73" height="72" />
</td>
<td>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td class="login_right_title">浙江省人民政府经济合作交流办公室</td></tr>
<tr><td class="login_right_title2">Zhejiang province economic cooperation and exchange office</td></tr>
</table>

</td></tr>
</table>

<!--img src="<?php echo Yii::app()->baseUrl?>/images/login_guohui_2.jpg" width="73" height="72" />
<img src="<?php echo Yii::app()->baseUrl?>/images/login_log.png" width="440" height="58" /-->

</td></tr>
</table>
</td></tr>
<tr>
  <td>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>
    <td width="22%" height="30" align="right">&nbsp;</td>
    <td width="49%">&nbsp;</td>
    <td width="29%" rowspan="4"><input type="image" src="<?php echo Yii::app()->baseUrl?>/images/login_btn_2.jpg"></td>
  </tr>
  <tr>
    <td height="45" align="right"><strong>用户名</strong>&nbsp;&nbsp;</td>
    <td>
	<?php echo $form->textField($model,'username',array('class'=>'input','size'=>"25")); ?></td>
    </tr>
  <tr>
    <td height="45" align="right"><strong>密&nbsp;&nbsp;码&nbsp;</strong>&nbsp;</td>
    <td><?php echo $form->passwordField($model,'password',array('class'=>'input','size'=>"25")); ?></td>
    </tr>
  <tr>
    <td height="25" align="right">&nbsp;
	<?php
  if($model->getErrors()):
  ?>
	<div id="tipsContent"><?php foreach($model->getErrors() as $val){echo $val[0].'<br>';};?></div>
	<?php endif;?>
	</td>
    <td>&nbsp;</td>
    </tr>
</table>
<?php $this->endWidget(); ?>

</td></tr>
</table>
</font>
</div>
<b class="b4b d1"></b><b class="b3b d1"></b><b class="b2b d1"></b><b class="b1b"></b>
</div>
</td>
</tr>
</table>
</body>
</html>
