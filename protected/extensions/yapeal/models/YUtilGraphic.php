<?php

/**
 * This is the model class for table "yapeal_utilGraphic".
 *
 * The followings are the available columns in table 'yapeal_utilGraphic':
 * @property string $graphic
 * @property string $graphicType
 * @property string $ownerID
 * @property string $ownerType
 */
class YUtilGraphic extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YUtilGraphic the static model class
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
		return 'yapeal_utilGraphic';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ownerID', 'required'),
			array('graphicType, ownerType', 'length', 'max'=>4),
			array('ownerID', 'length', 'max'=>20),
			array('graphic', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('graphic, graphicType, ownerID, ownerType', 'safe', 'on'=>'search'),
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
			'graphic' => 'Graphic',
			'graphicType' => 'Graphic Type',
			'ownerID' => 'Owner',
			'ownerType' => 'Owner Type',
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

		$criteria->compare('graphic',$this->graphic,true);
		$criteria->compare('graphicType',$this->graphicType,true);
		$criteria->compare('ownerID',$this->ownerID,true);
		$criteria->compare('ownerType',$this->ownerType,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}