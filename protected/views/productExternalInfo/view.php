<?php
/* @var $this ProductExternalInfoController */
/* @var $model ProductExternalInfo */

$this->breadcrumbs=array(
	'Product External Infos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ProductExternalInfo', 'url'=>array('index')),
	array('label'=>'Create ProductExternalInfo', 'url'=>array('create')),
	array('label'=>'Update ProductExternalInfo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ProductExternalInfo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProductExternalInfo', 'url'=>array('admin')),
);
?>

<h1>View ProductExternalInfo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'product_id',
		'external_info',
	),
)); ?>
