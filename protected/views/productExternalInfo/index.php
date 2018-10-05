<?php
/* @var $this ProductExternalInfoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Product External Infos',
);

$this->menu=array(
	array('label'=>'Create ProductExternalInfo', 'url'=>array('create')),
	array('label'=>'Manage ProductExternalInfo', 'url'=>array('admin')),
);
?>

<h1>Product External Infos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
