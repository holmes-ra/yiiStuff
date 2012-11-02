<div class="form" id="apiDialogForm">
 
<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'api-form',
  //  'enableAjaxValidation'=>true,
)); 
//I have enableAjaxValidation set to true so i can validate on the fly the
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
 
    <div class="row buttons">
        <?php echo CHtml::submitButton(Yii::t('addapi','Add API')); ?>
    </div>
 
<?php $this->endWidget(); ?>
 
</div>