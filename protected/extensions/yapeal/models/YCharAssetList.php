<?php

/**
 * This is the model class for table "yapeal_charAssetList".
 *
 * The followings are the available columns in table 'yapeal_charAssetList':
 * @property string $ownerID
 * @property integer $flag
 * @property string $itemID
 * @property string $lft
 * @property string $locationID
 * @property integer $lvl
 * @property string $quantity
 * @property string $rawQuantity
 * @property string $rgt
 * @property integer $singleton
 * @property string $typeID
 *
 * The followings are the available model relations:
 * @property YUtilRegisteredCharacter $owner
 */
class YCharAssetList extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YCharAssetList the static model class
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
		return 'yapeal_charAssetList';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ownerID, flag, itemID, lft, locationID, lvl, quantity, rgt, singleton, typeID', 'required'),
			array('flag, lvl, singleton', 'numerical', 'integerOnly'=>true),
			array('ownerID, itemID, lft, locationID, quantity, rawQuantity, rgt, typeID', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ownerID, flag, itemID, lft, locationID, lvl, quantity, rawQuantity, rgt, singleton, typeID', 'safe', 'on'=>'search'),
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
			'flag' => 'Flag',
			'itemID' => 'Item',
			'lft' => 'Lft',
			'locationID' => 'Location',
			'lvl' => 'Lvl',
			'quantity' => 'Quantity',
			'rawQuantity' => 'Raw Quantity',
			'rgt' => 'Rgt',
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

		$criteria->compare('ownerID',$this->ownerID,true);
		$criteria->compare('flag',$this->flag);
		$criteria->compare('itemID',$this->itemID,true);
		$criteria->compare('lft',$this->lft,true);
		$criteria->compare('locationID',$this->locationID,true);
		$criteria->compare('lvl',$this->lvl);
		$criteria->compare('quantity',$this->quantity,true);
		$criteria->compare('rawQuantity',$this->rawQuantity,true);
		$criteria->compare('rgt',$this->rgt,true);
		$criteria->compare('singleton',$this->singleton);
		$criteria->compare('typeID',$this->typeID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}