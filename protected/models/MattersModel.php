<?php

/**
 * This is the model class for table "{{matters}}".
 *
 * The followings are the available columns in table '{{matters}}':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $type
 * @property integer $duty_user_id
 * @property string $duty_department
 * @property integer $add_user_id
 * @property string $handle_date
 * @property string $complete_time
 * @property integer $complete_user_id
 * @property string $add_time
 */
class MattersModel extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MattersModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{matters}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('duty_user_id, add_user_id, complete_user_id', 'numerical', 'integerOnly'=>true),
                        array('title,duty_user_id,duty_department,type,handle_date', 'required'),
			array('title', 'length', 'max'=>200),
			array('type, duty_department', 'length', 'max'=>50),
			array('content, handle_date, complete_time, add_time, desc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, content, type, duty_user_id, duty_department, add_user_id, handle_date, complete_time, complete_user_id, add_time', 'safe', 'on'=>'search'),
		);
	}
        
        public function beforeSave() {
		if ($this->isNewRecord){
			$this->add_time = new CDbExpression('NOW()');
            $this->add_user_id = Yii::app()->adminuser->user_id;
			$this->complete_user_id = 0;
		}else{
			$this->complete_time = new CDbExpression('NOW()');
            $this->complete_user_id = Yii::app()->adminuser->user_id;
        }
		return parent::beforeSave();
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'duty_user'=>array(self::BELONGS_TO, 'AdminUserModel', 'duty_user_id'),
                    'add_user'=>array(self::BELONGS_TO, 'AdminUserModel', 'add_user_id'),
                    'complete_user'=>array(self::BELONGS_TO, 'AdminUserModel', 'complete_user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => '事项标题',
			'content' => '事项依据',
			'type' => '事项类别',
			'duty_user_id' => '责任人',
			'duty_department' => '责任科室',
			'add_user_id' => 'Add User',
			'handle_date' => '办结时间',
			'complete_time' => 'Complete Time',
			'complete_user_id' => 'Complete User',
			'add_time' => 'Add Time',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('duty_user_id',$this->duty_user_id);
		$criteria->compare('duty_department',$this->duty_department,true);
		$criteria->compare('add_user_id',$this->add_user_id);
		$criteria->compare('handle_date',$this->handle_date,true);
		$criteria->compare('complete_time',$this->complete_time,true);
		$criteria->compare('complete_user_id',$this->complete_user_id);
		$criteria->compare('add_time',$this->add_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}