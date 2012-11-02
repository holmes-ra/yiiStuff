<?php

/**
 * This is the model class for table "yapeal_utilCachedInterval".
 *
 * The followings are the available columns in table 'yapeal_utilCachedInterval':
 * @property string $section
 * @property string $api
 * @property string $interval
 */
class YUtilCachedInterval extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YUtilCachedInterval the static model class
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
		return 'yapeal_utilCachedInterval';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('section, api, interval', 'required'),
			array('section', 'length', 'max'=>8),
			array('api', 'length', 'max'=>32),
			array('interval', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('section, api, interval', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'section' => 'Section',
			'api' => 'Api',
			'interval' => 'Interval',
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

		$criteria->compare('section',$this->section,true);
		$criteria->compare('api',$this->api,true);
		$criteria->compare('interval',$this->interval,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}