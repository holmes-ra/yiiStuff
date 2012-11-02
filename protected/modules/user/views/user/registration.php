<?php

$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Registration");
$this->breadcrumbs=array(
	UserModule::t("Registration"),
);
?>

<h1><?php echo UserModule::t("Registration"); ?></h1>

<?php if (Yii::app()->user->hasFlash('registration')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('registration'); ?>
</div>
<?php else: ?>

<div class="form">
	<?php 
/*
$key = new YUtilRegisteredKey;
$key->keyID = 660736;
$key->vCode = 'qrE9lZI3nsoJptuLzE5jy0ScVFFxKsSrPVW88Fwr74mKBo7gNkcPIkuXPT0SY6hh';
$key->userID = 25;
echo var_dump($key->validate());

 doesn't work for existing characters...
$char_array = array();

foreach ($key->characters AS $character){
	echo $character->characterID."<br>";
	if (($char = YAccountCharacters::model()->findByPk($character->characterID)) === null){
		$char = new YAccountCharacters;
		$char->characterID     = $character->characterID;
		$char->characterName   = $character->characterName;
		$char->corporationID   = $character->corporationID;
		$char->corporationName = $character->corporationName;
	}
	array_push($char_array, $char);
}
$key->accountCharacters = $char_array;
//print_r($key->accountCharacters);


$result = $key->withRelated->save(false, array('accountCharacters'));
echo var_dump($result);
*/

	$form=$this->beginWidget('CActiveForm', array(
			'enableClientValidation'=>true,
			'id'=>'registration-form',
			'enableAjaxValidation'=>true,
		)); ?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary(array($user, $api)); ?>



	<div class="row">
	<?php echo $form->labelEx($user, 'email'); ?>
	<?php echo $form->textField($user, 'email'); ?>
	<?php echo $form->error($user, 'email'); ?>
	</div>

	<div class="row">
	<?php echo $form->labelEx($user, 'password'); ?>
	<?php echo $form->passwordField($user, 'password'); ?>
	<?php echo $form->error($user, 'password'); ?>
	</div>

	<div class="row">
	<?php echo $form->labelEx($user, 'verifyPassword'); ?>
	<?php echo $form->passwordField($user, 'verifyPassword'); ?>
	<?php echo $form->error($user, 'verifyPassword'); ?>
	</div>

	<div class="row">
	<?php echo $form->labelEx($api, 'keyID'); ?>
	<?php echo $form->textField($api, 'keyID'); ?>
	<?php echo $form->error($api, 'keyID'); ?>
	</div>

	<div class="row">
	<?php echo $form->labelEx($api, 'vCode'); ?>
	<?php echo $form->textField($api, 'vCode'); ?>
	<?php echo $form->error($api, 'vCode'); ?>
	</div>
	<div class="row submit">
		<?php echo CHtml::submitButton(UserModule::t("Register")); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
<?php endif; ?>
