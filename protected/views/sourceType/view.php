<?php
/* @var $this SourceTypeController */
/* @var $model SourceType */

$this->breadcrumbs=array(
	'Source Types'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List SourceType', 'url'=>array('index')),
	array('label'=>'Create SourceType', 'url'=>array('create')),
	array('label'=>'Update SourceType', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SourceType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SourceType', 'url'=>array('admin')),
);
?>

<h1>View SourceType #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
