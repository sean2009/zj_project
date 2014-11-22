<h2 class="title-h4 bordBtm1"><?php echo $menu_title ?></h2>
<?php if(isset($_GET['is_my_add']) && $_GET['is_my_add'] == 1):?>
<div class="controlWrap">
    <div class="controlModule">
        <span class="btn-link btn-link4">
            <button hidefocus="true" class="button" url="<?php echo $this->createUrl('index',array('is_my_add'=>1,'is_name'=>7,'is_complete'=>0));?>" type="button">&nbsp;&nbsp;未办结[全部]&nbsp;&nbsp;</button>
        </span>
        <span class="btn-link btn-link4">
            <button hidefocus="true" class="button" url="<?php echo $this->createUrl('index',array('is_my_add'=>1,'is_name'=>8,'is_complete'=>0,'is_time_t'=>2));?>" type="button">&nbsp;&nbsp;未办结[可转办]&nbsp;&nbsp;</button>
        </span>
        <span class="btn-link btn-link4">
            <button hidefocus="true" class="button" url="<?php echo $this->createUrl('index',array('is_my_add'=>1,'is_name'=>9,'is_complete'=>1));?>" type="button">已办结</button>
        </span>
    </div>
</div>
<?php endif;?>
<script>
    $(function() {
        $('.btn-link4 button').click(function() {
            var url = $(this).attr('url');
            location.href=url;
            return true;
        });
    });
</script>
<div class="tablesModule">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tables">
        <thead>
            <tr class="order-hd">
                <th width="5%">创建人</th>
                <th width="5%">办理人</th>
                <th width="20%">事项标题</th>
                <th width="3%">截止日期</th>
				<?php if($is_complete == 1):?>
				<th width="3%">办结日期</th>
				<?php else:?>
				<th width="3%">发布日期</th>
				<?php endif;?>
				<?php if($is_my_add == 1):?>
				<th width="3%">操作</th>
				<?php endif;?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list as $v): ?>
                <tr class="order-bd">
                    <td class="txt-center"><?php echo $v->add_user->username; ?></td>
                    <td class="txt-center"><?php echo $v->duty_user->username; ?></td>
                    <td class="txt-center"><a href="<?php echo $this->createUrl('view', array('id' => $v->id)); ?>"><?php echo $v->title; ?></a></td>
                    <td class="txt-center"><?php echo $v->handle_date; ?></td>
					<?php if($is_complete == 1):?>
					<td class="txt-center"><?php echo date('Y-m-d',strtotime($v->complete_time)); ?></td>
					<?php else:?>
					<td class="txt-center"><?php echo date('Y-m-d',strtotime($v->add_time)); ?></td>
					<?php endif;?>
					<?php if($is_my_add == 1):?>
					<td class="txt-center"><a href="<?php echo $this->createUrl('zhuanfa',array('id'=>$v->id)); ?>">转发</a></td>
					<?php endif;?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="ui-pagination2">
    <div class="pager clearfix"><?php
        $this->widget('CLinkPager', array(
            'pages' => $pages,
            'cssFile' => false,
            'header' => ''
        ))
        ?></div></div>
</div>
