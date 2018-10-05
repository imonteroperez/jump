<?php
/* @var $this UserJumpResponseController */
/* @var $model UserJumpResponse */

$this->breadcrumbs=array(
    'User Jump Responses'=>array('index'),
    $model->id=>array('view','id'=>$model->id),
    'Update',
);

$this->menu=array(
    array('label'=>'List UserJumpResponse', 'url'=>array('index')),
    array('label'=>'Create UserJumpResponse', 'url'=>array('create')),
    array('label'=>'View UserJumpResponse', 'url'=>array('view', 'id'=>$model->id)),
    array('label'=>'Manage UserJumpResponse', 'url'=>array('admin')),
);
?>

<h1>Update UserJumpResponse <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
