<?php

/**
 * This is the model class for table "yapeal_eveRefTypes".
 *
 * The followings are the available columns in table 'yapeal_eveRefTypes':
 * @property integer $refTypeID
 * @property string $refTypeName
 */
class YEveRefTypes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YEveRefTypes the static model class
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
		return 'yapeal_eveRefTypes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('refTypeID', 'required'),
			array('refTypeID', 'numerical', 'integerOnly'=>true),
			array('refTypeName', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('refTypeID, refTypeName', 'safe', 'on'=>'search'),
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
			'refTypeID' => 'Ref Type',
			'refTypeName' => 'Ref Type Name',
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

		$criteria->compare('refTypeID',$this->refTypeID);
		$criteria->compare('refTypeName',$this->refTypeName,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}