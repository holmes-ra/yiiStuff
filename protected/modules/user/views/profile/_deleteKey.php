<?php $form = $this->beginWidget( 'CActiveForm', array(
  'id' => 'location-delete-form',
  'enableAjaxValidation' => false,
  'focus' => '#denyDelete',
)); ?>
<p>You are about to delete the API key <strong><?php echo $key->keyID; ?></strong>. Deleting this key may cause some characters to loose access to some API calls, or may irreversibly delete characters altogether if this is the sole key they rely upon. For your convenience, listed below are the various modifications to characters that will happen upon key deletion.</p>
<ul><li>LIST CHARS</li></ul>
<p>Are you sure you wish to delete the <strong><?php echo $key->keyID; ?></strong> key?</p>

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