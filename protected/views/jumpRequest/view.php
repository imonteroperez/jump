<?php
/* @var $this JumpRequestController */
/* @var $model JumpRequest */

$this->breadcrumbs=array(
	'Jump Requests'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List JumpRequest', 'url'=>array('index')),
	array('label'=>'Create JumpRequest', 'url'=>array('create')),
	array('label'=>'Update JumpRequest', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete JumpRequest', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage JumpRequest', 'url'=>array('admin')),
);
?>

<h1>View JumpRequest #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'votes',
		'product_id',
		'author_id',
		'desiredprice',
		'averagedprice',
		'photo_id',
		'geoposition_lat',
		'geoposition_long',
		'date',
		'points',
	),
)); ?>
