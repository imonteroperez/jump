<?php
/* @var $this SourceTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Source Types',
);

$this->menu=array(
	array('label'=>'Create SourceType', 'url'=>array('create')),
	array('label'=>'Manage SourceType', 'url'=>array('admin')),
);
?>

<h1>Source Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
