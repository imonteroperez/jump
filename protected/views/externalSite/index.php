<?php
/* @var $this ExternalSiteController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'External Sites',
);

$this->menu=array(
	array('label'=>'Create ExternalSite', 'url'=>array('create')),
	array('label'=>'Manage ExternalSite', 'url'=>array('admin')),
);
?>

<h1>External Sites</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
