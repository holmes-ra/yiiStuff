<?php
//print_r($model);
//exit;

//$dataProvider->setPagination(false);
$ajaxOptions = array(
   // 'url'=>"js:$(this).attr('href')", 
    'success'=> "js:function(data){
        $('#accessFlash').html(data).fadeIn().animate({opacity: 1.0}, 3000).fadeOut('slow');
         }"  
);


$this->widget('bootstrap.widgets.TbAlert', array(
    'block'=>true, // display a larger alert block?
    'fade'=>true, // use transitions?
    'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
    'htmlOptions'=>array('id'=>'accessFlash', 'style'=>'margin-bottom:-20px;'),
));

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
    'type'=>'striped bordered',
    'template'=>"{items}",
    'selectableRows'=>2,
    'rowCssClassExpression' => '('.$availableMask.' & $data->mask) ? null : "disabled hide"',
    'columns'=>array(
        array(
            'checked' => '('.$char[0]->activeAPIMask.' & '.$availableMask.' & $data->mask)',
            'value'=>'$data->mask',
            'class'=>'ext.ECheckBoxColumn',
            'disabled'=>'!('.$availableMask.' & $data->mask)',
            'checkBoxHtmlOptions'=>array('name'=>'mask[]'),
        ),
        array('header'=>'API Call', 'value' => '$data->api'),
    ),
));

/*
$this->widget('bootstrap.widgets.TbButtonGroup', array(
    'buttons'=>array(
        array('buttonType'=>'submit', 'label' => 'Edit','type' => 'primary', 'ajaxOptions' => $ajaxOptions),
    ),
));
/**/
echo CHtml::submitButton("Edit Access Mask");

$this->endWidget();


 
?>