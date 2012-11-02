<?php

/**
 * This is the model class for table "yapeal_corpStarbaseDetail".
 *
 * The followings are the available columns in table 'yapeal_corpStarbaseDetail':
 * @property string $ownerID
 * @property string $posID
 * @property string $onlineTimestamp
 * @property integer $state
 * @property string $stateTimestamp
 */
class YCorpStarbaseDetail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YCorpStarbaseDetail the static model class
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
		return 'yapeal_corpStarbaseDetail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ownerID, posID, onlineTimestamp, state, stateTimestamp', 'required'),
			array('state', 'numerical', 'integerOnly'=>true),
			array('ownerID, posID', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ownerID, posID, onlineTimestamp, state, stateTimestamp', 'safe', 'on'=>'search'),
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
			'onlineTimestamp' => 'Online Timestamp',
			'state' => 'State',
			'stateTimestamp' => 'State Timestamp',
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
		$criteria->compare('onlineTimestamp',$this->onlineTimestamp,true);
		$criteria->compare('state',$this->state);
		$criteria->compare('stateTimestamp',$this->stateTimestamp,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}