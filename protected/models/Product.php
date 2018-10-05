<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $brand_id
 * @property double $price
 * @property integer $category_id
 * @property integer $jump_request_source
 * @property integer $photo_id
 */
class Product extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Product the static model class
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
		return 'product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, brand_id, price, category_id, jump_request_source, photo_id', 'required'),
			array('brand_id, category_id, jump_request_source, photo_id', 'numerical', 'integerOnly'=>true),
			array('price', 'numerical'),
			array('name', 'length', 'max'=>255),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, description, brand_id, price, category_id, jump_request_source, photo_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'feedbacks' => array(self::HAS_MANY,'Feedback','product_id'),
			'jump_requests' => array(self::HAS_MANY,'JumpRequest','product_id'),
			'jump_responses' => array(self::HAS_MANY,'JumpResponse','product_id'),
			'catalogs' => array(self::HAS_MANY,'Catalog','product_id'),
			'external_infos' => array(self::HAS_MANY,'ProductExternalInfo','product_id'),
			'brand' => array(self::BELONGS_TO,'Brand','brand_id'),
			'category' => array(self::BELONGS_TO,'Category','category_id'),
			'photo' => array(self::BELONGS_TO,'Photo','photo_id'),
			'tags' => array(self::HAS_MANY,'ProductTag','product_id'),
			'product_user_jump_requests' => array(self::HAS_MANY,'ProductUserJumpRequest','product_id'),
			'shops' => array(self::HAS_MANY,'ShopProduct','product_id'),
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
			'description' => 'Description',
			'brand_id' => 'Brand',
			'price' => 'Price',
			'category_id' => 'Category',
			'jump_request_source' => 'Jump Request Source',
			'photo_id' => 'Photo',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('brand_id',$this->brand_id);
		$criteria->compare('price',$this->price);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('jump_request_source',$this->jump_request_source);
		$criteria->compare('photo_id',$this->photo_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
