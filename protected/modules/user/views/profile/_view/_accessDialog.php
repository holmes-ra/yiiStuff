<?php

/**
 * This view is used when rendering via AJAX into the dialog used in user's profile.
 * It includes a short-form API call list, as opossed to complete list with descriptions, etc
 * 
 * @todo include descrition via non-obtrusive popout/over/tooltip 
 */

$this->renderPartial('_view/_accessDescription', array('char'=>$char));

$form=$this->beginWidget('CActiveForm', array(
        'id'=>'access-form',
        'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype' => 'multipart/form-data')
));

$dataProvider->setPagination(false);
$this->widget('bootstrap.widgets.TbGridView', array(
    'baseScriptUrl' => Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('ext.assets.js')).'/gridview',
    'dataProvider'=>$dataProvider,
    'id'=>'access-grid',
    'type'=>'striped bordered',
    'template'=>"{items}",
    'selectableRows'=>2,
    'columns'=>array(
        array(
            'checked' => '('.$char->activeAPIMask.' & '.$availableMask.' & $data->mask)',
            'value'=>'$data->mask',
            'class'=>'ext.ECheckBoxColumn',
            'disabled'=>'!('.$availableMask.' & $data->mask)',
            'checkBoxHtmlOptions'=>array('name'=>'mask[]'),
        ),
        array('header'=>'API Call', 'value' => '$data->api'),
    ),
));

$this->endWidget();
?>


    


