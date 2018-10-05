<?php
/* @var $this ShopController */
/* @var $data Shop */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('geolocation_lat')); ?>:</b>
	<?php echo CHtml::encode($data->geolocation_lat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('geolocation_long')); ?>:</b>
	<?php echo CHtml::encode($data->geolocation_long); ?>
	<br />


</div>