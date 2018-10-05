<?php
/* @var $this JumpResponseController */
/* @var $model JumpResponse */

$this->breadcrumbs=array(
	'Jump Responses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List JumpResponse', 'url'=>array('index')),
	array('label'=>'Create JumpResponse', 'url'=>array('create')),
	array('label'=>'Update JumpResponse', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete JumpResponse', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage JumpResponse', 'url'=>array('admin')),
);
?>

<h1>View JumpResponse #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'jump_request_id',
		'product_id',
		'typeof',
		'points',
	),
)); ?>
