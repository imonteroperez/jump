<?php
/* @var $this JumpVoteController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Jump Votes',
);

$this->menu=array(
	array('label'=>'Create JumpVote', 'url'=>array('create')),
	array('label'=>'Manage JumpVote', 'url'=>array('admin')),
);
?>

<h1>Jump Votes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
