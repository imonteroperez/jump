<?php
/* @var $this ExternalInfoController */
/* @var $model ExternalInfo */

$this->breadcrumbs=array(
	'External Infos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ExternalInfo', 'url'=>array('index')),
	array('label'=>'Manage ExternalInfo', 'url'=>array('admin')),
);
?>

<h1>Create ExternalInfo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>