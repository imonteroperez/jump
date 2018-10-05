<?php
/* @var $this ExternalInfoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'External Infos',
);

$this->menu=array(
	array('label'=>'Create ExternalInfo', 'url'=>array('create')),
	array('label'=>'Manage ExternalInfo', 'url'=>array('admin')),
);
?>

<h1>External Infos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
