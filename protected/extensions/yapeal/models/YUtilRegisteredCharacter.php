<?php

/**
 * This is the model class for table "yapeal_utilRegisteredCharacter".
 *
 * The followings are the available columns in table 'yapeal_utilRegisteredCharacter':
 * @property string $activeAPIMask
 * @property string $characterID
 * @property string $characterName
 * @property integer $isActive
 * @property string $proxy
 *
 * The followings are the available model relations:
 * @property YCharAccountBalance[] $charAccountBalances
 * @property YCharAllianceContactList[] $charAllianceContactLists
 * @property YCharAssetList[] $charAssetLists
 * @property YCharAttributeEnhancers[] $charAttributeEnhancers
 * @property YCharAttributes $charAttributes
 * @property YCharCalendarEventAttendees[] $charCalendarEventAttendees
 * @property YCharCertificates[] $charCertificates
 * @property YCharCharacterSheet $charCharacterSheet
 * @property YCharContactList[] $charContactLists
 * @property YCharContactNotifications[] $charContactNotifications
 * @property YCharContracts[] $charContracts
 * @property YCharCorporateContactList[] $charCorporateContactLists
 * @property YCharCorporationRoles[] $charCorporationRoles
 * @property YCharCorporationRolesAtBase[] $charCorporationRolesAtBases
 * @property YCharCorporationRolesAtHQ[] $charCorporationRolesAtHQs
 * @property YCharCorporationRolesAtOther[] $charCorporationRolesAtOthers
 * @property YCharCorporationTitles[] $charCorporationTitles
 * @property YCharFacWarStats $charFacWarStats
 * @property YCharIndustryJobs[] $charIndustryJobs
 * @property YCharMailMessages[] $yapealCharMailMessages
 * @property YCharMailBodies[] $yapealCharMailBodies
 * @property YCharMailingLists[] $charMailingLists
 * @property YCharMarketOrders[] $charMarketOrders
 * @property YCharNotificationTexts[] $charNotificationTexts
 * @property YCharNotifications[] $charNotifications
 * @property YCharResearch[] $charResearches
 * @property YCharSkillInTraining $charSkillInTraining
 * @property YCharSkillQueue[] $charSkillQueues
 * @property YCharSkills[] $charSkills
 * @property YCharStandingsFromAgents[] $charStandingsFromAgents
 * @property YCharStandingsFromFactions[] $charStandingsFromFactions
 * @property YCharStandingsFromNPCCorporations[] $charStandingsFromNPCCorporations
 * @property YCharWalletJournal[] $charWalletJournals
 * @property YCharWalletTransactions[] $charWalletTransactions
 */
class YUtilRegisteredCharacter extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YUtilRegisteredCharacter the static model class
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
		return 'yapeal_utilRegisteredCharacter';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('characterID', 'required'),
			array('isActive', 'numerical', 'integerOnly'=>true),
			array('activeAPIMask, characterID', 'length', 'max'=>20),
			array('characterName', 'length', 'max'=>100),
			array('proxy', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('activeAPIMask, characterID, characterName, isActive, proxy', 'safe', 'on'=>'search'),
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
			'charAccountBalances' => array(self::HAS_MANY, 'YCharAccountBalance', 'ownerID'),
			'charAllianceContactLists' => array(self::HAS_MANY, 'YCharAllianceContactList', 'ownerID'),
			'charAssetLists' => array(self::HAS_MANY, 'YCharAssetList', 'ownerID'),
			'charAttributeEnhancers' => array(self::HAS_MANY, 'YCharAttributeEnhancers', 'ownerID'),
			'charAttributes' => array(self::HAS_ONE, 'YCharAttributes', 'ownerID'),
			'charCalendarEventAttendees' => array(self::HAS_MANY, 'YCharCalendarEventAttendees', 'ownerID'),
			'charCertificates' => array(self::HAS_MANY, 'YCharCertificates', 'ownerID'),
			'charCharacterSheet' => array(self::HAS_ONE, 'YCharCharacterSheet', 'characterID'),
			'charContactLists' => array(self::HAS_MANY, 'YCharContactList', 'ownerID'),
			'charContactNotifications' => array(self::HAS_MANY, 'YCharContactNotifications', 'ownerID'),
			'charContracts' => array(self::HAS_MANY, 'YCharContracts', 'ownerID'),
			'charCorporateContactLists' => array(self::HAS_MANY, 'YCharCorporateContactList', 'ownerID'),
			'charCorporationRoles' => array(self::HAS_MANY, 'YCharCorporationRoles', 'ownerID'),
			'charCorporationRolesAtBases' => array(self::HAS_MANY, 'YCharCorporationRolesAtBase', 'ownerID'),
			'charCorporationRolesAtHQs' => array(self::HAS_MANY, 'YCharCorporationRolesAtHQ', 'ownerID'),
			'charCorporationRolesAtOthers' => array(self::HAS_MANY, 'YCharCorporationRolesAtOther', 'ownerID'),
			'charCorporationTitles' => array(self::HAS_MANY, 'YCharCorporationTitles', 'ownerID'),
			'charFacWarStats' => array(self::HAS_ONE, 'YCharFacWarStats', 'ownerID'),
			'charIndustryJobs' => array(self::HAS_MANY, 'YCharIndustryJobs', 'ownerID'),
			'yapealCharMailMessages' => array(self::MANY_MANY, 'YCharMailMessages', 'yapeal_charMailBodies(ownerID, messageID)'),
			'yapealCharMailBodies' => array(self::MANY_MANY, 'YCharMailBodies', 'yapeal_charMailMessages(ownerID, messageID)'),
			'charMailingLists' => array(self::HAS_MANY, 'YCharMailingLists', 'ownerID'),
			'charMarketOrders' => array(self::HAS_MANY, 'YCharMarketOrders', 'ownerID'),
			'charNotificationTexts' => array(self::HAS_MANY, 'YCharNotificationTexts', 'ownerID'),
			'charNotifications' => array(self::HAS_MANY, 'YCharNotifications', 'ownerID'),
			'charResearches' => array(self::HAS_MANY, 'YCharResearch', 'ownerID'),
			'charSkillInTraining' => array(self::HAS_ONE, 'YCharSkillInTraining', 'ownerID'),
			'charSkillQueues' => array(self::HAS_MANY, 'YCharSkillQueue', 'ownerID'),
			'charSkills' => array(self::HAS_MANY, 'YCharSkills', 'ownerID'),
			'charStandingsFromAgents' => array(self::HAS_MANY, 'YCharStandingsFromAgents', 'ownerID'),
			'charStandingsFromFactions' => array(self::HAS_MANY, 'YCharStandingsFromFactions', 'ownerID'),
			'charStandingsFromNPCCorporations' => array(self::HAS_MANY, 'YCharStandingsFromNPCCorporations', 'ownerID'),
			'charWalletJournals' => array(self::HAS_MANY, 'YCharWalletJournal', 'ownerID'),
			'charWalletTransactions' => array(self::HAS_MANY, 'YCharWalletTransactions', 'ownerID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'activeAPIMask' => 'Active Apimask',
			'characterID' => 'Character',
			'characterName' => 'Character Name',
			'isActive' => 'Is Active',
			'proxy' => 'Proxy',
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

		$criteria->compare('activeAPIMask',$this->activeAPIMask,true);
		$criteria->compare('characterID',$this->characterID,true);
		$criteria->compare('characterName',$this->characterName,true);
		$criteria->compare('isActive',$this->isActive);
		$criteria->compare('proxy',$this->proxy,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}