<?php
/* @var $this JumpResponseTypeController */
/* @var $model JumpResponseType */

$this->breadcrumbs=array(
	'Jump Response Types'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List JumpResponseType', 'url'=>array('index')),
	array('label'=>'Create JumpResponseType', 'url'=>array('create')),
	array('label'=>'Update JumpResponseType', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete JumpResponseType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage JumpResponseType', 'url'=>array('admin')),
);
?>

<h1>View JumpResponseType #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
