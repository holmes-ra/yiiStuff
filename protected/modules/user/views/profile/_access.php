<?php
//print_r($model);
//exit;

//$dataProvider->setPagination(false);


$form=$this->beginWidget('CActiveForm', array(
        'id'=>'campaign-search-form',
        'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype' => 'multipart/form-data')
));

$dataProvider->setPagination(false);
$this->widget('bootstrap.widgets.TbGridView', array(
    'baseScriptUrl' => Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('ext.assets.js')).'/gridview',
    'dataProvider'=>$dataProvider,
    'id'=>'access-grid',
    'type'=>'striped bordered condensed',
    'template'=>"{items}",
    'selectableRows'=>2,
    'rowCssClassExpression' => '('.$availableMask.' & $data->mask) ? null : "disabled"',
    'columns'=>array(
        array('header'=>'API Call', 'value' => '$data->api; $this->widget("bootstrap.widgets.TbExtendedTooltip", array("key" => "test.tooltip2", "editable"=>false));'),
        array('name'=>'description', 'header'=>'Description'),
        array('name'=>'mask', 'header'=>'Mask'),
        array(
            'checked' => '('.$char[0]->activeAPIMask.' & '.$availableMask.' & $data->mask)',
            'value'=>'$data->mask',
            'class'=>'ext.ECheckBoxColumn',
            'disabled'=>'!('.$availableMask.' & $data->mask)',
            'checkBoxHtmlOptions'=>array('name'=>'mask[]'),
        ),
    ),
));

//$this->widget('bootstrap.widgets.TbButtonGroup', array(
 //   'buttons'=>array(
   //     array('buttonType'=>'submit', 'label' => 'Edit','type' => 'primary'),
 //   ),
//));
echo CHtml::ajaxSubmitButton("go");

$this->endWidget();


 
?>