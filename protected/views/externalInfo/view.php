<?php
/* @var $this ExternalInfoController */
/* @var $model ExternalInfo */

$this->breadcrumbs=array(
	'External Infos'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ExternalInfo', 'url'=>array('index')),
	array('label'=>'Create ExternalInfo', 'url'=>array('create')),
	array('label'=>'Update ExternalInfo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ExternalInfo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ExternalInfo', 'url'=>array('admin')),
);
?>

<h1>View ExternalInfo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'API',
		'source',
		'url',
	),
)); ?>
