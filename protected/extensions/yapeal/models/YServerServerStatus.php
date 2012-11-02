<?php

/**
 * This is the model class for table "yapeal_serverServerStatus".
 *
 * The followings are the available columns in table 'yapeal_serverServerStatus':
 * @property string $onlinePlayers
 * @property string $serverName
 * @property string $serverOpen
 */
class YServerServerStatus extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YServerServerStatus the static model class
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
		return 'yapeal_serverServerStatus';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('onlinePlayers, serverName, serverOpen', 'required'),
			array('onlinePlayers', 'length', 'max'=>20),
			array('serverName, serverOpen', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('onlinePlayers, serverName, serverOpen', 'safe', 'on'=>'search'),
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
			'onlinePlayers' => 'Online Players',
			'serverName' => 'Server Name',
			'serverOpen' => 'Server Open',
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

		$criteria->compare('onlinePlayers',$this->onlinePlayers,true);
		$criteria->compare('serverName',$this->serverName,true);
		$criteria->compare('serverOpen',$this->serverOpen,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}