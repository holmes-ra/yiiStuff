<?php

/**
 * This is the model class for table "yapeal_eveCorporationsKillsLastWeek".
 *
 * The followings are the available columns in table 'yapeal_eveCorporationsKillsLastWeek':
 * @property string $corporationID
 * @property string $corporationName
 * @property string $kills
 */
class YEveCorporationsKillsLastWeek extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YEveCorporationsKillsLastWeek the static model class
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
		return 'yapeal_eveCorporationsKillsLastWeek';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('corporationID, kills', 'required'),
			array('corporationID, kills', 'length', 'max'=>20),
			array('corporationName', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('corporationID, corporationName, kills', 'safe', 'on'=>'search'),
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
			'corporationID' => 'Corporation',
			'corporationName' => 'Corporation Name',
			'kills' => 'Kills',
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

		$criteria->compare('corporationID',$this->corporationID,true);
		$criteria->compare('corporationName',$this->corporationName,true);
		$criteria->compare('kills',$this->kills,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}