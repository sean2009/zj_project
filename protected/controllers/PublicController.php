<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class PublicController extends CController{
    /**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	echo '<pre>';print_r($error);//$this->render('error', $error);
	    }
	}
	
	public function actionMsg(){
		MessageService::model()->sendMessage();
		echo 'success';
	}
	
	public function actionMsgList(){
		$sql = 'select * from bj_send_log order by id desc limit 30';
		$list = Yii::app()->db->createCommand($sql)->queryAll();
		print_r($list);
		exit;
	}

	public function actionUpload($sessionid = 0,$immediate = 0){
		header('Content-Type: text/html; charset=UTF-8');
		$yuming = 'http://localhost/qiandaohu/';//'http://zend.com/';
		$inputname='filedata';//表单文件域name
		$attachdir='upload';//上传文件保存路径，结尾不要带/
		$dirtype=1;//1:按天存入目录 2:按月存入目录 3:按扩展名存目录  建议使用按天存
		$maxattachsize=2097152;//最大上传大小，默认是2M
		$upext='txt,rar,zip,jpg,jpeg,gif,png,swf,wmv,avi,wma,mp3,mid';//上传扩展名
		$msgtype=2;//返回上传参数的格式：1，只返回url，2，返回参数数组
		$immediate=isset($immediate)?$immediate:1;//立即上传模式，仅为演示用
		
		if(isset($_SERVER['HTTP_CONTENT_DISPOSITION']))//HTML5上传
		{
			if(preg_match('/attachment;\s+name="(.+?)";\s+filename="(.+?)"/i',$_SERVER['HTTP_CONTENT_DISPOSITION'],$info))
			{
				$temp_name=ini_get("upload_tmp_dir").'\\'.date("YmdHis").mt_rand(1000,9999).'.tmp';
				file_put_contents($temp_name,file_get_contents("php://input"));
				$size=filesize($temp_name);
				$_FILES[$info[1]]=array('name'=>$info[2],'tmp_name'=>$temp_name,'size'=>$size,'type'=>'','error'=>0);
			}
		}
		
		$err = "";
		$msg = "''";
		
		$upfile=@$_FILES[$inputname];
		if(!isset($upfile))$err='文件域的name错误';
		elseif(!empty($upfile['error']))
		{
			switch($upfile['error'])
			{
				case '1':
					$err = '文件大小超过了php.ini定义的upload_max_filesize值';
					break;
				case '2':
					$err = '文件大小超过了HTML定义的MAX_FILE_SIZE值';
					break;
				case '3':
					$err = '文件上传不完全';
					break;
				case '4':
					$err = '无文件上传';
					break;
				case '6':
					$err = '缺少临时文件夹';
					break;
				case '7':
					$err = '写文件失败';
					break;
				case '8':
					$err = '上传被其它扩展中断';
					break;
				case '999':
				default:
					$err = '无有效错误代码';
			}
		}
		elseif(empty($upfile['tmp_name']) || $upfile['tmp_name'] == 'none')$err = '无文件上传';
		else
		{
			$temppath=$upfile['tmp_name'];
			$fileinfo=pathinfo($upfile['name']);
			$extension=$fileinfo['extension'];
			if(preg_match('/'.str_replace(',','|',$upext).'/i',$extension))
			{
				$bytes=filesize($temppath);
				if($bytes > $maxattachsize)$err='请不要上传大小超过'.$this->formatBytes($maxattachsize).'的文件';
				else
				{
					switch($dirtype)
					{
						case 1: $attach_subdir = 'day_'.date('ymd'); break;
						case 2: $attach_subdir = 'month_'.date('ym'); break;
						case 3: $attach_subdir = 'ext_'.$extension; break;
					}
					$attach_subdir = date('Ym');
					$attach_dir = $attachdir.'/'.$attach_subdir;
					if(!is_dir($attach_dir))
					{
						@mkdir($attach_dir, 0777);
					}
					$attach_subdir = date('d');
					$attach_dir = $attach_dir.'/'.$attach_subdir;
					if(!is_dir($attach_dir))
					{
						@mkdir($attach_dir, 0777);
					}
					PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
					$filename=date("YmdHis").mt_rand(1000,9999).'.'.$extension;
					$target = $attach_dir.'/'.$filename;
					
					rename($upfile['tmp_name'],$target);
					@chmod($target,0755);
					$target=$yuming.$this->jsonString($target);
					if($immediate=='1')$target='!'.$target;
					if($msgtype==1)$msg="'$target'";
					else $msg="{'url':'".$target."','localname':'".$this->jsonString($upfile['name'])."','id':'".$sessionid."'}";//id参数固定不变，仅供演示，实际项目中可以是数据库ID
				}
			}
			else $err='上传文件扩展名必需为：'.$upext;
		
			@unlink($temppath);
		}
		echo "{'err':'".$this->jsonString($err)."','msg':".$msg."}";
		die;
	}
	
	public function jsonString($str)
	{
		return preg_replace("/([\\\\\/'])/",'\\\$1',$str);
	}
	public function formatBytes($bytes) {
		if($bytes >= 1073741824) {
			$bytes = round($bytes / 1073741824 * 100) / 100 . 'GB';
		} elseif($bytes >= 1048576) {
			$bytes = round($bytes / 1048576 * 100) / 100 . 'MB';
		} elseif($bytes >= 1024) {
			$bytes = round($bytes / 1024 * 100) / 100 . 'KB';
		} else {
			$bytes = $bytes . 'Bytes';
		}
		return $bytes;
	}
}
