<!doctype html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <title></title>
<style type="text/css">
body,td,th {
	font-size: 12px;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
#matter_table{
	border:1px solid #ff0000;
    border-collapse:collapse;
} 
.matter_td {
	height:40px;
	border:1px solid #ff0000;
    padding-left:10px;
}
#matter_table td label{
	font-weight: bold;
}
.input_text{
	border:1px solid #333333;
}
select{width:250px;}
.error_tip{color:red}
.matter_title {
	font-size: 16px;
	font-weight: bold;
	color: #F00;
}
</style>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl . '/statics/js/jquery.js'?>"></script>
<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(); ?>/statics/plugins/My97DatePicker/WdatePicker.js"></script>
<body>
<?php echo $content; ?>
</body>
</html>
