<?php
/* @var $this JumpResponseController */
/* @var $model JumpResponse */

$this->breadcrumbs=array(
	'Jump Responses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List JumpResponse', 'url'=>array('index')),
	array('label'=>'Manage JumpResponse', 'url'=>array('admin')),
);
?>

<h1>Create JumpResponse</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>