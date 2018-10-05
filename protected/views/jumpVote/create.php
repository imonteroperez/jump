<?php
/* @var $this JumpVoteController */
/* @var $model JumpVote */

$this->breadcrumbs=array(
	'Jump Votes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List JumpVote', 'url'=>array('index')),
	array('label'=>'Manage JumpVote', 'url'=>array('admin')),
);
?>

<h1>Create JumpVote</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>