<?php
/* @var $this ShopProductController */
/* @var $model ShopProduct */

$this->breadcrumbs=array(
	'Shop Products'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ShopProduct', 'url'=>array('index')),
	array('label'=>'Create ShopProduct', 'url'=>array('create')),
	array('label'=>'Update ShopProduct', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ShopProduct', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ShopProduct', 'url'=>array('admin')),
);
?>

<h1>View ShopProduct #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'shop_id',
		'product_id',
	),
)); ?>
