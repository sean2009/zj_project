<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录-<?php echo Yii::app()->name;?></title>
<script src="<?php echo Yii::app()->baseUrl . '/statics/js/jquery.js'?>"></script>
<style type="text/css">
body {
	background-image: url(images/login_bg.jpg);
}
body,td,th {
	font-size: 12px;
}
.input_text{
	border:1px solid #333333;
}
</style>
<script>
$(function(){
    $('.input_text').mouseover(function(){
        //onmouseover = "this.style.borderColor='#f1ca7e';this.style.backgroundColor='#ffffcc'"
        //$(this).style.borderColor = '#f1ca7e';
        $(this).css({'borderColor':'#f1ca7e','backgroundColor':'#ffffcc'});
    }).mouseout(function(){
        //onmouseout="this.style.borderColor='#333333';this.style.backgroundColor='#ffffff'"
        $(this).css({'borderColor':'#333333','backgroundColor':'#ffffff'});
    });
});
</script>
</head>

<body>
<table width="100%" height="100%">
<tr>
<td align="center" valign="middle"><p>&nbsp;</p>
  <p>&nbsp;</p>
  <table width="200" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="37" align="left"><img src="images/login_left.jpg" width="37" height="390" /></td>
    <td width="444" valign="top"><table width="444" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><img src="images/login_06.jpg" width="444" height="37" /></td>
      </tr>
      <tr>
        <td height="57" bgcolor="#FFFFFF"> <strong style="color:red; margin-left:40px; font-size:16px"><?php echo Yii::app()->name;?></strong></td>
      </tr>
      <tr>
        <td height="270" valign="top" bgcolor="#FFFFFF"><table width="99%" style=" border: 1px solid #0e5aaf; margin-left:3px;" cellspacing="0" cellpadding="0">
          <tr>
            <td height="30" align="left" valign="baseline"><table width="100%"><tr><td width="98%" style=" margin:1px; background-color:#006699; height:28px; color:#FFF; font-variant:inherit">&nbsp;&nbsp;<strong>登录</strong></td></tr></table></td>
          </tr>
          <tr>
            <td height="230" valign="top">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
              <table width="98%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="8%">&nbsp;</td>
                  <td width="92%">&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>用户名：<br />
                  <?php echo $form->textField($model,'username',array('class'=>'input_text')); ?>
                  </td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><br />密&nbsp;&nbsp;码：<br />
                      <?php echo $form->passwordField($model,'password',array('class'=>'input_text')); ?>
                  </td>
                </tr>
                  <?php
                  if($model->getErrors()):
                  ?>
                  <tr><td>&nbsp;</td><td style="color:red;"><br /><?php foreach($model->getErrors() as $val){echo $val[0].'<br>';};?></td></tr>
                  <?php endif;?>
                <tr>
                  <td>&nbsp;</td>
                  <td><br /><input type="image" src="images/login_button.jpg" name="button" id="button" value="提交" /></td>
                </tr>
              </table>
<?php $this->endWidget(); ?>
            </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="26" style="background-image:url(images/login_10.jpg)">&nbsp;</td>
      </tr>
    </table></td>
    <td width="30" align="right"><img src="images/login_07.jpg" width="30" height="390" /></td>
  </tr>
  </table></td>
</tr>
</table>
</body>
</html>
