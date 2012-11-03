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


<h3>API Keys</h3>
<p>The table below lists the API keys associated with your account. Once added, they are automatically 
    enabled for use; however, to pull character data you must enable the characters manually.</p>
<!--  CODE TO INSERT NEW PLAYER BEGINS -->
<div id='keys-results'></div>

<?php $this->renderPartial('_keyGrid', array('keysDataProvider'=>$keysDataProvider)); ?> 

<h3>Characters</h3>
<p>The table below lists the characters associated with your API keys. to start pulling character data, 
    they must be enabled manually: simply toggle the enabled column and you're set. You can also customize 
    which data is pulled for specific characters. please ntoe that once enabled, it may take up to 15 minutes 
    to pull data. if you disable a character, the data still remains in the database, however it is no longer 
    updated nor can it be accessed. To delete character data, you must delete character from UtilRegisteredCharacters.</p>

<?php $this->renderPartial('_charGrid', array('charDataProvider'=>$charDataProvider)); ?> 