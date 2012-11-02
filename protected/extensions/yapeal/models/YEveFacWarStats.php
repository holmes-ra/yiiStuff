<?php

/**
 * This is the model class for table "yapeal_eveFacWarStats".
 *
 * The followings are the available columns in table 'yapeal_eveFacWarStats':
 * @property string $killsYesterday
 * @property string $killsLastWeek
 * @property string $killsTotal
 * @property string $victoryPointsYesterday
 * @property string $victoryPointsLastWeek
 * @property string $victoryPointsTotal
 */
class YEveFacWarStats extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YEveFacWarStats the static model class
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
		return 'yapeal_eveFacWarStats';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('killsYesterday, killsLastWeek, killsTotal, victoryPointsYesterday, victoryPointsLastWeek, victoryPointsTotal', 'required'),
			array('killsYesterday, killsLastWeek, killsTotal, victoryPointsYesterday, victoryPointsLastWeek, victoryPointsTotal', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('killsYesterday, killsLastWeek, killsTotal, victoryPointsYesterday, victoryPointsLastWeek, victoryPointsTotal', 'safe', 'on'=>'search'),
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
			'killsYesterday' => 'Kills Yesterday',
			'killsLastWeek' => 'Kills Last Week',
			'killsTotal' => 'Kills Total',
			'victoryPointsYesterday' => 'Victory Points Yesterday',
			'victoryPointsLastWeek' => 'Victory Points Last Week',
			'victoryPointsTotal' => 'Victory Points Total',
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

		$criteria->compare('killsYesterday',$this->killsYesterday,true);
		$criteria->compare('killsLastWeek',$this->killsLastWeek,true);
		$criteria->compare('killsTotal',$this->killsTotal,true);
		$criteria->compare('victoryPointsYesterday',$this->victoryPointsYesterday,true);
		$criteria->compare('victoryPointsLastWeek',$this->victoryPointsLastWeek,true);
		$criteria->compare('victoryPointsTotal',$this->victoryPointsTotal,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}