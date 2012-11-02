<?php

/**
 * This is the model class for table "yapeal_accountCharacters".
 *
 * The followings are the available columns in table 'yapeal_accountCharacters':
 * @property string $characterID
 * @property string $characterName
 * @property string $corporationID
 * @property string $corporationName
 */
class YAccountCharacters extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YAccountCharacters the static model class
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
		return 'yapeal_accountCharacters';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('characterID, characterName, corporationID, corporationName', 'required'),
			//array('characterID, corporationID', 'length', 'max'=>20),
			//array('characterName, corporationName', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('characterID, characterName, corporationID, corporationName', 'safe', 'on'=>'search'),
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
			'characterID' => 'Character',
			'characterName' => 'Character Name',
			'corporationID' => 'Corporation',
			'corporationName' => 'Corporation Name',
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

		$criteria->compare('characterID',$this->characterID,true);
		$criteria->compare('characterName',$this->characterName,true);
		$criteria->compare('corporationID',$this->corporationID,true);
		$criteria->compare('corporationName',$this->corporationName,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}