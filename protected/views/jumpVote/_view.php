<?php
/* @var $this JumpVoteController */
/* @var $data JumpVote */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jump_request_id')); ?>:</b>
	<?php echo CHtml::encode($data->jump_request_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('points')); ?>:</b>
	<?php echo CHtml::encode($data->points); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desiredprice')); ?>:</b>
	<?php echo CHtml::encode($data->desiredprice); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desiredlocation_lat')); ?>:</b>
	<?php echo CHtml::encode($data->desiredlocation_lat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desiredlocation_long')); ?>:</b>
	<?php echo CHtml::encode($data->desiredlocation_long); ?>
	<br />


</div>