<style>
    .errorSummary{color: #FF0000}
</style>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'admin-user-model-form',
    'enableAjaxValidation' => false,
        ));
?>
<div class="tablesModule">

    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tables">
        <tr class="order-bd">
            <td class="txt-right" width='200' aligt='right'></td>
            <td class="txt-left"><?php echo $form->errorSummary($model); ?></td>
        </tr>
        <tr class="order-bd">
            <td align="right"><?php echo $form->labelEx($model, 'username'); ?></td>
            <td class="txt-left">
                <?php 
                $readonly = $type == 'upd' ? true : false;
                echo $form->textField($model, 'username', array('maxlength' => 30,'readonly'=>$readonly)); ?>
            </td>
        </tr>
        <tr class="order-bd">
            <td align="right"><?php echo $form->labelEx($model, 'mobile'); ?></td>
            <td class="txt-left">
                <?php echo $form->textField($model, 'mobile', array('maxlength' => 11)); ?>（请输入真实手机号码！）
            </td>
        </tr>
        <tr class="order-bd">
            <td align="right"><?php echo $form->labelEx($model, 'password'); ?></td>
            <td class="txt-left">
                <?php echo $form->passwordField($model, 'password', array('maxlength' => 30)); ?>
                <?php if($readonly):?>
                （<input type="checkbox" name="upd_pass" value="1">选中修改密码）
                <?php endif;?>
            </td>
        </tr>
        
        <tr class="order-bd">
            <td class="txt-right"></td>
            <td class="txt-left">
                <span class="btn-link btn-link1">
                    <button type="submit" title="保 存" class="button" hidefocus="true">保 存</button>
                </span>

                <span class="btn-link btn-link3">
                    <button type="button" title="取 消" class="button" onClick="javascript:window.history.back();">取 消</button>
                </span>
            </td>
        </tr>
    </table>
</div>
<?php $this->endWidget(); ?>