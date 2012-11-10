<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;

	const ERROR_EMAIL_INVALID=3;
	const ERROR_STATUS_NOTACTIV=4;
	const ERROR_STATUS_BAN=5;

	public function authenticate()
	{
		// username = email
		$user = User::model()->notsafe()->findByAttributes(array('email' => $this->username));
				
		if($user === null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if(Yii::app()->getModule('user')->encrypting($this->password) !== $user->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else if($user->status == 0 && Yii::app()->getModule('user')->loginNotActiv == false)
			$this->errorCode=self::ERROR_STATUS_NOTACTIV;
		else if($user->status==-1)
			$this->errorCode=self::ERROR_STATUS_BAN;
		else {
			$this->username  = $user->email;
			$this->_id       = $user->id;
			$this->errorCode = self::ERROR_NONE;
		}
		return !$this->errorCode;
	}
    
    /**
    * @return integer the ID of the user record
    */
	public function getId()
	{
		return $this->_id;
	}
}