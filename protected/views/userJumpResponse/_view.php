<?php
/* @var $this UserJumpResponseController */
/* @var $data UserJumpResponse */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
    <?php echo CHtml::encode($data->user_id); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('jump_response_id')); ?>:</b>
    <?php echo CHtml::encode($data->jump_response_id); ?>
    <br />


</div>
