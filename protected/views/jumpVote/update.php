<?php
/* @var $this JumpVoteController */
/* @var $model JumpVote */

$this->breadcrumbs=array(
	'Jump Votes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List JumpVote', 'url'=>array('index')),
	array('label'=>'Create JumpVote', 'url'=>array('create')),
	array('label'=>'View JumpVote', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage JumpVote', 'url'=>array('admin')),
);
?>

<h1>Update JumpVote <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>