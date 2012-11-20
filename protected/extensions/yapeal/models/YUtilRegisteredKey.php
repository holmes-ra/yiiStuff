<?php

/**
 * This is the model class for table "yapeal_utilRegisteredKey".
 * this models handles API keys for registered users
 *
 * The followings are the available columns in table 'yapeal_utilRegisteredKey':
 * @property string $activeAPIMask
 * @property integer $isActive
 * @property string $keyID
 * @property string $proxy
 * @property string $vCode
 * @property integer $userID
 *
 * The followings are the available model relations:
 * @property YAccountKeyBridge[] $accountKeyBridges
 * @property YUsers $user
 */
class YUtilRegisteredKey extends CActiveRecord
{
	public $characters = array(); // is set during registration and new key. No better place to put this?

	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YUtilRegisteredKey the static model class
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
		return 'yapeal_utilRegisteredKey';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
        
        // todo: May prove usefull if I must switch between validation rules and how save() works
        // http://www.yiiframework.com/wiki/266/understanding-scenarios/
		return array(
			array('keyID, vCode', 'required'), // removed userID as validation doesn't assign it
			array('isActive, userID, keyID', 'numerical', 'integerOnly'=>true),
			array('activeAPIMask, keyID', 'length', 'max'=>20),
			array('vCode', 'length', 'max'=>64),
			array('keyID', 'unique', 'message' => UserModule::t("This keyID already exists.")),
			array('keyID', 'ext.validators.apiCheck', 'vCode'=>'vCode', 'message' => UserModule::t("This keyID/vCode combo is invalid.")),

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('activeAPIMask, isActive, keyID, proxy, vCode, userID', 'safe', 'on'=>'search'),
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
			'accountCharacters' => array(self::MANY_MANY,  'YAccountCharacters', 'yapeal_accountKeyBridge(keyID, characterID)'),
			'accountKeyBridges' => array(self::HAS_MANY,   'YAccountKeyBridge', 'keyID'),
			// returns owner of key
			'user'              => array(self::BELONGS_TO, 'Users', 'userID'),
			// returns registered characters associated with key
			'regCharacters'     => array(self::MANY_MANY,  'YUtilRegisteredCharacter', 'yapeal_accountKeyBridge(keyID, characterID)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'activeAPIMask' => 'Active Apimask',
			'isActive' => 'Is Active',
			'keyID' => 'Key',
			'proxy' => 'Proxy',
			'vCode' => 'V Code',
			'userID' => 'User',
		);
	}
	
	public function scopes()
    {
        return array();
    }
	
	public function behaviors() {
		return array(
			'withRelated'=>array(
				'class'=>'ext.withrelated.WithRelatedBehavior',
			),
		);
	}

	/*
	 * NEVERMIND DO NOT LOOK AT THIS
	 * Custom save() that includes withRelated
	 * Due to user registration, where the User model calls this model during a withRelated save,
	 * I must make this one call withRelated as well but there's no way to do it with the User model.
	 * hence I must make it the default save() functions
	 * 
	 * Every time you save a api, we MUST do validation for key/vCode combo, so It's not so bad as 
	 * almost every save will be withRelated. Only exception is if you're updating isActive for the key
	 *
	 * todo: look into scenerio's, or $this->isNewRecord to determine if we want to save withRelated or not
	 * (new record - yes, updating old one - no (this would involed disabling updating key/code pairs, by
	 * why would anyone do that??))
	 
	public function save($runValidation=true,$attributes=null) 
	{	 
		echo "<h1>lol</h1>";
		$this->withRelated->save($runValidation, array('accountCharacters'));
	}
	*/

	/* 
		Do this after validation but before saving, as this preps data. 
		todo: read todo for save()


		I tried it, and worked well when saved withRelated->, however if being USED with withRelated->
		(such as in the User class when registering, this class is saved withRelated).
		Perhaps modify withRelated class to accept an extra param, this param being a class name (?), 
		and once it gets to saving that class use Withrelated and then the value of that param 
		(save with related to what?)

		For now, call this before saving keys (all keys should be validated first, unless updating 
		access mask or isActive, so characters should be populated via ext.validators.apiCheck)

		TEST CASE:
		$key = new YUtilRegisteredKey;
		$key->keyID = 660736;
		$key->vCode = 'qrE9lZI3nsoJptuLzE5jy0ScVFFxKsSrPVW88Fwr74mKBo7gNkcPIkuXPT0SY6hh';
		$key->userID = 25; //needs to be proper value in user table
		echo var_dump($key->validate());

		$char_array = array();

		foreach ($key->characters AS $character){
			echo $character->characterID."<br>";
			if (($char = YAccountCharacters::model()->findByPk($character->characterID)) === null){
				$char = new YAccountCharacters;
				$char->characterID     = $character->characterID;
				$char->characterName   = $character->characterName;
				$char->corporationID   = $character->corporationID;
				$char->corporationName = 
				$character->corporationName;
			}
			array_push($char_array, $char);
		}
		$key->accountCharacters = $char_array;
		echo var_dump($key->withRelated->save(false, array('accountCharacters')));

	*/
	public function afterValidate() {
		parent::afterValidate();
		$char_array = array();

		foreach ($this->characters AS $character){
			if (($char = YAccountCharacters::model()->findByPk($character->characterID)) === null){
				$char = new YAccountCharacters;
				$char->characterID     = $character->characterID;
				$char->characterName   = $character->characterName;
				$char->corporationID   = $character->corporationID;
				$char->corporationName = $character->corporationName;
			}
			array_push($char_array, $char);
		}
		$this->accountCharacters = $char_array;
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

		$criteria->compare('activeAPIMask',$this->activeAPIMask,true);
		$criteria->compare('isActive',$this->isActive);
		$criteria->compare('keyID',$this->keyID,true);
		$criteria->compare('proxy',$this->proxy,true);
		$criteria->compare('vCode',$this->vCode,true);
		$criteria->compare('userID',$this->userID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
