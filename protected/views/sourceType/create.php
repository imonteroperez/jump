<?php
/* @var $this SourceTypeController */
/* @var $model SourceType */

$this->breadcrumbs=array(
	'Source Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SourceType', 'url'=>array('index')),
	array('label'=>'Manage SourceType', 'url'=>array('admin')),
);
?>

<h1>Create SourceType</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>