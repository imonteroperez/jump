<?php

/**
 * This is the model class for table "jump_response".
 *
 * The followings are the available columns in table 'jump_response':
 * @property integer $id
 * @property integer $jump_request_id
 * @property integer $product_id
 * @property string $typeof
 * @property integer $points
 */
class JumpResponse extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return JumpResponse the static model class
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
		return 'jump_response';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('jump_request_id, product_id, typeof, points', 'required'),
			array('jump_request_id, product_id, points', 'numerical', 'integerOnly'=>true),
			array('typeof', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, jump_request_id, product_id, typeof, points', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'jump_request' => array(self::BELONGS_TO,'JumpRequest','jump_request_id'),
			'product' => array(self::BELONGS_TO,'Product','product_id'),
			'jump_response_type' => array(self::BELONGS_TO,'JumpResponseType','typeof'),
			'author' => array(self::BELONGS_TO,'User','author_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'jump_request_id' => 'Jump Request',
			'product_id' => 'Product',
			'typeof' => 'Typeof',
			'points' => 'Points',
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
		$criteria->compare('jump_request_id',$this->jump_request_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('typeof',$this->typeof,true);
		$criteria->compare('points',$this->points);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
