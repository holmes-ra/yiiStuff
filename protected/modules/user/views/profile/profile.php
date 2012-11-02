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
<script>
        function allFine(data) {
                // display data returned from action
                $("#results").html(data);
                // refresh your grid
                $.fn.yiiGridView.update('keys-grid');
        }
</script>

<?php  


/*
 $this->widget('ext.CEditableGridView', array(
        'dataProvider'=>$keysDataProvider,
        'showQuickBar'=>'true',
        'quickCreateAction'=>'AjaxAddApi', // will be actionQuickCreate()
        'columns'=>array(
                array('name'=>'keyID', 'header'=>'Key'),
                array('name'=>'vCode', 'header'=>'vCode'),
                array('name'=>'activeAPIMask', 'header'=>'Access Mask'),
                array('name'=>'isActive', 'header'=>'Active'),
      )));*/

        $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'keys-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$keysDataProvider,
            'template'=>"{items}",
            'columns'=>array(
                array('name'=>'keyID', 'header'=>'Key'),
                array('name'=>'vCode', 'header'=>'vCode'),
                array('name'=>'activeAPIMask', 'header'=>'Access Mask'),
                array('name'=>'isActive', 'header'=>'Active'),
                /*array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 50px'),
                ),*/
            ),
        ));
/*
$button = $this->widget('bootstrap.widgets.TbButton', array(
    'buttonType' => 'ajaxSubmit',
    'label'=>'Add API',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'mini', // null, 'large', 'small' or 'mini'
));
*/

        ?>

<script type="text/javascript">
// here is the magic
function addApi()
{
        <?php
         echo CHtml::ajax(array(
            'url'=>array('profile/addapi'),
            'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'error'=>"function(request,error) { console.log(request, error); }",
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
                    $('#dialogApi div.divForForm').html(data.div);
                          // Here is the trick: on submit-> once again this function!
                    $('#dialogApi div.divForForm form').submit(addApi);
                }
                else
                {
                    $('#dialogApi div.divForForm').html(data.div);
                    $.fn.yiiGridView.update('keys-grid');
                    setTimeout(\"$('#dialogApi').dialog('close') \",3000);
                }
 
            } ",
            ));


 ?>
}
 
</script>

<?php echo CHtml::link('Add New API', "addapi"  // the link for open the dialog
    /* todo: fix ajax dialog stuff
    , array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        'onclick'=>"{addApi(); $('#dialogApi').dialog('open');}") 
    */
        );?>

<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'dialogApi',
    'options'=>array(
        'title'=>Yii::t('api','Add API'),
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'300',
        'height'=>'auto',
    ),
 )); ?>
 <div class="divForForm">
</div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>

<!--


<?php echo CHtml::ajaxLink(Yii::t('api',' Add API'),$this->createUrl('profile/addapi'),array(
        'onclick'=>'$("#apiDialog").dialog("open"); return false;',
        'update'=>'#apiDialog'
        ),array('id'=>'showApiDialog'));?>

<script>
    $(document).ready(function(e) {
       var $table = $('#keys-grid table tbody');
       $('.add-row').click(function(e) {
         //If it is odd then the next one should be even.. 
         var number = (($table.find('tr').size())%2 === 0)?'odd':'even';
         var html = '<tr class="'+number+'"><td><input name="Form[keyID]" type="text" style="width:50%;" /></td><td><input name="Form[vCode]" type="text" style="width:50%;" /></td><td colspan="2"><?php $button; ?></td></tr></form>';
         $table.append(html);
         return false;
       });
    });
    
</script>

-->
<h3>Characters</h3>
<p>The table below lists the characters associated with your API keys. to start pulling character data, 
    they must be enabled manually: simply toggle the enabled column and you're set. You can also customize 
    which data is pulled for specific characters. please ntoe that once enabled, it may take up to 15 minutes 
    to pull data. if you disable a character, the data still remains in the database, however it is no longer 
    updated nor can it be accessed. To delete character data, you must delete character from UtilRegisteredCharacters.</p>

        <?php
        $this->widget('bootstrap.widgets.TbGridView', array(
            'type'=>'striped bordered condensed',
            'dataProvider'=>$charDataProvider,
            'template'=>"{items}",
            'columns'=>array(
                array('name'=>'characterName', 'header'=>'Character'),
                array('name'=>'corporationName', 'header'=>'Corporation'),
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 50px'),
                ),
            ),
        ));
?><h4>fdas</h4>
<!--
<table class="dataGrid">
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('username')); ?>
</th>
    <td><?php echo CHtml::encode($model->email); ?>
</td>
</tr><pre>
<?php 

/*
		if ($profileFields) {
			foreach($profileFields as $field) {
			?>
<tr>
	<th class="label"><?php echo CHtml::encode(UserModule::t($field->title)); ?>
</th>
    <td><?php echo (
    	($field->widgetView($profile))
    	? $field->widgetView($profile) : CHtml::encode((($field->range) ?Profile::range($field->range,$profile->getAttribute($field->varname)):$profile->getAttribute($field->varname)))); ?>
</td>
</tr>
			<?php
			}//$profile->getAttribute($field->varname)
		}*/
?>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('email')); ?>
</th>
    <td><?php echo CHtml::encode($model->email); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('createtime')); ?>
</th>
    <td><?php echo date("d.m.Y H:i:s",$model->createtime); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('lastvisit')); ?>
</th>
    <td><?php echo date("d.m.Y H:i:s",$model->lastvisit); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('status')); ?>
</th>
    <td><?php echo CHtml::encode(User::itemAlias("UserStatus",$model->status));
    ?>
</td>
</tr>
</table>
-->
