<?php
class EHtml{
    public static function error($model,$attribute){
        $error=$model->getError($attribute);
        if($error!='')
        {
                return '<em class="error_tip"><i>'.$error.'</i></em>';
        }
        else
                return '';
    }
    
    public static function errorUser($model,$attribute){
        $error=$model->getError($attribute);
        if($error!='')
        {
                return '<span class="adm_tips">'.$error.'</span>';
        }
        else
                return '';
    }
}
?>
