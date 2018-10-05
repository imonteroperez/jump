<?php
/* @var $this UserJumpResponseController */
/* @var $model UserJumpResponse */

$this->breadcrumbs=array(
    'User Jump Responses'=>array('index'),
    'Create',
);

$this->menu=array(
    array('label'=>'List UserJumpResponse', 'url'=>array('index')),
    array('label'=>'Manage UserJumpResponse', 'url'=>array('admin')),
);
?>

<h1>Create UserJumpResponse</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
