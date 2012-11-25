<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Delete Character");
$this->breadcrumbs=array(
	UserModule::t("Delete Character"),
);?><h2><?php echo UserModule::t('Delete'); ?></h2>
<?php echo $this->renderPartial('menu');

$this->renderPartial('_view/_deleteChar', array('char' => $char,));
?>