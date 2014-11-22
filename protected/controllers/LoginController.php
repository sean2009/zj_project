<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class LoginController extends AdminController {
    public $layout = false;
    /**
     * Displays the login page
     */
    public function actionIndex() {
        $model = new AdminLoginForm;
		//$list = Yii::app()->db->createCommand('select * from bj_user')->queryAll();
//var_dump($list);die;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['AdminLoginForm'])) {
            $model->attributes = $_POST['AdminLoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(array('/index')); //$this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('index3', array('model' => $model));
    }
	
	public function actionIndex2() {
        $model = new AdminLoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['AdminLoginForm'])) {
            $model->attributes = $_POST['AdminLoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(array('/index')); //$this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('index2', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        //$this->redirect(Yii::app()->homeUrl);
        $this->redirect(array('/login'));
    }

}
