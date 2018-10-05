<?php
/* @var $this ProductCatalogController */
/* @var $model ProductCatalog */

$this->breadcrumbs=array(
	'Product Catalogs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ProductCatalog', 'url'=>array('index')),
	array('label'=>'Create ProductCatalog', 'url'=>array('create')),
	array('label'=>'Update ProductCatalog', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ProductCatalog', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProductCatalog', 'url'=>array('admin')),
);
?>

<h1>View ProductCatalog #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'product_id',
		'catalog_id',
	),
)); ?>
