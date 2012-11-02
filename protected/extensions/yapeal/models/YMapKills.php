<?php

/**
 * This is the model class for table "yapeal_mapKills".
 *
 * The followings are the available columns in table 'yapeal_mapKills':
 * @property string $factionKills
 * @property string $podKills
 * @property string $shipKills
 * @property string $solarSystemID
 */
class YMapKills extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YMapKills the static model class
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
		return 'yapeal_mapKills';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('factionKills, podKills, shipKills, solarSystemID', 'required'),
			array('factionKills, podKills, shipKills, solarSystemID', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('factionKills, podKills, shipKills, solarSystemID', 'safe', 'on'=>'search'),
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
			'factionKills' => 'Faction Kills',
			'podKills' => 'Pod Kills',
			'shipKills' => 'Ship Kills',
			'solarSystemID' => 'Solar System',
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

		$criteria->compare('factionKills',$this->factionKills,true);
		$criteria->compare('podKills',$this->podKills,true);
		$criteria->compare('shipKills',$this->shipKills,true);
		$criteria->compare('solarSystemID',$this->solarSystemID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}