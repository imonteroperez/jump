<?php
/* @var $this JumpRequestController */
/* @var $model JumpRequest */

$this->breadcrumbs=array(
	'Jump Requests'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List JumpRequest', 'url'=>array('index')),
	array('label'=>'Manage JumpRequest', 'url'=>array('admin')),
);
?>

<h1>Create JumpRequest</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>