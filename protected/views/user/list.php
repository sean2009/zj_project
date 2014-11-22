<h2 class="title-h4 bordBtm1">用户管理</h2>
<div class="controlWrap">
    <div class="controlModule">
        <span class="btn-link btn-link4">
            <button hidefocus="true" class="button" url="<?php echo $this->createUrl('add');?>" type="button">添加新用户</button>
        </span>
    </div>
</div>
<script>
    $(function() {
        $('.btn-link4 button').click(function() {
            var url = $(this).attr('url');
            location.href=url;
            return true;
        });
		$('.button_del').click(function(){
			if(confirm('确定删除该用户吗？')){
				var uid = $(this).attr('uid');
				$.getJSON('<?php echo $this->createUrl('del');?>',{id:uid},function(data){
					if(data.status == 'success'){
						location.reload();
					}
				});
			}
		});
    });
</script>
<div class="tablesModule">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tables">
        <thead>
            <tr class="order-hd">
                <th>用户名</th>
                <th>手机号码</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list as $v): ?>
                <tr class="order-bd">
                    <td class="txt-center"><?php echo $v->username;?></td>
                    <td class="txt-center"><?php echo $v->mobile;?></td>
                    <td class="txt-center"><a href="<?php echo $this->createUrl('upd',array('id'=>$v->id));?>">修改</a>
					<a href="javascript:;" class="button_del" uid="<?php echo $v->id;?>">删除</a>
					</td>
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
