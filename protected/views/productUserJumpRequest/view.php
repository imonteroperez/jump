<?php
/* @var $this ProductUserJumpRequestController */
/* @var $model ProductUserJumpRequest */

$this->breadcrumbs=array(
	'Product User Jump Requests'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ProductUserJumpRequest', 'url'=>array('index')),
	array('label'=>'Create ProductUserJumpRequest', 'url'=>array('create')),
	array('label'=>'Update ProductUserJumpRequest', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ProductUserJumpRequest', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProductUserJumpRequest', 'url'=>array('admin')),
);
?>

<h1>View ProductUserJumpRequest #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_jump_request_id',
		'product_id',
	),
)); ?>
