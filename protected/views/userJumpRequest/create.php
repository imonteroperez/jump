<?php
/* @var $this UserJumpRequestController */
/* @var $model UserJumpRequest */

$this->breadcrumbs=array(
	'User Jump Requests'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserJumpRequest', 'url'=>array('index')),
	array('label'=>'Manage UserJumpRequest', 'url'=>array('admin')),
);
?>

<h1>Create UserJumpRequest</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>