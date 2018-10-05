<?php

/**
 * This is the model class for table "user_jump_request".
 *
 * The followings are the available columns in table 'user_jump_request':
 * @property integer $id
 * @property integer $user_id
 * @property integer $jump_request_id
 * @property integer $is_jump
 */
class UserJumpRequest extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserJumpRequest the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_jump_request';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, jump_request_id, is_jump', 'required'),
			array('user_id, jump_request_id, is_jump', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, jump_request_id, is_jump', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'products_jump_requested' => array(self::HAS_MANY,'ProductUserJumpRequest','user_jump_request_id'),
			'user' => array(self::BELONGS_TO,'User','user_id'),
			'jump_request' => array(self::BELONGS_TO,'JumpRequest','jump_request_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'jump_request_id' => 'Jump Request',
			'is_jump' => 'Is Jump',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('jump_request_id',$this->jump_request_id);
		$criteria->compare('is_jump',$this->is_jump);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
