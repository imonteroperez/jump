<?php
/* @var $this JumpVoteController */
/* @var $model JumpVote */

$this->breadcrumbs=array(
	'Jump Votes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List JumpVote', 'url'=>array('index')),
	array('label'=>'Create JumpVote', 'url'=>array('create')),
	array('label'=>'Update JumpVote', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete JumpVote', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage JumpVote', 'url'=>array('admin')),
);
?>

<h1>View JumpVote #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'jump_request_id',
		'user_id',
		'points',
		'desiredprice',
		'desiredlocation_lat',
		'desiredlocation_long',
	),
)); ?>
