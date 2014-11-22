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
</style>
<table width="100%" height="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="19%" height='50'>&nbsp;</td>
    <td width="81%"><a href="javascript:window.open('<?php echo $this->createUrl('matter/add');?>')">添加事项</a></td>
  </tr>
  <tr>
    <td valign="top">
    <a href="<?php echo $this->createUrl('matter/index',array('is_complete'=>0));?>" target="main"><strong>待办事项</strong></a><br />
    <a href="<?php echo $this->createUrl('matter/index',array('is_complete'=>0,'is_time_t'=>1));?>" target="main">临期预警</a><br />
    <a href="<?php echo $this->createUrl('matter/index',array('is_complete'=>0,'is_time_t'=>2));?>" target="main">超期预警</a><br /><br />
    
    <a href="<?php echo $this->createUrl('matter/index',array('is_complete'=>1));?>" target="main"><strong>已办事项</strong></a><br /><br />
    
    <strong>我的事项</strong><br />
    <a href="<?php echo $this->createUrl('matter/index',array('is_my_add'=>1));?>" target="main">我的发布</a><br />
    <a href="<?php echo $this->createUrl('matter/index',array('is_my_duty'=>1,'is_complete'=>0));?>" target="main">我的待办</a><br />
    <a href="<?php echo $this->createUrl('matter/index',array('is_my_duty'=>1,'is_complete'=>1));?>" target="main">我的已办</a><br /><br />
    
    <strong>用户管理</strong><br />
    <a href="<?php echo $this->createUrl('user/index');?>" target="main">编辑资料</a><br />
    <a href="<?php echo $this->createUrl('user/list');?>" target="main">用户列表</a><br />
    
    </td>
    <td valign="top"><iframe id="main" frameborder="0" scrolling="auto"  width="100%" height="100%"></iframe></td>
  </tr>
</table>
<?php $this->pageTitle=Yii::app()->name; ?>
