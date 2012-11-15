<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Access");
$this->breadcrumbs=array(
	UserModule::t("Access"),
);?><h2><?php echo UserModule::t('Access'); ?></h2>
<?php echo $this->renderPartial('menu'); ?>

<?php

$this->widget('bootstrap.widgets.TbAlert', array(
	'block'=>true, // display a larger alert block?
	'fade'=>true, // use transitions?
	'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
	'htmlOptions'=>array('id'=>'charFlash', 'style'=>'margin-bottom:-20px;'),
));

$this->renderPartial('_access', array(
    'char'          => $char,
    'dataProvider'  => $dataProvider,
    'availableMask' => YUtilRegisteredCharacter::model()->getAvailableBitmask(Yii::app()->user->id, $char->characterID),
));

