<?php

/**
 * This is the model class for table "jump_request".
 *
 * The followings are the available columns in table 'jump_request':
 * @property integer $id
 * @property integer $votes
 * @property integer $product_id
 * @property integer $author_id
 * @property integer $desiredprice
 * @property integer $averagedprice
 * @property integer $photo_id
 * @property double $geoposition_lat
 * @property double $geoposition_long
 * @property string $date
 * @property integer $points
 */
class JumpRequest extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return JumpRequest the static model class
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
		return 'jump_request';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, author_id, desiredprice, photo_id, geoposition_lat, geoposition_long, date, points', 'required'),
			array('votes, product_id, author_id, desiredprice, averagedprice, photo_id, points', 'numerical', 'integerOnly'=>true),
			array('geoposition_lat, geoposition_long', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, votes, product_id, author_id, desiredprice, averagedprice, photo_id, geoposition_lat, geoposition_long, date, points', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'product' => array(self::BELONGS_TO,'Product','product_id'),
			'author' => array(self::BELONGS_TO,'User','author_id'),
			'photo' => array(self::BELONGS_TO,'Photo','photo_id'),
			'jump_responses' => array(self::HAS_MANY,'JumpResponse','jump_request_id'),
			'votes' => array(self::HAS_MANY,'JumpVote','jump_request_id'),
			'user_jump_requests' => array(self::HAS_ONE,'UserJumpRequest','jump_request_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'votes' => 'Votes',
			'product_id' => 'Product',
			'author_id' => 'Author',
			'desiredprice' => 'Desiredprice',
			'averagedprice' => 'Averagedprice',
			'photo_id' => 'Photo',
			'geoposition_lat' => 'Geoposition Lat',
			'geoposition_long' => 'Geoposition Long',
			'date' => 'Date',
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
		$criteria->compare('votes',$this->votes);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('author_id',$this->author_id);
		$criteria->compare('desiredprice',$this->desiredprice);
		$criteria->compare('averagedprice',$this->averagedprice);
		$criteria->compare('photo_id',$this->photo_id);
		$criteria->compare('geoposition_lat',$this->geoposition_lat);
		$criteria->compare('geoposition_long',$this->geoposition_long);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('points',$this->points);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
