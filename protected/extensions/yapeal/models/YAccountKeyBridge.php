<?php

/**
 * This is the model class for table "yapeal_accountKeyBridge".
 *
 * The followings are the available columns in table 'yapeal_accountKeyBridge':
 * @property string $keyID
 * @property string $characterID
 *
 * The followings are the available model relations:
 * @property YUtilRegisteredKey $key
 */
class YAccountKeyBridge extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YAccountKeyBridge the static model class
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
		return 'yapeal_accountKeyBridge';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('keyID, characterID', 'required'),
			array('keyID, characterID', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('keyID, characterID', 'safe', 'on'=>'search'),
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
			'key' => array(self::BELONGS_TO, 'YUtilRegisteredKey', 'keyID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'keyID' => 'Key',
			'characterID' => 'Character',
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

		$criteria->compare('keyID',$this->keyID,true);
		$criteria->compare('characterID',$this->characterID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}