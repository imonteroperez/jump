<?php

/**
 * This is the model class for table "badge".
 *
 * The followings are the available columns in table 'badge':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $img
 * @property integer $typeof
 */
class Badge extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Badge the static model class
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
		return 'badge';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, description, img, typeof', 'required'),
			array('typeof', 'numerical', 'integerOnly'=>true),
			array('title, img', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, description, img, typeof', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'badge_type' => array(self::BELONGS_TO, 'BadgeType','typeof'),
			'winners' => array(self::HAS_MANY, 'UserBadge','badge_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'description' => 'Description',
			'img' => 'Img',
			'typeof' => 'Typeof',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('img',$this->img,true);
		$criteria->compare('typeof',$this->typeof);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
