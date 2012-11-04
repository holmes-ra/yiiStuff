<?php
/**
 * C:\Users\Ryan\AppData\Roaming\Sublime Text 2\Packages/PhpTidy/phptidy-sublime-buffer.php
 *
 * @package default
 */


class User extends CActiveRecord
{
	const STATUS_NOACTIVE=0;
	const STATUS_ACTIVE=1;
	const STATUS_BANED=-1;



	/**
	 * The followings are the available columns in table 'users':
	 *
	 * @var integer $id
	 * @var string $password
	 * @var string $email
	 * @var string $activkey
	 * @var integer $createtime
	 * @var integer $lastvisit
	 * @var integer $superuser
	 * @var integer $status
	 */

	/**
	 * Returns the static model of the specified AR class.
	 *
	 * @param unknown $className (optional)
	 * @return CActiveRecord the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}


	/**
	 *
	 *
	 * @return string the associated database table name
	 */
	public function tableName() {
		return Yii::app()->getModule('user')->tableUsers;
	}


	/**
	 *
	 *
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('password, email', 'required'),
				array('password', 'length', 'max'=>128, 'min' => 4, 'message' => UserModule::t("Incorrect password (minimal length 4 symbols).")),
				array('email', 'email'),
				array('email', 'unique', 'message' => UserModule::t("This user's email address already exists.")),
				//array('status', 'in', 'range'=>array(self::STATUS_NOACTIVE, self::STATUS_ACTIVE, self::STATUS_BANED)),
				//array('superuser', 'in', 'range'=>array(0, 1)),
				//array('email, createtime, lastvisit, superuser, status', 'required'),
				//array('createtime, lastvisit, superuser, status', 'numerical', 'integerOnly'=>true),

		);

		/* Do not need this yet, commented out for developing
		
		return ((Yii::app()->getModule('user')->isAdmin())?array(
				array('password, email', 'required'),
				array('password', 'length', 'max'=>128, 'min' => 4, 'message' => UserModule::t("Incorrect password (minimal length 4 symbols).")),
				array('email', 'email'),
				array('email', 'unique', 'message' => UserModule::t("This user's email address already exists.")),
				array('status', 'in', 'range'=>array(self::STATUS_NOACTIVE, self::STATUS_ACTIVE, self::STATUS_BANED)),
				array('superuser', 'in', 'range'=>array(0, 1)),
				array('email, createtime, lastvisit, superuser, status', 'required'),
				array('createtime, lastvisit, superuser, status', 'numerical', 'integerOnly'=>true),
			):((Yii::app()->user->id==$this->id)?array(
					array('email', 'required'),
					array('email', 'email'),
					array('email', 'unique', 'message' => UserModule::t("This user's email address already exists.")),
				):array()));
		*/
	}


	/**
	 *
	 *
	 * @return array relational rules.
	 */
	public function relations() {
		$relations = array(
			'profile'     => array(self::HAS_ONE, 'Profile', 'user_id'),
			'keys'        => array(self::HAS_MANY, 'YUtilRegisteredKey', 'userID'),
			'accountLink' => array(self::HAS_MANY, 'YAccountKeyBridge', array('keyID'=>'keyID'), 'through'=>'keys'),
			'characters'  => array(self::HAS_MANY, 'YAccountCharacters', array('characterID'=>'characterID'), 
					'together' => false, 'through' => 'accountLink', 'with'=>'registered', 'group' => 'characters.characterID'),
			'regCharacters'  => array(self::HAS_MANY, 'YUtilRegisteredCharacter', array('characterID'=>'characterID'), 
					'together' => false, 'through' => 'accountLink'),
		);
		//if (isset(Yii::app()->getModule('user')->relations)) $relations = array_merge($relations, Yii::app()->getModule('user')->relations);
		return $relations;
	}


	/**
	 *
	 *
	 * @return unknown
	 */
	public function behaviors() {
		return array(
			'withRelated'=>array(
				'class'=>'ext.withrelated.WithRelatedBehavior',
			),
		);
	}

	public static function keysDataProvider($user = null) {
		if ($user === null) { $user = Yii::app()->user->id; }
		$keys = User::model()->with('keys')->findByPk($user);
		return new CArrayDataProvider($keys->keys, array('keyField' => 'keyID'));
	}



	public static function charDataProvider($user = null) {
		if ($user === null) { $user = Yii::app()->user->id; }
		$characters    = User::model()->with('characters')->findByPk($user);
		return new CArrayDataProvider($characters->characters, array('keyField' => 'characterID'));
	}

	/**
	 *
	 *
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'password'       => UserModule::t("Password"),
			'verifyPassword' => UserModule::t("Verify Password"),
			'email'          => UserModule::t("Email"),
			'verifyCode'     => UserModule::t("Verification Code"),
			'id'             => UserModule::t("ID"),
			'activkey'       => UserModule::t("Activation Key"),
			'createtime'     => UserModule::t("Registration date"),
			'lastvisit'      => UserModule::t("Last visit"),
			'superuser'      => UserModule::t("Superuser"),
			'status'         => UserModule::t("Status"),
		);
	}


	/**
	 *
	 *
	 * @return unknown
	 */
	public function scopes() {
		return array(
			'active'=>array(
				'condition'=>'status='.self::STATUS_ACTIVE,
			),
			'notactvie'=>array(
				'condition'=>'status='.self::STATUS_NOACTIVE,
			),
			'banned'=>array(
				'condition'=>'status='.self::STATUS_BANED,
			),
			'superuser'=>array(
				'condition'=>'superuser=1',
			),
			'notsafe'=>array(
				'select' => 'id, password, email, activkey, createtime, lastvisit, superuser, status, defaultChar',
			),
		);
	}



	/**
	 *
	 *
	 * @return unknown
	 */
	public function defaultScope() {
		return array(
			'select' => 'id, email, createtime, lastvisit, superuser, status, defaultChar',
		);
	}



	/**
	 *
	 *
	 * @param unknown $type
	 * @param unknown $code (optional)
	 * @return unknown
	 */
	public static function itemAlias($type, $code=NULL) {
		$_items = array(
			'UserStatus' => array(
				self::STATUS_NOACTIVE => UserModule::t('Not active'),
				self::STATUS_ACTIVE => UserModule::t('Active'),
				self::STATUS_BANED => UserModule::t('Banned'),
			),
			'AdminStatus' => array(
				'0' => UserModule::t('No'),
				'1' => UserModule::t('Yes'),
			),
		);
		if (isset($code))
			return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
		else
			return isset($_items[$type]) ? $_items[$type] : false;
	}


}
