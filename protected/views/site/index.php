<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>
<pre>
<?php 


// wallet transactions, account balance, skill queue = 4456449



$roles = 4456449;
var_dump($roles & 16384);

echo log(134217728, 2);
$digits='01';
$bits='';
bcscale(0);
while ($roles) {
	$bits.=$digits[bcmod($roles,2)];
	$roles=bcdiv($roles,2);
};
$bitRoles = str_pad($bits, 64, '0', STR_PAD_RIGHT);
echo $bitRoles;

//$key = new YUtilRegisteredKey; 
//$key = new Pheal("1408234", "lPFzZCxrBLyJFQDpYyDGO0gGPJVZJUcVYFfW5Yyk4npOxUGZpMcwpW8ak8deikxe");
//$users=User::model()->with('characters')->findByPk(Yii::app()->user->id);

/*
$keys=YUtilRegisteredKey::model()->with('accountCharacters')->findAll();
foreach ($keys AS $key) {
	echo "<hr><h2>".$key->keyID."</h2>";
	foreach ($key->accountCharacters AS $character) {
			echo $character->characterName."<br>";
	}
}
*/


//print_r(Yii::app()->user->id);
/*
foreach ($users as $user) {
	print "<hr><h2>User ".$user->email."</h2><h3>keys:</h3>";
	foreach ($user->keys as $key) {
		print $key->keyID.":".$key->vCode."\n";
	}
}
*/



	
		/*

				if ($user->validate()) {
					
					$soucePassword        = $user->password;
					$user->activkey       = UserModule::encrypting(microtime().$user->password);
					$user->password       = UserModule::encrypting($user->password);
					$user->verifyPassword = UserModule::encrypting($user->verifyPassword);
					$user->createtime     = time();
					$user->lastvisit      = ((Yii::app()->controller->module->loginNotActiv||(Yii::app()->controller->module->activeAfterRegister&&Yii::app()->controller->module->sendActivationMail==false))&&Yii::app()->controller->module->autoLogin)?time():0;
					$user->superuser      = 0;
					$user->status         = ((Yii::app()->controller->module->activeAfterRegister) ? User::STATUS_ACTIVE : User::STATUS_NOACTIVE);
					
					if ($user->save(false)) {
						
						if (Yii::app()->controller->module->sendActivationMail) {
							$activation_url = $this->createAbsoluteUrl('/user/activation/activation', array("activkey" => $user->activkey, "email" => $user->email));
							UserModule::sendMail($user->email, UserModule::t("You registered from {site_name}", array('{site_name}'=>Yii::app()->name)), UserModule::t("Please activate you account go to {activation_url}", array('{activation_url}'=>$activation_url)));
						}
						
						
						if ((Yii::app()->controller->module->loginNotActiv || (
								Yii::app()->controller->module->activeAfterRegister &&
								Yii::app()->controller->module->sendActivationMail == false)
							) && Yii::app()->controller->module->autoLogin) {
							$identity = new UserIdentity($user->email, $soucePassword);
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
		*/	
			//$this->render('/user/registration', array('user'=>$user));
		
	


?>
</pre>

<h3>ToDo</h3>

<ul>
	<li>Finish basic registration: email, api keys, no character. Create relations on the way. Make sure key anc vcode validation happens even though user class might not allow for it</li>
	<li>Find out how to fetch data from API - keep 1 registration controller / class / whatever</li>
	<li>Apply fetch data to reg form</li>
	<li>prettyfy</li>
	<li>complete ajaxy reg box thing (make reg form widget and include?)</li>
	<li>work on profile, including selecting which characters to pull from and specific APIs</li>
</ul>


<p>For more details on how to further develop this application, please read
the <a href="http://www.yiiframework.com/doc/">documentation</a>.
Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
should you have any questions.</p>
