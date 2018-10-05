<?php
/* @var $this JumpResponseController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Jump Responses',
);

$this->menu=array(
	array('label'=>'Create JumpResponse', 'url'=>array('create')),
	array('label'=>'Manage JumpResponse', 'url'=>array('admin')),
);
?>

<h1>Jump Responses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
