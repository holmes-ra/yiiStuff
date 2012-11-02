<?php

/**
 * This is the model class for table "yapeal_corpLogo".
 *
 * The followings are the available columns in table 'yapeal_corpLogo':
 * @property string $ownerID
 * @property integer $color1
 * @property integer $color2
 * @property integer $color3
 * @property string $graphicID
 * @property integer $shape1
 * @property integer $shape2
 * @property integer $shape3
 */
class YCorpLogo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YCorpLogo the static model class
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
		return 'yapeal_corpLogo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ownerID, color1, color2, color3, graphicID, shape1, shape2, shape3', 'required'),
			array('color1, color2, color3, shape1, shape2, shape3', 'numerical', 'integerOnly'=>true),
			array('ownerID, graphicID', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ownerID, color1, color2, color3, graphicID, shape1, shape2, shape3', 'safe', 'on'=>'search'),
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
			'color1' => 'Color1',
			'color2' => 'Color2',
			'color3' => 'Color3',
			'graphicID' => 'Graphic',
			'shape1' => 'Shape1',
			'shape2' => 'Shape2',
			'shape3' => 'Shape3',
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
		$criteria->compare('color1',$this->color1);
		$criteria->compare('color2',$this->color2);
		$criteria->compare('color3',$this->color3);
		$criteria->compare('graphicID',$this->graphicID,true);
		$criteria->compare('shape1',$this->shape1);
		$criteria->compare('shape2',$this->shape2);
		$criteria->compare('shape3',$this->shape3);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}