<?php

/**
 * This is the model class for table "yapeal_corpCorporationSheet".
 *
 * The followings are the available columns in table 'yapeal_corpCorporationSheet':
 * @property string $allianceID
 * @property string $allianceName
 * @property string $ceoID
 * @property string $ceoName
 * @property string $corporationID
 * @property string $corporationName
 * @property string $description
 * @property integer $memberCount
 * @property integer $memberLimit
 * @property string $shares
 * @property string $stationID
 * @property string $stationName
 * @property string $taxRate
 * @property string $ticker
 * @property string $url
 */
class YCorpCorporationSheet extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YCorpCorporationSheet the static model class
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
		return 'yapeal_corpCorporationSheet';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ceoID, ceoName, corporationID, corporationName, memberCount, shares, stationID, stationName, taxRate, ticker', 'required'),
			array('memberCount, memberLimit', 'numerical', 'integerOnly'=>true),
			array('allianceID, ceoID, corporationID, shares, stationID', 'length', 'max'=>20),
			array('allianceName, ceoName, corporationName, stationName, ticker, url', 'length', 'max'=>255),
			array('taxRate', 'length', 'max'=>5),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('allianceID, allianceName, ceoID, ceoName, corporationID, corporationName, description, memberCount, memberLimit, shares, stationID, stationName, taxRate, ticker, url', 'safe', 'on'=>'search'),
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
			'allianceID' => 'Alliance',
			'allianceName' => 'Alliance Name',
			'ceoID' => 'Ceo',
			'ceoName' => 'Ceo Name',
			'corporationID' => 'Corporation',
			'corporationName' => 'Corporation Name',
			'description' => 'Description',
			'memberCount' => 'Member Count',
			'memberLimit' => 'Member Limit',
			'shares' => 'Shares',
			'stationID' => 'Station',
			'stationName' => 'Station Name',
			'taxRate' => 'Tax Rate',
			'ticker' => 'Ticker',
			'url' => 'Url',
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

		$criteria->compare('allianceID',$this->allianceID,true);
		$criteria->compare('allianceName',$this->allianceName,true);
		$criteria->compare('ceoID',$this->ceoID,true);
		$criteria->compare('ceoName',$this->ceoName,true);
		$criteria->compare('corporationID',$this->corporationID,true);
		$criteria->compare('corporationName',$this->corporationName,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('memberCount',$this->memberCount);
		$criteria->compare('memberLimit',$this->memberLimit);
		$criteria->compare('shares',$this->shares,true);
		$criteria->compare('stationID',$this->stationID,true);
		$criteria->compare('stationName',$this->stationName,true);
		$criteria->compare('taxRate',$this->taxRate,true);
		$criteria->compare('ticker',$this->ticker,true);
		$criteria->compare('url',$this->url,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}