<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/statics/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/statics/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/statics/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/statics/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/statics/css/form.css" />
<script>
var base_url = '<?php echo Yii::app()->baseUrl;?>';
</script>
<script src="<?php echo Yii::app()->baseUrl . '/statics/js/jquery.js'?>"></script>
<script src="<?php echo Yii::app()->baseUrl . '/statics/plugins/My97DatePicker/WdatePicker.js'?>"></script>
<script src="<?php echo Yii::app()->baseUrl . '/statics/plugins/kindeditor/kindeditor-min.js'?>"></script>
<script src="<?php echo Yii::app()->baseUrl . '/statics/plugins/kindeditor/lang/zh_CN.js'?>"></script>
<script src="<?php echo Yii::app()->baseUrl . '/statics/js/jquery.area.js'?>"></script>
<script>
KE.show({
    imageUploadJson : "<?php echo Yii::app()->baseUrl;?>/upload_json.php",
});
</script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl;?>/statics/plugins/kindeditor/themes/default/default.css" />
</head>
<body>
<div class="container" id="page">
	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
<ul id="yw2">
<?php if(!Yii::app()->adminuser->isGuest):?>
<li><a href="<?php echo $this->createUrl('/admin/site/logout');?>">退出</a></li>
<?php else:?>
<li><a href="<?php echo $this->createUrl('/admin/site/login');?>">登录</a></li>
<?php endif;?>
</ul>
	</div>
<script>
/*导航*/
var time1=null,time2=null;
$("#mainmenu").find("li>a").hover(function(){
	clearTimeout(time2);
	$(this).next().show();
},function(){
	var that=$(this);
	function hide1(){
		that.next().hide();
	}
	time1=setTimeout(function(){hide1();},100)
})

$("#mainmenu").find("li>dl").hover(function(){
	clearTimeout(time1);
	$(this).show();
},function(){
	var that=$(this);
	function hide2(){
		that.hide();
	}
	var time2=setTimeout(function(){hide2();},100)
})
</script>
	<!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
