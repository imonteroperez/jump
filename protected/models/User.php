<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $first_name
 * @property string $last_name
 * @property integer $external_site_id
 * @property double $geolocation_lat
 * @property double $geolocation_long
 * @property integer $pinned
 * @property string $suggested_by
 */
class User extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
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
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('first_name, last_name, external_site_id', 'required'),
            array('external_site_id, pinned', 'numerical', 'integerOnly'=>true),
            array('geolocation_lat, geolocation_long', 'numerical'),
            array('first_name, last_name', 'length', 'max'=>255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, first_name, last_name, external_site_id, geolocation_lat, geolocation_long, pinned, suggested_by', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
		return array(
			'external_site' => array(self::BELONGS_TO,'ExternalSite','external_site_id'),
			'catalogs' => array(self::HAS_MANY,'Catalog','user_id'),
			'friends' => array(self::HAS_MANY,'Friends','follower_id'),
			'catalogs_voted' => array(self::HAS_MANY,'CatalogVote','user_id'),
			'feedbacks' => array(self::HAS_MANY,'Feedback','user_id'),
			'jump_requests' => array(self::HAS_MANY,'JumpRequest','author_id'),
			'jump_responses' => array(self::HAS_MANY,'JumpResponse','author_id'),
			'jump_votes' => array(self::HAS_MANY,'JumpVote','user_id'),
			'preferences_brands' =>array(self::HAS_MANY,'PreferencesBrands','user_id'),
			'preferences_categories' =>array(self::HAS_MANY,'PreferencesCategories','user_id'),
			'badges' => array(self::HAS_MANY,'UserBadge','user_id'),
			'user_jump_requests' => array(self::HAS_MANY,'UserJumpRequest','user_id'),
			'user_jump_responses' => array(self::HAS_MANY,'UserJumpResponse','user_id'),
		);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'external_site_id' => 'External Site',
            'geolocation_lat' => 'Geolocation Lat',
            'geolocation_long' => 'Geolocation Long',
            'pinned' => 'Pinned',
            'suggested_by' => 'Suggested by'
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

        $criteria->compare('id',$this->id,true);
        $criteria->compare('first_name',$this->first_name,true);
        $criteria->compare('last_name',$this->last_name,true);
        $criteria->compare('external_site_id',$this->external_site_id);
        $criteria->compare('geolocation_lat',$this->geolocation_lat);
        $criteria->compare('geolocation_long',$this->geolocation_long);
        $criteria->compare('pinned',$this->pinned);
        $criteria->compare('suggested_by',$this->suggested_by);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}



