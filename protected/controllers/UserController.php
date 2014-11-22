<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class UserController extends AdminController
{
    public function actionIndex(){
        $model = AdminUserModel::model()->findByPk(Yii::app()->adminuser->user_id);
        
        if(isset($_POST['AdminUserModel']))
        {
                $post = $_POST['AdminUserModel'];
                if(isset($_POST['upd_pass']) && $_POST['upd_pass'] == 1){
                    if(empty($post['password'])){
                        $model->addError('password', '修改密码时密码不能为空！');
                    }
                    $post['password'] = md5(trim($post['password']));
                }else{
                    unset($post['password']);
                }
                $model->attributes=$post;
                if(!$model->hasErrors() && $model->save())
                        $this->redirect(array('index','is_succ'=>1));
        }
        $model->password = '';
        $render['model'] = $model;
        $this->render('upd',$render);
    }
    
    public function actionAdd(){
        if(Yii::app()->adminuser->role_id != 1){
            exit('你不是管理员，没有操作该项的权限！');
        }
        $model = new AdminUserModel();
        $model->scenario = 'add';
        if(isset($_POST['AdminUserModel']))
        {
                $model->attributes=$_POST['AdminUserModel'];
                if($model->save())
                        $this->redirect(array('list'));
        }
        $render['model'] = $model;
        $this->render('add',$render);
    }
    
    public function actionUpd($id){
        if(Yii::app()->adminuser->role_id != 1){
            exit('你不是管理员，没有操作该项的权限！');
        }
        $model = AdminUserModel::model()->findByPk($id);
        if(isset($_POST['AdminUserModel']))
        {
                $post = $_POST['AdminUserModel'];
                if(isset($_POST['upd_pass']) && $_POST['upd_pass'] == 1){
                    if(empty($post['password'])){
                        $model->addError('password', '修改密码时密码不能为空！');
                    }
                    $post['password'] = md5(trim($post['password']));
                }else{
                    unset($post['password']);
                }
                $model->attributes=$post;
                if(!$model->hasErrors() && $model->save())
                        $this->redirect(array('upd','is_succ'=>1,'id'=>$id));
        }
        $model->password = '';
        $render['model'] = $model;
        $this->render('upd',$render);
    }
	
	public function actionDel($id){
		AdminUserModel::model()->updateByPk($id,array('is_deleted'=>1));
		echo json_encode(array('status'=>'success'));
	}
    
    public function actionList(){
        if(Yii::app()->adminuser->role_id != 1){
            exit('你不是管理员，没有操作该项的权限！');
        }
        $pagesize = 15;
        $criteria = new CDbCriteria();
        $criteria->select = '*';
        $criteria->order = 'id desc';
		$criteria->addCondition('is_deleted = 0');
        $criteria->limit = $pagesize;
        $count = AdminUserModel::model()->count($criteria);
        $pages=new CPagination($count);
        $pages->pageSize = $pagesize;
        $pages->applyLimit($criteria);

        $rederData['pages'] = $pages;
        $rederData['list'] = AdminUserModel::model()->findAll($criteria);
        $this->render('list',$rederData);
    }
}

