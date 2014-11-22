<?php

/**
 * This is the model class for table "{{admin_user}}".
 *
 * The followings are the available columns in table '{{admin_user}}':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property integer $role_id
 * @property string $other_power
 * @property integer $add_time
 * @property integer $last_login_time
 * @property integer $is_deleted
 * @property integer $upd_time
 */
class AdminUserModel extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AdminUserModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{user}}';
	}
	
	public function beforeSave() {
//                if($this->scenario !== 'update'){
//                    if(empty($this->password)){
//                        $this->addError('password', '密码不能为空');
//                    }
//                    $this->password = md5(trim($this->password));
//                }else{
//                    if(!empty($this->password)){
//			$this->password = md5(trim($this->password));
//                    }else{
//                        unset($this->password);
//                    }
//                }
		return parent::beforeSave();
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username,mobile, role_id, is_deleted', 'required'),
                        array('password','required','on'=>'add'),
                        array('password','valiPass','on'=>'add'),
			array('role_id', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>30),
			array('password', 'length', 'max'=>32),
			array('mobile,password, add_time, last_login_time, is_deleted, upd_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, role_id, mobile, add_time, last_login_time, is_deleted, upd_time', 'safe', 'on'=>'search'),
		);
	}
        
        public function valiPass(){
            if(!empty($this->password)){
                $this->password = md5($this->password);
            }
        }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '编号',
			'username' => '用户名',
			'password' => '密码',
                        'mobile' => '手机号码',
			'role_id' => '角色',
			'add_time' => '添加时间',
			'last_login_time' => '最后登录时间',
			'is_deleted' => '是否删除',
			'upd_time' => '修改时间',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('role_id',$this->role_id);
		$criteria->compare('add_time',$this->add_time);
		$criteria->compare('last_login_time',$this->last_login_time);
		$criteria->compare('is_deleted',$this->is_deleted);
		$criteria->compare('upd_time',$this->upd_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}