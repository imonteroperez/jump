<?php
/* @var $this UserJumpRequestController */
/* @var $data UserJumpRequest */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jump_request_id')); ?>:</b>
	<?php echo CHtml::encode($data->jump_request_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_jump')); ?>:</b>
	<?php echo CHtml::encode($data->is_jump); ?>
	<br />


</div>