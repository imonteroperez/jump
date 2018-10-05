<?php

/**
 * This is the model class for table "preferences_brands".
 *
 * The followings are the available columns in table 'preferences_brands':
 * @property integer $id
 * @property integer $user_id
 * @property integer $brand_id
 * @property integer $count
 */
class PreferencesBrands extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return PreferencesBrands the static model class
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
        return 'preferences_brands';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, brand_id, count', 'required'),
            array('user_id, brand_id, count', 'numerical', 'integerOnly'=>true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, user_id, brand_id, count', 'safe', 'on'=>'search'),
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
                        'user' => array(self::BELONGS_TO,'User','user_id'),
                        'brand' => array(self::BELONGS_TO,'Brand','brand_id'),
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
            'brand_id' => 'Brand',
            'count' => 'Count',
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
        $criteria->compare('brand_id',$this->brand_id);
        $criteria->compare('count',$this->count);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}

