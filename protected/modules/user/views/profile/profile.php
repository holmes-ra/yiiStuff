<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Settings");
$this->breadcrumbs=array(
	UserModule::t("Settings"),
);?><h2><?php echo UserModule::t('User Settings'); ?></h2>
<?php echo $this->renderPartial('menu'); ?>

<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>


<h3>API Keys</h3>
<p>The table below lists the API keys associated with your account. Once added, they are automatically 
    enabled for use; however, to pull character data you must enable the characters manually.</p>
<?php 
	// this widget will show alerts when character actions are called without AJAX
	$this->widget('bootstrap.widgets.TbAlert', array(
	'block'=>true, // display a larger alert block?
	'fade'=>true, // use transitions?
	'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
	'htmlOptions'=>array('id'=>'keyFlash', 'style'=>'margin-bottom:-20px;'),
));
?>
<?php $this->renderPartial('_keyGrid', array('keysDataProvider'=>$keysDataProvider)); ?> 

<h3>Characters</h3>
<p>The table below lists the characters associated with your API keys. to start pulling character data, 
    they must be enabled manually: simply toggle the enabled column and you're set. You can also customize 
    which data is pulled for specific characters. please ntoe that once enabled, it may take up to 15 minutes 
    to pull data. if you disable a character, the data still remains in the database, however it is no longer 
    updated nor can it be accessed. To delete character data, you must delete character from UtilRegisteredCharacters.</p>
    <?php echo CHtml::link('Edit Access', "",  // the link for open the dialog
    array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{editAccess(); $('#accessDialog').dialog('open');}"));?>
 
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'accessDialog',
    'options'=>array(
        'title'=>'Access',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>1000,
        'height'=>670,
    ),
));?>
<div class="divForForm"></div>
 
<?php $this->endWidget();?>

<?php 
	// this widget will show alerts when character actions are called without AJAX
	$this->widget('bootstrap.widgets.TbAlert', array(
	'block'=>true, // display a larger alert block?
	'fade'=>true, // use transitions?
	'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
	'htmlOptions'=>array('id'=>'charFlash', 'style'=>'margin-bottom:-20px;'),
));
?>

<?php $this->renderPartial('_charGrid', array('charDataProvider'=>$charDataProvider, 'user'=>$model)); ?> 
 
<script type="text/javascript">
// here is the magic
function editAccess()
{
    <?php echo CHtml::ajax(array(
            'url'=>Yii::app()->createUrl("user/profile/access", array("id"=>1882610540)),
            'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
                    $('#accessDialog div.divForForm').html(data.div);
                          // Here is the trick: on submit-> once again this function!
                    $('#accessDialog div.divForForm form').submit(editAccess);
                }
                else
                {
                    $('#accessDialog div.divForForm').html(data.div);
                    setTimeout(\"$('#accessDialog').dialog('close') \",3000);
                }
 
            } ",
            ))?>;
    return false; 
 
}
 
</script>