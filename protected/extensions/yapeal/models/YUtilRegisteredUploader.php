<?php

/**
 * This is the model class for table "yapeal_utilRegisteredUploader".
 *
 * The followings are the available columns in table 'yapeal_utilRegisteredUploader':
 * @property integer $isActive
 * @property string $key
 * @property string $ownerID
 * @property string $uploadDestinationID
 */
class YUtilRegisteredUploader extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YUtilRegisteredUploader the static model class
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
		return 'yapeal_utilRegisteredUploader';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ownerID, uploadDestinationID', 'required'),
			array('isActive', 'numerical', 'integerOnly'=>true),
			array('key', 'length', 'max'=>255),
			array('ownerID, uploadDestinationID', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('isActive, key, ownerID, uploadDestinationID', 'safe', 'on'=>'search'),
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
			'isActive' => 'Is Active',
			'key' => 'Key',
			'ownerID' => 'Owner',
			'uploadDestinationID' => 'Upload Destination',
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

		$criteria->compare('isActive',$this->isActive);
		$criteria->compare('key',$this->key,true);
		$criteria->compare('ownerID',$this->ownerID,true);
		$criteria->compare('uploadDestinationID',$this->uploadDestinationID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}