<!doctype html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <title><?php echo Yii::app()->name;?></title>
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/images/common.css" />
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl . '/statics/js/jquery.js'?>"></script>
    </head>
    <body>
        <div class="head">
            <div class="head_bar" id="head"> <a href="javascript:void(0)" class="logo_boss">省经合办重点工作督办系统</a>
                <div class="head_login">
                    <span  style="color:#FF0000"><?php echo Yii::app()->adminuser->name;?></span>&nbsp;您好！<span class="exit">&nbsp;&nbsp;
                        [<a href="<?php echo $this->createUrl('/user/index'); ?>" title="修改我的资料" target="main_new_iframe">修改我的资料</a>]
                        [<a href="<?php echo $this->createUrl('/login/logout'); ?>" title="退出">退出</a>]
                    </span>&nbsp;&nbsp;</div>

                <ul class="head_menu" id="head_menu">
                    <!--<li class="home" id="head_menu_0" menuid="0"><a href="javascript:void(0)" title="首页"><b class="home_ico"></b>首页</a></li>-->
                </ul>
            </div>
        </div>
        <div class="wrap" id="wrap">
            <div class="aside">
                <div class="aside_wrap" id="aside_wrap">
                    <div class="scro">
						<ul class="aside_menu power_menu_two_" id="aside_menu">
                            <li>
                                <h3 class="nav_item"><a href="<?php echo $this->createUrl('matter/add');?>" target="main_new_iframe">发布事项</a></h3>
                            </li>
                        </ul>
						<ul class="aside_menu power_menu_two_" id="aside_menu">
                            <li>
                                <h3 class="nav_item"><a href="<?php echo $this->createUrl('matter/index',array('is_my_duty'=>1,'is_complete'=>0,'is_name'=>5));?>" target="main_new_iframe">我的待办</a></h3>
                                <ul class="show_menu" style="display: block;">

                                    <li id="showmenu_a1"><a href="<?php echo $this->createUrl('matter/index',array('is_my_add'=>1,'is_name'=>4));?>" target="main_new_iframe">我的发布</a></li>
                                    <li id="showmenu_a1"><a href="<?php echo $this->createUrl('matter/index',array('is_my_duty'=>1,'is_complete'=>1,'is_name'=>6));?>" target="main_new_iframe">我的已办</a></li>
                                </ul>	
                            </li>
                        </ul>
                        <ul class="aside_menu power_menu_two_admin" id="aside_menu">

                            <li>
                                <h3 class="nav_item"><a href="<?php echo $this->createUrl('matter/index',array('is_complete'=>0,'is_name'=>0));?>" target="main_new_iframe">待办事项</a></h3>
                                <ul class="show_menu" style="display: block;">
                                    <li id="showmenu_a2"><a href="<?php echo $this->createUrl('matter/index',array('is_complete'=>0,'is_time_t'=>1,'is_name'=>1));?>" target="main_new_iframe">临期事项</a></li>
                                    <li id="showmenu_a3"><a href="<?php echo $this->createUrl('matter/index',array('is_complete'=>0,'is_time_t'=>2,'is_name'=>2));?>" target="main_new_iframe">超期事项</a></li>
                                </ul>	
                            </li>
                        </ul>

                        <ul class="aside_menu power_menu_two_" id="aside_menu">
                            <li>
                                <h3 class="nav_item"><a href="<?php echo $this->createUrl('matter/index',array('is_complete'=>1,'is_name'=>3));?>" target="main_new_iframe">已办事项</a></h3>
                            </li>
                        </ul>
                        
                        <ul class="aside_menu power_menu_two_" id="aside_menu">
                            <li>
                                <h3 class="nav_item"><a href="javascript:void(0)">信息管理</a></h3>
                                <ul class="show_menu" style="display: block;">
                                    <li id="showmenu_a1"><a href="<?php echo $this->createUrl('user/index');?>" target="main_new_iframe">编辑我的资料</a></li>
                                    <?php if(Yii::app()->adminuser->role_id == 1):?>
                                    <li id="showmenu_a1"><a href="<?php echo $this->createUrl('user/list');?>" target="main_new_iframe">用户列表</a></li>
									<li id="showmenu_a1"><a href="<?php echo $this->createUrl('matter/import');?>" target="main_new_iframe">导出事项</a></li>
                                    <?php endif;?>
                                </ul>	
                            </li>
                        </ul>
                    </div>
                </div>
                <!--<div class="retune"><i class="arr_right"></i></div>-->
            </div>
            <div class="main">
                <div id="iframe_0" menuid="0" class="main_iframe"><iframe width="100%" src="<?php echo $this->createUrl('matter/index',array('is_complete'=>0,'is_name'=>0));?>" id="main_new_iframe" name="main_new_iframe"></iframe></div>
            </div>
        </div>
    </body>
</html>
<script type="text/javascript">
<!--

    function autoHeight() {
        var height = $(window).height() - $('#head').outerHeight();
        $('#wrap').height(height);
        $('.main_iframe iframe').height(height - 10);
    }
	
    autoHeight();
    $(window).resize(function() {
        autoHeight();

    });
-->
</script>