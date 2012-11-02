<?php

/**
 * This is the model class for table "yapeal_corpGeneralSettings".
 *
 * The followings are the available columns in table 'yapeal_corpGeneralSettings':
 * @property string $ownerID
 * @property string $posID
 * @property integer $allowAllianceMembers
 * @property integer $allowCorporationMembers
 * @property integer $deployFlags
 * @property integer $usageFlags
 */
class YCorpGeneralSettings extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YCorpGeneralSettings the static model class
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
		return 'yapeal_corpGeneralSettings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ownerID, posID, allowAllianceMembers, allowCorporationMembers, deployFlags, usageFlags', 'required'),
			array('allowAllianceMembers, allowCorporationMembers, deployFlags, usageFlags', 'numerical', 'integerOnly'=>true),
			array('ownerID, posID', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ownerID, posID, allowAllianceMembers, allowCorporationMembers, deployFlags, usageFlags', 'safe', 'on'=>'search'),
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
			'ownerID' => 'Owner',
			'posID' => 'Pos',
			'allowAllianceMembers' => 'Allow Alliance Members',
			'allowCorporationMembers' => 'Allow Corporation Members',
			'deployFlags' => 'Deploy Flags',
			'usageFlags' => 'Usage Flags',
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
		$criteria->compare('posID',$this->posID,true);
		$criteria->compare('allowAllianceMembers',$this->allowAllianceMembers);
		$criteria->compare('allowCorporationMembers',$this->allowCorporationMembers);
		$criteria->compare('deployFlags',$this->deployFlags);
		$criteria->compare('usageFlags',$this->usageFlags);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}