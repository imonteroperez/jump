<?php
/* @var $this UserJumpResponseController */
/* @var $model UserJumpResponse */

$this->breadcrumbs=array(
    'User Jump Responses'=>array('index'),
    $model->id,
);

$this->menu=array(
    array('label'=>'List UserJumpResponse', 'url'=>array('index')),
    array('label'=>'Create UserJumpResponse', 'url'=>array('create')),
    array('label'=>'Update UserJumpResponse', 'url'=>array('update', 'id'=>$model->id)),
    array('label'=>'Delete UserJumpResponse', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('label'=>'Manage UserJumpResponse', 'url'=>array('admin')),
);
?>

<h1>View UserJumpResponse #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'id',
        'user_id',
        'jump_response_id',
    ),
)); ?>
