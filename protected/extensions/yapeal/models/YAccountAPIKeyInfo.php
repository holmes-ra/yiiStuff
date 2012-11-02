<?php

/**
 * This is the model class for table "yapeal_accountAPIKeyInfo".
 *
 * The followings are the available columns in table 'yapeal_accountAPIKeyInfo':
 * @property string $keyID
 * @property string $accessMask
 * @property string $expires
 * @property string $type
 */
class YAccountAPIKeyInfo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YAccountAPIKeyInfo the static model class
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
		return 'yapeal_accountAPIKeyInfo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('keyID, accessMask, type', 'required'),
			array('keyID, accessMask', 'length', 'max'=>20),
			array('type', 'length', 'max'=>11),
			array('expires', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('keyID, accessMask, expires, type', 'safe', 'on'=>'search'),
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
			'keyID' => 'Key',
			'accessMask' => 'Access Mask',
			'expires' => 'Expires',
			'type' => 'Type',
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
		$criteria->compare('accessMask',$this->accessMask,true);
		$criteria->compare('expires',$this->expires,true);
		$criteria->compare('type',$this->type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}