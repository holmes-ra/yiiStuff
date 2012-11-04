<div id='keyresponse'></div>
<?php  
        $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'keys-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$keysDataProvider,
            'template'=>"{items}",
            'columns'=>array(
                array('name'=>'Status', 'value'=>'$data->isActive ? "Enabled" : "Disabled"'),
                array('name'=>'keyID', 'header'=>'Key'),
                array('name'=>'vCode', 'header'=>'vCode'),
                array('name'=>'activeAPIMask', 'header'=>'Access Mask'),
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>"<span class='right'>{enable}{disable}{delete}</span>",
                     'buttons' => array (
                        'delete' => array
                        (
                            'label' => 'Delete',
                            'url'   => 'Yii::app()->createUrl("user/profile/deleteKey", array("id"=>$data->keyID))',
                        ),
                        'disable' => array
                        (
                            'label' => 'Disable',
                            'icon'  => 'minus',
                            'url'   => 'Yii::app()->createUrl("user/profile/disableKey", array("id"=>$data->keyID))',
                            'visible' => '$data->isActive == 1',
                            'options'=>array(  
                                'ajax'=>array(
                                    'url'=>"js:$(this).attr('href')", 
                                    'update'=>'#keyresponse', //display a response
                                    'success'=> "js:function(data){
                                        console.log(data);
                                        $.fn.yiiGridView.update('keys-grid');}"
                                    
                                ),
                            ),
                        ),
                        'enable' => array
                        (
                            'label' => 'Enable',
                            'icon'  => 'plus',
                            'url'   => 'Yii::app()->createUrl("user/profile/enableKey", array("id"=>$data->keyID))',
                            'visible' => '$data->isActive == 0',
                            'options'=>array(  
                                'ajax'=>array(
                                    'url'=>"js:$(this).attr('href')", 
                                    'update'=>'#keyresponse', //display a response
                                    'success'=> "js:function(data){
                                        console.log(data);
                                        $.fn.yiiGridView.update('keys-grid');}"
                                ),
                            ),
                        ),  
                    ),
                ),
            ),
        ));
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

<?php 
// @todo: model dialog
echo CHtml::link('Add New API', "profile/addapi"  // the link for open the dialog
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
