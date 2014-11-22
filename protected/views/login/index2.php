<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta HTTP-EQUIV="pragma"   CONTENT="no-cache">
<meta HTTP-EQUIV="Cache-Control"   CONTENT="no-cache,   must-revalidate">
<meta HTTP-EQUIV="expires"   CONTENT="0">
<title>
<?php echo Yii::app()->name;?>
</title>
<script src="<?php echo Yii::app()->baseUrl . '/statics/js/jquery.js'?>"></script>
<link href="<?php echo Yii::app()->baseUrl . '/images/layout.css'?>" type="text/css" rel="stylesheet" />
<link href="<?php echo Yii::app()->baseUrl . '/images/blue.css'?>" type="text/css" rel="stylesheet" />
<script>
$(function(){
    $('.input_text').mouseover(function(){
        //onmouseover = "this.style.borderColor='#f1ca7e';this.style.backgroundColor='#ffffcc'"
        //$(this).style.borderColor = '#f1ca7e';
        $(this).css({'borderColor':'#f1ca7e','backgroundColor':'#ffffcc'});
    }).mouseout(function(){
        //onmouseout="this.style.borderColor='#333333';this.style.backgroundColor='#ffffff'"
        $(this).css({'borderColor':'#cccccc','backgroundColor':'#ffffff'});
    });
});
</script>
<style type="text/css">
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
</style></head>
<body style="height:100%;">
<div id="inter_body">
  <table cellpadding="0" cellspacing="0" style="width:100%;">
    <tr>
      <td align="center"><div id="world">
          <div id="left_line"></div>
          <div id="center_body">
            <div id="center">
              <div id="center_content">
                <div id="logo" style="overflow-x:hidden;">
				<!--p class="login_right_title">浙江省人民政府经济合作交流办公室</p-->
				<!--p class="login_right_title2">Zhejiang province economic cooperation and exchange office</p-->
                <img src="<?php echo Yii::app()->baseUrl . '/images/login_log.png'?>" border="0" />
                </div>
                <div id="form_body">
                  <h1>
                    登录
                  </h1>
                  <div id="left_input">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
                      <dl>
                        <dt>
                          用户名
                        </dt>
                        <dd>
						  <?php echo $form->textField($model,'username',array('class'=>'input_text')); ?>
                        </dd>
                      </dl>
                      <dl>
                        <dt>
                          密&nbsp;&nbsp;码
                        </dt>
                        <dd>
						  <?php echo $form->passwordField($model,'password',array('class'=>'input_text')); ?>
                        </dd>
                      </dl>
                      <dl>
                        <dd id="sub_input">
                          <button id="logButton" type="submit" class="sub_button">登 录</button></dd>
                      </dl>
<?php $this->endWidget(); ?>
				<?php
                  if($model->getErrors()):
                  ?>
                    <div id="tipsContent"><?php foreach($model->getErrors() as $val){echo $val[0].'<br>';};?></div>
					<?php endif;?>
                    <div id="right_btn" class="login_right_title">
                      <!--重点工作<br />
                      督办系统-->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div id="center_line"></div>
          </div>
          <div id="right_line"></div>
        </div></td>
    </tr>
  </table>
</div>
</body>
</html>
