<?php

/**
 * This is the model class for table "external_site".
 *
 * The followings are the available columns in table 'external_site':
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property integer $source
 * @property integer $brand_id
 * @property integer $shop_id
 */
class ExternalSite extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ExternalSite the static model class
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
        return 'external_site';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, url, source', 'required'),
            array('source, brand_id, shop_id', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=>255),
            array('url', 'length', 'max'=>500),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, url, source, brand_id, shop_id', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
		return array(
			'user' => array(self::HAS_ONE,'User','external_site_id'),
			'source' => array(self::BELONGS_TO,'SourceType','source'),
			'brand' => array(self::BELONGS_TO,'Brand','brand_id'),
			'shop' => array(self::BELONGS_TO,'Shop','shop_id'),
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
            'url' => 'Url',
            'source' => 'Source',
            'brand_id' => 'Brand',
            'shop_id' => 'Shop',
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
        $criteria->compare('url',$this->url,true);
        $criteria->compare('source',$this->source);
        $criteria->compare('brand_id',$this->brand_id);
        $criteria->compare('shop_id',$this->shop_id);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}
