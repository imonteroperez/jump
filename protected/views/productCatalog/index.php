<?php
/* @var $this ProductCatalogController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Product Catalogs',
);

$this->menu=array(
	array('label'=>'Create ProductCatalog', 'url'=>array('create')),
	array('label'=>'Manage ProductCatalog', 'url'=>array('admin')),
);
?>

<h1>Product Catalogs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
