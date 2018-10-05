<?php
/* @var $this UserJumpRequestController */
/* @var $model UserJumpRequest */

$this->breadcrumbs=array(
	'User Jump Requests'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserJumpRequest', 'url'=>array('index')),
	array('label'=>'Create UserJumpRequest', 'url'=>array('create')),
	array('label'=>'Update UserJumpRequest', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserJumpRequest', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserJumpRequest', 'url'=>array('admin')),
);
?>

<h1>View UserJumpRequest #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'jump_request_id',
		'is_jump',
	),
)); ?>
