<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'apiDialog',
                'options'=>array(
                    'title'=>Yii::t('api','Add API'),
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>'auto',
                    'height'=>'auto',
                ),
                ));
echo $this->renderPartial('_formDialog', array('model'=>$model)); ?>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>