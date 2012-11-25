<?php $form = $this->beginWidget( 'CActiveForm', array(
  'id' => 'location-delete-form',
  'enableAjaxValidation' => false,
  'focus' => '#denyDelete',
)); ?>
<p>You are about to delete the character <strong><?php echo $char->characterName; ?></strong>. Doing this will completely wipe out all data associated with this character from the database, an operation that cannot be reversed. If you instead do not want to pull any more API data, or wish to change this character's API Access settings, please cancel deletion and choose the Disable or Update actions respectively.</p>
<p>Are you sure you wish to delete <strong><?php echo $char->characterName; ?></strong>?</p>

<div class="btn-toolbar">
 
  <?php
if (!Yii::app()->request->isAjaxRequest) {
  $this->widget( 'bootstrap.widgets.TbButton', array(
    'buttonType' => 'submit',
    'type' => 'danger',
    'label' => 'Delete',
    'htmlOptions' => array('name'=> 'confirmDelete',),
  ));
    $this->widget( 'bootstrap.widgets.TbButton', array(
    'buttonType' => 'submit',
    'type' => '',
    'label' => 'Cancel',
    'htmlOptions' => array('name'=> 'denyDelete',),
  ));
}
  ?>
</div>
 
<?php $this->endWidget(); ?>