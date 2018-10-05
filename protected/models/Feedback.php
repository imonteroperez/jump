<?php

/**
 * This is the model class for table "feedback".
 *
 * The followings are the available columns in table 'feedback':
 * @property integer $id
 * @property integer $typeof
 * @property integer $user_id
 * @property integer $product_id
 * @property integer $parameter_id
 */
class Feedback extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Feedback the static model class
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
		return 'feedback';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('typeof, user_id, product_id, parameter_id', 'required'),
			array('typeof, user_id, product_id, parameter_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, typeof, user_id, product_id, parameter_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'parameter_type' => array(self::BELONGS_TO,'FeedbackType','typeof'),
			'user' => array(self::BELONGS_TO,'User','user_id'),
			'product' => array(self::BELONGS_TO,'Product','product_id'),
			'parameter' => array(self::BELONGS_TO,'FeedbackParameter','parameter_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'typeof' => 'Typeof',
			'user_id' => 'User',
			'product_id' => 'Product',
			'parameter_id' => 'Parameter',
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
		$criteria->compare('typeof',$this->typeof);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('parameter_id',$this->parameter_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
