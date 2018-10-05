<?php
/* @var $this BadgeController */
/* @var $model Badge */

$this->breadcrumbs=array(
	'Badges'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Badge', 'url'=>array('index')),
	array('label'=>'Manage Badge', 'url'=>array('admin')),
);
?>

<h1>Create Badge</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>