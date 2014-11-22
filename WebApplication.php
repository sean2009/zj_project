<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class WebApplication extends CWebApplication {

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            $module = $controller->getModule();
//            var_dump($module);
            $controllerId = strtolower($controller->id);
            if ($controllerId != 'login' && $controllerId != 'public') {
                if (Yii::app()->adminuser->getIsGuest()) {
                    Yii::app()->request->redirect(Yii::app()->createUrl('/login'));
                }
            }
            return true;
        } else
            return false;
    }

}
