<?php

/**
 * This is the model class for table "yapeal_utilXmlCache".
 *
 * The followings are the available columns in table 'yapeal_utilXmlCache':
 * @property string $hash
 * @property string $api
 * @property string $modified
 * @property string $section
 * @property string $xml
 */
class YUtilXmlCache extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YUtilXmlCache the static model class
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
		return 'yapeal_utilXmlCache';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('hash, api, modified, section', 'required'),
			array('hash', 'length', 'max'=>40),
			array('api', 'length', 'max'=>32),
			array('section', 'length', 'max'=>8),
			array('xml', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('hash, api, modified, section, xml', 'safe', 'on'=>'search'),
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
			'hash' => 'Hash',
			'api' => 'Api',
			'modified' => 'Modified',
			'section' => 'Section',
			'xml' => 'Xml',
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

		$criteria->compare('hash',$this->hash,true);
		$criteria->compare('api',$this->api,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('section',$this->section,true);
		$criteria->compare('xml',$this->xml,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}