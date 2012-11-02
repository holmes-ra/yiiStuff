<?php
/**
 * C:\Users\Ryan\AppData\Roaming\Sublime Text 2\Packages/PhpTidy/phptidy-sublime-buffer.php
 *
 * @package default
 */


class RegistrationController extends Controller
{
	public $defaultAction = 'registration';



	/**
	 * Declares class-based actions.
	 *
	 * @return unknown
	 */
	public function actions() {
		return (isset($_POST['ajax']) && $_POST['ajax']==='registration-form')?array():array(
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
		);
	}


	/**
	 * Registration user
	 */
	
	public function actionRegistration() {
		$user = new RegistrationForm; //User user, but with registration rules
		$api  = new YUtilRegisteredKey;


		// ajax validator
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'registration-form') {
			echo CActiveForm::validate(array($user, $api));
			Yii::app()->end();
		}

		if (Yii::app()->user->id) {
			$this->redirect(Yii::app()->controller->module->profileUrl);
		} else {
			if (isset($_POST['RegistrationForm'])) {

				$user->attributes = $_POST['RegistrationForm'];
				$api->attributes  = $_POST['YUtilRegisteredKey'];

				$user->keys = array($api);

				if ($user->withRelated->validate(array('keys'))) {
					
					$soucePassword        = $user->password;
					$user->activkey       = UserModule::encrypting(microtime().$user->password);
					$user->password       = UserModule::encrypting($user->password);
					$user->verifyPassword = UserModule::encrypting($user->verifyPassword);
					$user->createtime     = time();
					$user->lastvisit      = ((Yii::app()->controller->module->loginNotActiv||(Yii::app()->controller->module->activeAfterRegister&&Yii::app()->controller->module->sendActivationMail==false))&&Yii::app()->controller->module->autoLogin)?time():0;
					$user->superuser      = 0;
					$user->status         = ((Yii::app()->controller->module->activeAfterRegister) ? User::STATUS_ACTIVE : User::STATUS_NOACTIVE);
					$api->isActive        = 1;

					if ($user->withRelated->save(false, array('keys'=>array('accountCharacters')))) {
						// todo: expand on withRelated class to include withRelated saves within withrelated saves
						//$api->withRelated->save(false, array('accountCharacters')); // this saves character data (couldn't get it to save with above ;_;)
						

						if (Yii::app()->controller->module->sendActivationMail) {
							$activation_url = $this->createAbsoluteUrl('/user/activation/activation', array("activkey" => $user->activkey, "email" => $user->email));
							UserModule::sendMail($user->email, UserModule::t("You registered from {site_name}", array('{site_name}'=>Yii::app()->name)), UserModule::t("Please activate you account go to {activation_url}", array('{activation_url}'=>$activation_url)));
						}
						
						
						if ((Yii::app()->controller->module->loginNotActiv||(Yii::app()->controller->module->activeAfterRegister&&Yii::app()->controller->module->sendActivationMail==false))&&Yii::app()->controller->module->autoLogin) {
							$identity=new UserIdentity($user->email, $soucePassword);
							$identity->authenticate();
							Yii::app()->user->login($identity, 0);
							$this->redirect(Yii::app()->controller->module->returnUrl);
						} else {
							if (!Yii::app()->controller->module->activeAfterRegister&&!Yii::app()->controller->module->sendActivationMail) {
								Yii::app()->user->setFlash('registration', UserModule::t("Thank you for your registration. Contact Admin to activate your account."));
							} elseif (Yii::app()->controller->module->activeAfterRegister&&Yii::app()->controller->module->sendActivationMail==false) {
								Yii::app()->user->setFlash('registration', UserModule::t("Thank you for your registration. Please {{login}}.", array('{{login}}'=>CHtml::link(UserModule::t('Login'), Yii::app()->controller->module->loginUrl))));
							} elseif (Yii::app()->controller->module->loginNotActiv) {
								Yii::app()->user->setFlash('registration', UserModule::t("Thank you for your registration. Please check your email or login."));
							} else {
								Yii::app()->user->setFlash('registration', UserModule::t("Thank you for your registration. Please check your email."));
							}
							$this->refresh();
						}
					}
				} 
			}
			$this->render('/user/registration', array('user'=>$user, 'api'=>$api));
		}
	}
}
