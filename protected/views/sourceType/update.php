<?php
/* @var $this SourceTypeController */
/* @var $model SourceType */

$this->breadcrumbs=array(
	'Source Types'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SourceType', 'url'=>array('index')),
	array('label'=>'Create SourceType', 'url'=>array('create')),
	array('label'=>'View SourceType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SourceType', 'url'=>array('admin')),
);
?>

<h1>Update SourceType <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>