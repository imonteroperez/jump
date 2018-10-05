<?php

/**
 * This is the model class for table "shop".
 *
 * The followings are the available columns in table 'shop':
 * @property integer $id
 * @property integer $name
 * @property integer $address
 * @property integer $geolocation_lat
 * @property integer $geolocation_long
 */
class Shop extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Shop the static model class
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
		return 'shop';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, address', 'required'),
			array('name, address, geolocation_lat, geolocation_long', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, address, geolocation_lat, geolocation_long', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'external_sites' => array(self::HAS_MANY,'ExternalSite','shop_id'),
			'products' => array(self::HAS_MANY,'ShopProduct','shop_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'address' => 'Address',
			'geolocation_lat' => 'Geolocation Lat',
			'geolocation_long' => 'Geolocation Long',
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
		$criteria->compare('name',$this->name);
		$criteria->compare('address',$this->address);
		$criteria->compare('geolocation_lat',$this->geolocation_lat);
		$criteria->compare('geolocation_long',$this->geolocation_long);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
