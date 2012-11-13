<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'accessDialog',

    'options'=>array(
        // .off() is to remove the event handler 
        'close' => "js:function(ev, ui) {
            $(document).off('click.yiiGridView', '#access-grid table > tbody > tr'); }",
        'title'=>'Access',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>350,
        'height'=>400,
        'show'=> array('effect'=>"fade"),
        'hide'=>array('effect'=>"fade"),

    ),
));?>
<div class="divForForm"></div>
 
<?php $this->endWidget();?>

<?php

        // todo: for the delete button, make sure ajax does it, but if not direct to a seperate confirmation page.
        //       This will prevent people from linking the deleteChar url and deleting characters on a whim
        //       Also, make sure the proper permissions are put in place (need to be the owner of key!)

$ajaxOptions = array(
    'url'=>"js:$(this).attr('href')", 
    'success'=> "js:function(data){
        $('#charFlash').html(data).fadeIn().animate({opacity: 1.0}, 3000).fadeOut('slow');
        $.fn.yiiGridView.update('char-grid'); }"  
);
$ajax = CHtml::ajax(array(
            'url'=>"js:$(this).attr('href')",
            'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data) {
                if (data.status == 'failure')
                {
                    $('#accessDialog div.divForForm').html(data.div);
                          // Here is the trick: on submit-> once again this function!
                    $('#accessDialog div.divForForm form').submit(this);
                }
                else
                {
                    $('#accessDialog div.divForForm').html(data.div);
                    setTimeout(\"$('#accessDialog').dialog('close') \",3000);
                }
 
            } ",
            ));

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
                    'click'   => "function(e) {
                        e.preventDefault();
                        console.log('click');".$ajax."
                        $('#accessDialog').dialog('open');
                    }",
                   // 'options' => 
                    /*array(
                        'ajax' => array(
                            'url'=>"js:$(this).attr('href')",
                            'data'=> "js:$(this).serialize()",
                            'type'=>'post',
                            'dataType'=>'json',
                            'success'=>"function(data) {
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
                            ))*/
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
    'id'=>'char-grid',
    'type'=>'striped bordered condensed',
    'dataProvider'=>$charDataProvider,
    'template'=>"{items}",
    'selectableRows' => 0,
    'columns'=>$columns)
);

?>