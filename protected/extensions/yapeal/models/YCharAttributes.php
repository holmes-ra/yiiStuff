<?php

/**
 * This is the model class for table "yapeal_charAttributes".
 *
 * The followings are the available columns in table 'yapeal_charAttributes':
 * @property integer $charisma
 * @property integer $intelligence
 * @property integer $memory
 * @property string $ownerID
 * @property integer $perception
 * @property integer $willpower
 *
 * The followings are the available model relations:
 * @property YUtilRegisteredCharacter $owner
 */
class YCharAttributes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YCharAttributes the static model class
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
		return 'yapeal_charAttributes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('charisma, intelligence, memory, ownerID, perception, willpower', 'required'),
			array('charisma, intelligence, memory, perception, willpower', 'numerical', 'integerOnly'=>true),
			array('ownerID', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('charisma, intelligence, memory, ownerID, perception, willpower', 'safe', 'on'=>'search'),
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
			'charisma' => 'Charisma',
			'intelligence' => 'Intelligence',
			'memory' => 'Memory',
			'ownerID' => 'Owner',
			'perception' => 'Perception',
			'willpower' => 'Willpower',
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

		$criteria->compare('charisma',$this->charisma);
		$criteria->compare('intelligence',$this->intelligence);
		$criteria->compare('memory',$this->memory);
		$criteria->compare('ownerID',$this->ownerID,true);
		$criteria->compare('perception',$this->perception);
		$criteria->compare('willpower',$this->willpower);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}