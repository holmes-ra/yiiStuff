<?php

/**
 * This is the model class for table "yapeal_utilRegisteredCorporation".
 *
 * The followings are the available columns in table 'yapeal_utilRegisteredCorporation':
 * @property string $activeAPIMask
 * @property string $corporationID
 * @property string $corporationName
 * @property integer $isActive
 * @property string $proxy
 */
class YUtilRegisteredCorporation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YUtilRegisteredCorporation the static model class
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
		return 'yapeal_utilRegisteredCorporation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('corporationID', 'required'),
			array('isActive', 'numerical', 'integerOnly'=>true),
			array('activeAPIMask, corporationID', 'length', 'max'=>20),
			array('corporationName', 'length', 'max'=>150),
			array('proxy', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('activeAPIMask, corporationID, corporationName, isActive, proxy', 'safe', 'on'=>'search'),
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
			'activeAPIMask' => 'Active Apimask',
			'corporationID' => 'Corporation',
			'corporationName' => 'Corporation Name',
			'isActive' => 'Is Active',
			'proxy' => 'Proxy',
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

		$criteria->compare('activeAPIMask',$this->activeAPIMask,true);
		$criteria->compare('corporationID',$this->corporationID,true);
		$criteria->compare('corporationName',$this->corporationName,true);
		$criteria->compare('isActive',$this->isActive);
		$criteria->compare('proxy',$this->proxy,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}