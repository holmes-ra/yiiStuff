<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Settings");
$this->breadcrumbs=array(
	UserModule::t("Settings"),
);
?><h2><?php echo UserModule::t('User Settings'); ?></h2>
<?php echo $this->renderPartial('menu'); ?>

<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>

<h3>Add API</h3>


<?php echo $this->renderPartial('_formDialog', array('model'=>$model)); ?>