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

$columns = array(
        array('name'=>'Status', 'value' => "print('OK')"),
        array('name'=>'characterName', 'header'=>'Character'),
        array('name'=>'corporationName', 'header'=>'Corporation'),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 0px'),
            'template' => '<span class="right">{activate}{default}{enable}{disable}{delete}</span>',
            'buttons'=>array
            (
                'delete' => array
                (
                    'label' => 'Delete',
                    'url'   => 'Yii::app()->createUrl("user/profile/deleteChar", array("id"=>$data->characterID))',
                    'visible' => '$data->registered !== null'
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
                    'visible' => '$data->registered === null'
                ),      
                'default' => array
                (
                    'label' => 'Make Default',
                    'icon'  => 'user',
                    'url'   => 'Yii::app()->createUrl("user/profile/defaultChar", array("id"=>$data->characterID))',
                    'visible' => '$data->registered !== null', // @todo: && $User->defaultChar != $data->characterID'
                    'options'=>array(  
                        'ajax'=>$ajaxOptions,
                    ),
                ),      
            ),
        ),
    );

$this->widget('bootstrap.widgets.TbExtendedGridView', array(
    'id'=>'char-grid',
    'type'=>'striped bordered condensed',
    'dataProvider'=>$charDataProvider,
    'template'=>"{items}",
    'columns'=>array_merge(array(
        array(
            'class'=>'bootstrap.widgets.TbRelationalColumn',
            'name' => 'Access',
            'url'  => Yii::app()->createUrl("user/profile/access", array("type"=>"char")),
            'value'=> '"Show Access"',
        )
    ),$columns),
));
?>