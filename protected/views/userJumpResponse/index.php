<?php
/* @var $this UserJumpResponseController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    'User Jump Responses',
);

$this->menu=array(
    array('label'=>'Create UserJumpResponse', 'url'=>array('create')),
    array('label'=>'Manage UserJumpResponse', 'url'=>array('admin')),
);
?>

<h1>User Jump Responses</h1>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
)); ?>
