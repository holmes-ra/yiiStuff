<?php
/**
 * RegistrationForm class.
 * RegistrationForm is the data structure for keeping
 * user registration form data. It is used by the 'registration' action of 'UserController'.
 */
class RegistrationForm extends User {
	public $verifyPassword;
	public $verifyCode;
	
	public function rules() {
		$rules = array(
			array('password, verifyPassword, email', 'required'),
			array('password', 'length', 'max'=>128, 'min' => 6,'message' => UserModule::t("Incorrect password (minimal length 6 symbols).")),
			array('email', 'email'),
			array('email', 'unique', 'message' => UserModule::t("This email address already exists.")),
			array('verifyPassword', 'compare', 'compareAttribute'=>'password', 'message' => UserModule::t("Passwords do not match.")),
		);

		return $rules;

	}
	
}