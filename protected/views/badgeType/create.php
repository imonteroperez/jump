<?php
/* @var $this BadgeTypeController */
/* @var $model BadgeType */

$this->breadcrumbs=array(
	'Badge Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BadgeType', 'url'=>array('index')),
	array('label'=>'Manage BadgeType', 'url'=>array('admin')),
);
?>

<h1>Create BadgeType</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>