<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class UserActiveForm extends CActiveForm{

    public function labelEx($model,$attribute,$htmlOptions=array())
    {
        $label=$model->getAttributeLabel($attribute);
//        $htmlOptions['required']=$model->isAttributeRequired($attribute);
//        $return =  CHtml::activeLabelEx($model,$attribute,$htmlOptions);
        return '<label>'.$label.'：</label>';
    }

    public function textField($model,$attribute,$htmlOptions=array()){
        $return = parent::textField($model,$attribute,$htmlOptions);
        return '<span class="inp_box">'.$return.'</span>';
    }

    public function passwordField($model, $attribute, $htmlOptions = array()){
        $return = parent::passwordField($model, $attribute, $htmlOptions);
        return '<span class="inp_box">'.$return.'</span>';
    }

    public function error($model,$attribute,$htmlOptions=array(),$enableAjaxValidation=true,$enableClientValidation=true){
//        $return = parent::error($model, $attribute, $htmlOptions);
        return EHtml::errorUser($model, $attribute);
    }
}
?>
