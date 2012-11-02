<?php

/**
 * This is the model class for table "yapeal_eveAllianceList".
 *
 * The followings are the available columns in table 'yapeal_eveAllianceList':
 * @property string $allianceID
 * @property string $executorCorpID
 * @property string $memberCount
 * @property string $name
 * @property string $shortName
 * @property string $startDate
 */
class YEveAllianceList extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YEveAllianceList the static model class
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
		return 'yapeal_eveAllianceList';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('allianceID', 'required'),
			array('allianceID, executorCorpID, memberCount', 'length', 'max'=>20),
			array('name, shortName', 'length', 'max'=>255),
			array('startDate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('allianceID, executorCorpID, memberCount, name, shortName, startDate', 'safe', 'on'=>'search'),
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
			'allianceID' => 'Alliance',
			'executorCorpID' => 'Executor Corp',
			'memberCount' => 'Member Count',
			'name' => 'Name',
			'shortName' => 'Short Name',
			'startDate' => 'Start Date',
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

		$criteria->compare('allianceID',$this->allianceID,true);
		$criteria->compare('executorCorpID',$this->executorCorpID,true);
		$criteria->compare('memberCount',$this->memberCount,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('shortName',$this->shortName,true);
		$criteria->compare('startDate',$this->startDate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}