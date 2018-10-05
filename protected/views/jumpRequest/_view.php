<?php
/* @var $this JumpRequestController */
/* @var $data JumpRequest */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('votes')); ?>:</b>
	<?php echo CHtml::encode($data->votes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_id')); ?>:</b>
	<?php echo CHtml::encode($data->product_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('author_id')); ?>:</b>
	<?php echo CHtml::encode($data->author_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desiredprice')); ?>:</b>
	<?php echo CHtml::encode($data->desiredprice); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('averagedprice')); ?>:</b>
	<?php echo CHtml::encode($data->averagedprice); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('photo_id')); ?>:</b>
	<?php echo CHtml::encode($data->photo_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('geoposition_lat')); ?>:</b>
	<?php echo CHtml::encode($data->geoposition_lat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('geoposition_long')); ?>:</b>
	<?php echo CHtml::encode($data->geoposition_long); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('points')); ?>:</b>
	<?php echo CHtml::encode($data->points); ?>
	<br />

	*/ ?>

</div>