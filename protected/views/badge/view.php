<?php
/* @var $this BadgeController */
/* @var $model Badge */
?>

<h2><i><?php echo $model->title; ?></i></h2>
<p><strong>Description:</strong><?php echo $model->description; ?>

<div id="raysDemoHolder">
  <div class="badge-detail"><img src=<?php echo '"images/'.$model->img.'"'; ?> id="raysLogo"></div>
  <div id="rays"></div>
</div>


