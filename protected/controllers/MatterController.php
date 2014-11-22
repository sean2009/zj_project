<?php

class MatterController extends AdminController
{
	public $layout='//layouts/main';
	/*
         * 责任科室
         */
        protected function getDutyDepartment(){
            $return = array('综合处','合作处','联络处','区域处','对口处','人教处','机关党委','浙商服务中心');
            return $this->setDurpDownListData($return);
        }
        /*
         * 事项类别
         */
        protected function getType(){
            $return = array('上级机关来文来电交办事项','有关单位来文来电商办事项','省领导批示事项',
                '办领导批示事项','办重要文件决定事项','办重要会议决定事项','人大代表建议、政协委员提案办理事项','其他');
            return $this->setDurpDownListData($return);
        }
        
        protected function setDurpDownListData($data) {
            $new = array();
			$new[''] = '---------------请选择---------------';
            foreach($data as $v){
                $new[$v] = $v;
            }
            return $new;
        }
        /*
         * 可办结人
         */
        protected function getDutyUser() {
            $list = Yii::app()->db->createCommand()->select('id,username,mobile')->from('{{user}}')->where('is_deleted = 0 and role_id = 0')->queryAll();
            $return = array();
			$return[''] = '---------------请选择---------------';
            foreach($list as $v){
                $return[$v['id']] = $v['username'].' '.$v['mobile'];
            }
            return $return;
        }
        
        protected function getMenuTitle($is_name) {
            $data = array('待办事项','临期预警','超期预警','已办事项','我的发布','我的待办','我的已办','我的发布--未办结[全部]','我的发布--未办结[可转办]','我的发布-已办结',);
            return $data[$is_name];
        }

        /**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
            $pagesize = 15;
            $rederData['is_complete'] = $is_complete = isset($_GET['is_complete']) ? $_GET['is_complete'] : NULL;
            $is_time_t = isset($_GET['is_time_t']) ? $_GET['is_time_t'] : NULL;
            $rederData['is_my_add'] = $is_my_add = isset($_GET['is_my_add']) ? $_GET['is_my_add'] : NULL;
            $is_my_duty = isset($_GET['is_my_duty']) ? $_GET['is_my_duty'] : NULL;
            $is_name = isset($_GET['is_name']) ? $_GET['is_name'] : NULL;
            $rederData['menu_title'] = $this->getMenuTitle($is_name);
            $criteria = new CDbCriteria();
            if($is_complete != NULL){
                if($is_complete == 0){
                    //待办
                    $criteria->addCondition('complete_user_id = 0');
                    $criteria->order = 'add_time desc,id desc';
                }else{
                    //已办
                    $criteria->addCondition('complete_user_id != 0');
                    $criteria->order = 'complete_time desc,id desc';
                }
            }
            if($is_time_t != NULL){
                if($is_time_t == 1){
                    $criteria->addCondition('date(handle_date) between :time_b and :time_a');
                    $criteria->params[':time_a']=date('Y-m-d',  strtotime('+3 days')); 
                    $criteria->params[':time_b']=date('Y-m-d',time()); 
                }
                if($is_time_t == 2){
                    $criteria->addCondition('date(handle_date) < :handle_date');
                    $criteria->params[':handle_date'] = date('Y-m-d',time()); 
                }
            }
            if($is_my_add != NULL){
                $criteria->compare('add_user_id', Yii::app()->adminuser->user_id);
				if(empty($criteria->order)){
					$criteria->order = 'add_time desc,id desc';
				}
				
            }
            if($is_my_duty != NULL){
                $criteria->compare('duty_user_id', Yii::app()->adminuser->user_id);
            }
            $criteria->select = 'id,title,type,duty_user_id,add_user_id,handle_date,add_time,complete_time';
            
            $criteria->limit = $pagesize;
            $count = MattersModel::model()->count($criteria);
            $pages=new CPagination($count);
            $pages->pageSize = $pagesize;
            $pages->applyLimit($criteria);
            
            $rederData['pages'] = $pages;
            $rederData['list'] = MattersModel::model()->findAll($criteria);
			
	    $this->render('index',$rederData);
	}
	
	public function actionImport(){
	
		if(!empty($_POST)){
			$start_time = trim($_POST['start_time']);
			$end_time = trim($_POST['end_time']);
			/*$criteria = new CDbCriteria();
			$criteria->addCondition('date(t.add_time) between :time_a and :time_b');
			$criteria->params[':time_a']= $start_time;
			$criteria->params[':time_b']= $end_time;
			$criteria->order = 't.add_time desc,t.id desc';
			$criteria->select = 'u.username,t.*';
			$criteria->join = 'left join bj_user u on u.id = t.duty_user_id';
			$list = MattersModel::model()->findAll($criteria);*/
			$sql = 'select t.id,t.add_time,t.title,t.duty_department,t.type,t.handle_date,t.complete_time,t.content,u.username,t.complete_user_id from bj_matters t left join bj_user u on u.id = t.duty_user_id where date(t.add_time) between date(:start_time) and date(:end_time)';
			$params[':start_time'] = $start_time;
			$params[':end_time'] = $end_time;
			$list = Yii::app()->db->createCommand($sql)->queryAll(true,$params);
			if(empty($list)){
				die('no result!');
			}
			$result = "序号,创建时间,事项标题,事项类别,责任处室,责任人,办结时限,办结时间,事项依据,是/否已办结\n";
			foreach ($list as $v)
			{
				$content = strip_tags($v['content']);
				$result .= "\t$v[id],\t$v[add_time],\t$v[title],$v[type],$v[duty_department],$v[username],\t$v[handle_date],\t$v[complete_time],$content";
				if(!empty($v['complete_user_id'])){
					$result .=',是';
				}else
				{
					$result .=',否';
				}
				$result .="\n";
			}
			$filename = $start_time .' - '.$end_time;
			CsvService::model()->import($filename,$result);
		}
		$this->render('import');
	}
        
        public function actionAdd(){
			$this->layout = '//layouts/main_add_view';
            $model = new MattersModel();
            if(isset($_POST['MattersModel']))
            {
                    $model->attributes=$_POST['MattersModel'];
                    if($model->save()){
						//转办后给前责任人发消息
						$matter_id = Yii::app()->db->getLastInsertID();
						if($_POST['MattersModel']['handle_date'] == date('Y-m-d',time())){
							MessageService::model()->sendBanliMessage($matter_id,$_POST['MattersModel']['duty_user_id'],$_POST['MattersModel']['title']);
						}
						$this->redirect(array('matter/index','is_my_add'=>1,'is_name'=>4));
						Yii:app()->end();
						//$this->redirect(array('view','id'=>$model->id));
					}
                            
            }
            $render['model'] = $model;
            $render['arr_type'] = $this->getType();
            $render['arr_duty_department'] = $this->getDutyDepartment();
            $render['arr_duty_user'] = $this->getDutyUser();
            $this->render('add',$render);
        }
        
        public function actionView($id){
			$this->layout = '//layouts/main_add_view';
            $model = MattersModel::model()->findByPk($id);
            if(isset($_POST['MattersModel']))
            {
                    $model->attributes=$_POST['MattersModel'];
                    if($model->save())
                            $this->redirect(array('view','id'=>$model->id));
            }
            $render['model'] = $model;
            $render['arr_duty_user'] = $this->getDutyUser();
            $this->render('view',$render);
        }
		
		public function actionUpd($id){
			$this->layout = '//layouts/main_add_view';
            $model = MattersModel::model()->findByPk($id);
            if(isset($_POST['MattersModel']))
            {
                    $model->attributes=$_POST['MattersModel'];
                    if($model->save())
                            $this->redirect(array('view','id'=>$model->id));
            }
            $render['model'] = $model;
            $render['arr_duty_user'] = $this->getDutyUser();
            $this->render('upd',$render);
        }
        
        public function actionBanjie($id,$desc = '') {
            $model = MattersModel::model()->findByPk($id);
            if($model->duty_user_id != Yii::app()->adminuser->user_id){
                echo json_encode(array('status'=>'error','msg'=>'你不是该事项的办理人。'));
                exit;
            }
            $model->complete_user_id = Yii::app()->adminuser->user_id;
			$model->complete_time = new CDbExpression('NOW()');
			$model->desc = $desc;
            $model->save();
            echo json_encode(array('status'=>'success','msg'=>''));
                exit;
        }
        
        public function actionDel($id) {
            $model = MattersModel::model()->findByPk($id);
            if($model->add_user_id != Yii::app()->adminuser->user_id){
                echo json_encode(array('status'=>'error','msg'=>'你不是该事项的发布人，不能删除本事项。'));
                exit;
            }
            MattersModel::model()->deleteByPk($id);
            echo json_encode(array('status'=>'success','msg'=>''));
            exit;
        }
        
        public function actionZhuanban($id,$duty_user_id,$handle_date,$duty_department) {
            $model = MattersModel::model()->findByPk($id);
            if($model->add_user_id != Yii::app()->adminuser->user_id){
                echo json_encode(array('status'=>'error','msg'=>'你不是该事项的发布人，不能转办本事项。'));
                exit;
            }
			$qian_duty_user_id = $model->duty_user_id;
            $model->duty_user_id = $duty_user_id;
            $model->handle_date = $handle_date;
            $model->duty_department = $duty_department;
            $model->save();
			//转办后给前责任人发消息
			MessageService::model()->sendZhuangMessage($id,$qian_duty_user_id);
			if($handle_date == date('Y-m-d',time())){
				MessageService::model()->sendBanliMessage($matter_id,$duty_user_id,$model->title);
			}
            echo json_encode(array('status'=>'success','msg'=>''));
                exit;
        }
		
		public function actionZhuanfa($id){
			$this->layout = '//layouts/main_add_view';
            $model = MattersModel::model()->findByPk($id);
            if(isset($_POST['MattersModel']))
            {
					$model = new MattersModel();
                    $model->attributes=$_POST['MattersModel'];
                    if($model->save()){
						//转办后给前责任人发消息
						$matter_id = Yii::app()->db->getLastInsertID();
						if($_POST['MattersModel']['handle_date'] == date('Y-m-d',time())){
							MessageService::model()->sendBanliMessage($matter_id,$_POST['MattersModel']['duty_user_id'],$_POST['MattersModel']['title']);
						}
						$this->redirect(array('matter/index','is_my_add'=>1,'is_name'=>4));
						Yii:app()->end();
					}
            }
            $render['model'] = $model;
			$render['arr_type'] = $this->getType();
            $render['arr_duty_department'] = $this->getDutyDepartment();
            $render['arr_duty_user'] = $this->getDutyUser();
            $this->render('zhuanfa',$render);
		}
}