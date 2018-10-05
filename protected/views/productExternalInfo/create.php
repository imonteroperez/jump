<?php
/* @var $this ProductExternalInfoController */
/* @var $model ProductExternalInfo */

$this->breadcrumbs=array(
	'Product External Infos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProductExternalInfo', 'url'=>array('index')),
	array('label'=>'Manage ProductExternalInfo', 'url'=>array('admin')),
);
?>

<h1>Create ProductExternalInfo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>