<?php

/**
 * This is the model class for table "yapeal_charCorporationTitles".
 *
 * The followings are the available columns in table 'yapeal_charCorporationTitles':
 * @property string $ownerID
 * @property string $titleID
 * @property string $titleName
 *
 * The followings are the available model relations:
 * @property YUtilRegisteredCharacter $owner
 */
class YCharCorporationTitles extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YCharCorporationTitles the static model class
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
		return 'yapeal_charCorporationTitles';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ownerID, titleID, titleName', 'required'),
			array('ownerID, titleID', 'length', 'max'=>20),
			array('titleName', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ownerID, titleID, titleName', 'safe', 'on'=>'search'),
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
			'titleID' => 'Title',
			'titleName' => 'Title Name',
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
		$criteria->compare('titleID',$this->titleID,true);
		$criteria->compare('titleName',$this->titleName,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}