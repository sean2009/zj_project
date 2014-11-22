<?php
class MessageService extends BaseService{
	public static function model($className = __CLASS__) {
        return parent::model($className);
    }
	/**
	* 定期执行
	**/
	public function sendMessage(){
		$xingqi = date('w',time());
		if($xingqi == 0 || $xingqi == 6){
			return true;
		}
		$sql = 'select id,title,duty_user_id,add_user_id,handle_date from bj_matters where complete_user_id = 0';
		// and handle_date between :time_a and :time_b
		//$params[':time_a'] = date('Y-m-d',  time());
		//$params[':time_b'] = date('Y-m-d',  strtotime('+3 days'));
		$list = Yii::app()->db->createCommand($sql)->queryAll();
		foreach($list as $v){
			$workDayNum = $this->getWorkDayNum($v['handle_date']);
			if($workDayNum <= 3){
				$msg = '您有待办事项“'.$v['title'].'”,请及时处理！';
				$this->send($v['id'],$v['duty_user_id'],$msg);
			}
			if($workDayNum == 0){
				$msg = '您创建的事项“'.$v['title'].'”即将到期！';
				$this->send($v['id'],$v['add_user_id'],$msg);
			}
			if($workDayNum == -1){
				$msg = '您创建的事项“'.$v['title'].'”已经到期！';
				$this->send($v['id'],$v['add_user_id'],$msg);
			}
		}
	}
	//计算 当前时间和截止日期之间有多少工作日
	private function getWorkDayNum($handle_date){
		$start_time = strtotime(date('Y-m-d',time()));
		$end_time = strtotime($handle_date);
		$i = 0;
		$day_time = 3600*24;
		if($start_time < $end_time){
			for($start_time;$start_time <= $end_time;$start_time += $day_time){
				$xingq = date('w',$start_time);
				if($xingq == 0 || $xingq == 1){
					continue;
				}
				$i++;
			}
		}elseif($start_time > $end_time){
			for($start_time;$start_time >= $end_time;$start_time -= $day_time){
				$xingq = date('w',$start_time);
				if($xingq == 0 || $xingq == 1){
					continue;
				}
				$i--;
			}
		}
		return $i;
	}
	
	//马上执行--转办之后，马上给前办理人发短信提醒
	public function sendZhuangMessage($matter_id,$user_id,$title = ''){
		$msg = '您的事项“'.$title.'”已被创建人转办';
		$this->send($matter_id,$user_id,$msg);
	}
	
	//马上执行--发布事项的执行时间是当天，马上给办理人发短信提醒
	public function sendBanliMessage($matter_id,$user_id,$title = ''){
		$msg = '您有一个新的事项“'.$title.'”需要办理，请及时办理！';
		$this->send($matter_id,$user_id,$msg);
	}
	
	
	protected function send($matter_id,$user_id,$message){
		$mobile = $this->getUserMobile($user_id);
		$message .= '【工作督办系统】';
		$data = array(
			'matter_id'	=> $matter_id,
			'user_id'	=> $user_id,
			'mobile'	=> $mobile,
			'msg'		=> $message,
			'send_time'	=> new CDbExpression('NOW()'),
		);
		Yii::app()->db->createCommand()->insert('bj_send_log',$data);
		//return true;
		header("Content-Type: text/html; charset=utf-8");
		require_once('nusoap.php');
		//include_once('util.php');

		$url = 'http://218.108.28.246:9080/OpenMasService?WSDL';
		$extendCode = "0101"; //自定义扩展代码（模块）
		$ApplicationID = "oa"; //账号
		$Password = "oapass";		//密码
		$destinationAddresses = array($mobile);	//手机号码

		$paras = array(
			'destinationAddresses'	=>$destinationAddresses,
			'message'				=>$message,
			'extendCode'			=>$extendCode,
			'applicationId'			=>$ApplicationID,
			'password'				=>$Password);

		$client = null;
		$client = new nusoap_client($url,true);

		$client->soap_defencoding = 'utf-8';
		$client->decode_utf8 = false;
		$client->xml_encoding = 'utf-8';
		
		@$result = $client->call('SendMessage3', $paras);

		$err = $client->getError();
		
		if ($err) {
			//echo($err."\r\n");
			return false;
			//echo '<h2>连接webservice出错</h2><pre>' . $err . '</pre>';
		}
	}
	
	protected function getUserMobile($user_id){
		$sql = 'select mobile from bj_user where id = '.$user_id;
		$row = Yii::app()->db->createCommand($sql)->queryRow();
		return $row['mobile'];
	}
}
?>