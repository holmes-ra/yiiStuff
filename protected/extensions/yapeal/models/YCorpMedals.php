<?php

/**
 * This is the model class for table "yapeal_corpMedals".
 *
 * The followings are the available columns in table 'yapeal_corpMedals':
 * @property string $ownerID
 * @property string $created
 * @property string $creatorID
 * @property string $description
 * @property string $medalID
 * @property string $title
 */
class YCorpMedals extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YCorpMedals the static model class
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
		return 'yapeal_corpMedals';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ownerID, created, creatorID, medalID, title', 'required'),
			array('ownerID, creatorID, medalID', 'length', 'max'=>20),
			array('title', 'length', 'max'=>255),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ownerID, created, creatorID, description, medalID, title', 'safe', 'on'=>'search'),
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
			'created' => 'Created',
			'creatorID' => 'Creator',
			'description' => 'Description',
			'medalID' => 'Medal',
			'title' => 'Title',
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
		$criteria->compare('created',$this->created,true);
		$criteria->compare('creatorID',$this->creatorID,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('medalID',$this->medalID,true);
		$criteria->compare('title',$this->title,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}