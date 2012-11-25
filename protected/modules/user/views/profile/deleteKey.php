<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Delete Key");
$this->breadcrumbs=array(
	UserModule::t("Delete Key"),
);?><h2><?php echo UserModule::t('Delete Key'); ?></h2>
<?php echo $this->renderPartial('menu');

$this->renderPartial('_view/_deleteKey', array('key' => $key,));
?>