<table width="650" align="center" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td height="50" align="center" class="matter_title">事项详情</td>
    </tr>
</table>
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
        <td class="matter_td"><?php echo $model->content; ?></td>
    </tr>
	<?php if(!empty($model->desc)):?>
	<tr>
      <td align="right" class="matter_td"><label>办结备注：</label><br /></td>
        <td class="matter_td"><?php echo $model->desc; ?></td>
    </tr>
	<?php endif;?>
    <?php if ($model->complete_user_id): ?>
        <tr>
          <td align="right" class="matter_td"><label>办结时间：</label></td>
            <td class="matter_td"><?php echo $model->complete_time; ?></td>
        </tr>
        <tr>
          <td align="right" class="matter_td"><label>办结人：</label></td>
            <td class="matter_td"><?php echo $model->complete_user->username; ?></td>
        </tr>
    <?php elseif ($model->duty_user_id == Yii::app()->adminuser->user_id): ?>
		<tr>
          <td align="right" class="matter_td"><label>办结备注：</label></td>
            <td class="matter_td"><textarea cols="30" rows="5" name="desc" id="matter_desc"></textarea></td>
        </tr>
        <tr class="matter_td">
            <td colspan="2" align="center"><input type="button" name="button" id="button_matt" matter_id="<?php echo $model->id; ?>" value="确认办结" /></td>
        </tr>
    <?php endif; ?>

    <?php
    if ($model->complete_user_id == 0 && $model->add_user_id == Yii::app()->adminuser->user_id && strtotime($model->handle_date) < strtotime(date('Y-m-d',time()))):
        $duty_user_data = $this->getDutyUser();
        $duty_department_data = $this->getDutyDepartment();
        ?>
        <tr>
          <td align="right" class="matter_td"><label>选择办结科室：</label></td>
            <td class="matter_td"><select class="input_text" name="MattersModel[duty_department]" id="duty_department">
                    <?php foreach ($duty_department_data as $k => $v): ?>
                        <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
                    <?php endforeach; ?>
                </select></td>
        </tr>
        <tr>
          <td align="right" class="matter_td"><label>选择办结人：</label></td>
            <td class="matter_td"><select class="input_text" name="MattersModel[duty_user_id]" id="duty_user_id">
              <?php foreach ($duty_user_data as $k => $v): ?>
              <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
              <?php endforeach; ?>
            </select></td>
        </tr>
        <tr>
          <td align="right" class="matter_td"><label>截止日期：</label></td>
            <td class="matter_td"><input class="input_text" readonly="readonly" onClick="WdatePicker({minDate: '<?php echo date('Y-m-d', time()); ?>'});" name="MattersModel[handle_date]" id="handle_date" type="text" /></td>
        </tr>
        <tr>
            <td colspan="2" align="center" class="matter_td">
            <input type="button" name="button" id="button_duty" matter_id="<?php echo $model->id; ?>" value="确认转办" />
            &nbsp;&nbsp;
            <input type="button" name="button" class="button_return" value="返回" /></td>
        </tr>
    <?php endif;if ($model->add_user_id == Yii::app()->adminuser->user_id): ?>
        <tr>
            <td colspan="2" align="center" class="matter_td">
			<input type="button" name="button" id="button_upd" matter_id="<?php echo $model->id; ?>" value="修改" />
              &nbsp;&nbsp;
              <input type="button" name="button" id="button_del" matter_id="<?php echo $model->id; ?>" value="删除" />
              &nbsp;&nbsp;
            <input type="button" name="button" class="button_return" value="返回" /></td>
        </tr>
        <?php else:?>
        <tr>
            <td colspan="2" align="center" class="matter_td">
              <input type="button" name="button" class="button_return" value="返回" /></td>
        </tr>
    <?php endif; ?>
</table>
<script>
    $(function() {
		$('.button_return').click(function(){
			history.back();
			return true;
		});
        $('#button_matt').click(function() {
            if (confirm('确定办结么？')) {
                var matter_id = $(this).attr('matter_id');
				var matter_desc = $('#matter_desc').val();
                $.getJSON('<?php echo $this->createUrl('banjie'); ?>', {id: matter_id,desc:matter_desc}, function(data) {
                    if (data.status == 'success') {
                        alert('成功结办！');
						location.href='<?php echo $this->createUrl('matter/index',array('is_my_duty'=>1,'is_complete'=>1,'is_name'=>6));?>';
                        //window.location.reload();
                        return true;
                    } else {
                        alert(data.msg);
                    }
                });
            }
        });
        $('#button_del').click(function() {
            if (confirm('确定删除么？')) {
                var matter_id = $(this).attr('matter_id');
                $.getJSON('<?php echo $this->createUrl('del'); ?>', {id: matter_id}, function(data) {
                    if (data.status == 'success') {
                        alert('成功删除！');
                        //window.close();
						location.href='<?php echo $this->createUrl('matter/index',array('is_complete'=>0,'is_name'=>0));?>';
                        return true;
                    } else {
                        alert(data.msg);
                    }
                });
            }
        });
		$('#button_upd').click(function(){
			var matter_id = $(this).attr('matter_id');
			location.href='<?php echo $this->createUrl('upd'); ?>/id/'+matter_id;
		});
        $('#button_duty').click(function() {
//            if (confirm('确定转办么？')) {
            var matter_id = $(this).attr('matter_id');
            var duty_user_id = $('#duty_user_id').val();
            var duty_department = $('#duty_department').val();
            var handle_date = $('#handle_date').val();
            if (!handle_date) {
                alert('请选择转办时间！');
                return false;
            }
            $.getJSON('<?php echo $this->createUrl('zhuanban'); ?>', {id: matter_id, duty_user_id: duty_user_id, handle_date: handle_date, duty_department: duty_department}, function(data) {
                if (data.status == 'success') {
                    alert('成功转办！');
					location.href='<?php echo $this->createUrl('matter/index',array('is_my_add'=>1,'is_complete'=>0,'is_name'=>8,'is_time_t'=>2));?>';
                    //window.location.reload();
                    return true;
                } else {
                    alert(data.msg);
                }
            });
//            }
        });
    });
</script>
