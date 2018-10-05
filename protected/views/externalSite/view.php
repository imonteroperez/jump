<?php
/* @var $this ExternalSiteController */
/* @var $model ExternalSite */

$this->breadcrumbs=array(
	'External Sites'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ExternalSite', 'url'=>array('index')),
	array('label'=>'Create ExternalSite', 'url'=>array('create')),
	array('label'=>'Update ExternalSite', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ExternalSite', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ExternalSite', 'url'=>array('admin')),
);
?>

<h1>View ExternalSite #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'url',
		'source',
		'brand_id',
		'shop_id',
	),
)); ?>
