<?php
/**
 * UserChangePassword class.
 * 
 * UserChangePassword is the data structure for keeping
 * user change password form data. It is used by the 'changepassword' action of 'UserController'.
 */
class UserChangePassword extends CFormModel {
	public $password;
	public $verifyPassword;
	public $oldpass;

	
	public function rules() {
		return array(
			array('password, verifyPassword', 'required'),
			array('password', 'length', 'max'=>128, 'min' => 4,'message' => UserModule::t("Incorrect password (minimal length 4 symbols).")),
			array('verifyPassword', 'compare', 'compareAttribute'=>'password', 'message' => UserModule::t("Passwords do not match.")),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'oldpass' =>UserModule::t("Old Password"),
			'password'=>UserModule::t("Password"),
			'verifyPassword'=>UserModule::t("Confirm Password"),
		);
	}
} 