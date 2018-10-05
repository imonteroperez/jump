<?php
/* @var $this ProductCatalogController */
/* @var $model ProductCatalog */

$this->breadcrumbs=array(
	'Product Catalogs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProductCatalog', 'url'=>array('index')),
	array('label'=>'Manage ProductCatalog', 'url'=>array('admin')),
);
?>

<h1>Create ProductCatalog</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>