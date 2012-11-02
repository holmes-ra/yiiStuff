<?php

/**
 * This is the model class for table "yapeal_charAttributeEnhancers".
 *
 * The followings are the available columns in table 'yapeal_charAttributeEnhancers':
 * @property string $ownerID
 * @property string $augmentatorName
 * @property integer $augmentatorValue
 * @property string $bonusName
 *
 * The followings are the available model relations:
 * @property YUtilRegisteredCharacter $owner
 */
class YCharAttributeEnhancers extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YCharAttributeEnhancers the static model class
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
		return 'yapeal_charAttributeEnhancers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ownerID, augmentatorName, augmentatorValue, bonusName', 'required'),
			array('augmentatorValue', 'numerical', 'integerOnly'=>true),
			array('ownerID', 'length', 'max'=>20),
			array('augmentatorName, bonusName', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ownerID, augmentatorName, augmentatorValue, bonusName', 'safe', 'on'=>'search'),
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
			'owner' => array(self::BELONGS_TO, 'YUtilRegisteredCharacter', 'ownerID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ownerID' => 'Owner',
			'augmentatorName' => 'Augmentator Name',
			'augmentatorValue' => 'Augmentator Value',
			'bonusName' => 'Bonus Name',
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

		$criteria->compare('ownerID',$this->ownerID,true);
		$criteria->compare('augmentatorName',$this->augmentatorName,true);
		$criteria->compare('augmentatorValue',$this->augmentatorValue);
		$criteria->compare('bonusName',$this->bonusName,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}