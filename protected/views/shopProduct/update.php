<?php
/* @var $this ShopProductController */
/* @var $model ShopProduct */

$this->breadcrumbs=array(
	'Shop Products'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ShopProduct', 'url'=>array('index')),
	array('label'=>'Create ShopProduct', 'url'=>array('create')),
	array('label'=>'View ShopProduct', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ShopProduct', 'url'=>array('admin')),
);
?>

<h1>Update ShopProduct <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>