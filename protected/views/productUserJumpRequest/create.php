<?php
/* @var $this ProductUserJumpRequestController */
/* @var $model ProductUserJumpRequest */

$this->breadcrumbs=array(
	'Product User Jump Requests'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProductUserJumpRequest', 'url'=>array('index')),
	array('label'=>'Manage ProductUserJumpRequest', 'url'=>array('admin')),
);
?>

<h1>Create ProductUserJumpRequest</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>