<?php
/* @var $this ShopProductController */
/* @var $model ShopProduct */

$this->breadcrumbs=array(
	'Shop Products'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ShopProduct', 'url'=>array('index')),
	array('label'=>'Manage ShopProduct', 'url'=>array('admin')),
);
?>

<h1>Create ShopProduct</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>