<?php
/* @var $this ProductTagController */
/* @var $model ProductTag */

$this->breadcrumbs=array(
	'Product Tags'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ProductTag', 'url'=>array('index')),
	array('label'=>'Create ProductTag', 'url'=>array('create')),
	array('label'=>'Update ProductTag', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ProductTag', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProductTag', 'url'=>array('admin')),
);
?>

<h1>View ProductTag #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'product_id',
		'tag',
	),
)); ?>
