<?php

/**
 * This is the model class for table "yapeal_charItems".
 *
 * The followings are the available columns in table 'yapeal_charItems':
 * @property integer $flag
 * @property string $killID
 * @property string $lft
 * @property integer $lvl
 * @property string $rgt
 * @property string $qtyDropped
 * @property string $qtyDestroyed
 * @property integer $singleton
 * @property string $typeID
 *
 * The followings are the available model relations:
 * @property YCharKillLog $kill
 */
class YCharItems extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YCharItems the static model class
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
		return 'yapeal_charItems';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('flag, killID, lft, lvl, rgt, qtyDropped, qtyDestroyed, singleton, typeID', 'required'),
			array('flag, lvl, singleton', 'numerical', 'integerOnly'=>true),
			array('killID, lft, rgt, qtyDropped, qtyDestroyed, typeID', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('flag, killID, lft, lvl, rgt, qtyDropped, qtyDestroyed, singleton, typeID', 'safe', 'on'=>'search'),
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
			'kill' => array(self::BELONGS_TO, 'YCharKillLog', 'killID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'flag' => 'Flag',
			'killID' => 'Kill',
			'lft' => 'Lft',
			'lvl' => 'Lvl',
			'rgt' => 'Rgt',
			'qtyDropped' => 'Qty Dropped',
			'qtyDestroyed' => 'Qty Destroyed',
			'singleton' => 'Singleton',
			'typeID' => 'Type',
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

		$criteria->compare('flag',$this->flag);
		$criteria->compare('killID',$this->killID,true);
		$criteria->compare('lft',$this->lft,true);
		$criteria->compare('lvl',$this->lvl);
		$criteria->compare('rgt',$this->rgt,true);
		$criteria->compare('qtyDropped',$this->qtyDropped,true);
		$criteria->compare('qtyDestroyed',$this->qtyDestroyed,true);
		$criteria->compare('singleton',$this->singleton);
		$criteria->compare('typeID',$this->typeID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}