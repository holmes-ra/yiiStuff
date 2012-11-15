<?php

$this->widget('ext.EUpdateDialog.EUpdateDialog', array(
    'dialogOptions' => array(
        'title' => 'API Access',
        'autoOpen' => false,
        'modal' => true,
        'width' =>350,
        'height' => 400,
        'buttons' => array("Submit"=>'js:function(){
            updateDialog.submit();
        }'),
        'close' => "js:function(e){
            $(document).off('click.yiiGridView', '#access-grid table > tbody > tr');
        }",  
    ))
);


$ajaxOptions = array(
    'url'=>"js:$(this).attr('href')", 
    'success'=> "js:function(data){
        $('#charFlash').html(data).fadeIn().animate({opacity: 1.0}, 3000).fadeOut('slow');
        $.fn.yiiGridView.update('char-grid'); }"  
);

$columns = array(
        array('name'=>'characterName', 'header'=>'Character'),
        array('name'=>'corporationName', 'header'=>'Corporation'),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 60px;'),
            'template' => '<span class="right">{update}{activate}{default}{enable}{disable}{delete}</span>',
            'buttons'=>array
            (
                'update' => array
                (
                    'label'   => 'Update Access',
                    'url'     => 'Yii::app()->createUrl("user/profile/access", array("id"=>$data->characterID))',
                    'visible' => '$data->registered !== null',
                    'click' => 'updateDialogOpen',
                    'options' => array(
                        'data-update-dialog-title' => Yii::t( 'app', 'Update Access' ),
                    ),
                ),
                'delete' => array
                (
                    'label' => 'Delete',
                    'url'   => 'Yii::app()->createUrl("user/profile/deleteChar", array("id"=>$data->characterID))',
                    'visible' => '$data->registered !== null',
                    'options'=>array(  
                        'ajax'=>$ajaxOptions,
                    ),
                ),
                'disable' => array
                (
                    'label' => 'Disable',
                    'icon'  => 'minus',
                    'url'   => 'Yii::app()->createUrl("user/profile/disableChar", array("id"=>$data->characterID))',
                    'visible' => '$data->registered !== null && $data->registered->isActive == 1',
                    'options'=>array(  
                        'ajax'=>$ajaxOptions,
                    ),
                ),
                'enable' => array
                (
                    'label' => 'Enable',
                    'icon'  => 'plus',
                    'url'   => 'Yii::app()->createUrl("user/profile/enableChar", array("id"=>$data->characterID))',
                    'visible' => '$data->registered !== null && $data->registered->isActive == 0',
                    'options'=>array(  
                        'ajax'=>$ajaxOptions,
                    ),
                ),                        
                'activate' => array
                (
                    'label' => 'Activate',
                    'icon'  => 'ok',
                    'url'   => 'Yii::app()->createUrl("user/profile/activateChar", array("id"=>$data->characterID))',
                    'visible' => '$data->registered === null',
                    'options'=>array(  
                        'ajax'=>$ajaxOptions,
                    ),
                ),      
                'default' => array
                (
                    'label' => 'Make Default',
                    'icon'  => 'user',
                    'url'   => 'Yii::app()->createUrl("user/profile/defaultChar", array("id"=>$data->characterID))',
                    'visible' => '$data->registered !== null && '.$user->defaultChar.' != $data->characterID',
                    'options'=>array(  
                        'ajax'=>$ajaxOptions,
                    ),
                ),      
            ),
        ),
    );

$this->widget('bootstrap.widgets.TbGridView', array(
    'baseScriptUrl' => Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('ext.assets.js')).'/gridview',
    'id'=>'char-grid',
    'type'=>'striped bordered condensed',
    'dataProvider'=>$charDataProvider,
    'template'=>"{items}",
    'selectableRows' => 0,
    'columns'=>$columns)
);

?>