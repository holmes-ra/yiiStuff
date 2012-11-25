
<div class="form">
 
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'api-form',
)); 
?>
 
    <p class="note">Fields with <span class="required">*</span> are required.</p>
 
    <?php echo $form->errorSummary($model); ?>
 
    <div class="row">
        <?php echo $form->labelEx($model,'keyID'); ?>
        <?php echo $form->textField($model,'keyID'); ?>
        <?php echo $form->error($model,'keyID'); ?>
    </div>
 
    <div class="row">
        <?php echo $form->labelEx($model,'vCode'); ?>
        <?php echo $form->textField($model,'vCode'); ?>
        <?php echo $form->error($model,'vCode'); ?>
    </div>
    <?php if (!Yii::app()->request->isAjaxRequest): ?>
    <div class="btn-toolbar">
    <?php
        $this->widget( 'bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type'=>'primary',
            'label' => 'Add API',
        ));
    ?>
    </div>
    <?php endif; ?>
<?php $this->endWidget(); ?>
 
</div>