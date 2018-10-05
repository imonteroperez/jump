<?php
if(!isset($_SESSION))
      session_start();
/* @var $this UserController */
/* @var $model User */
?>
<script type="text/javascript">
$(document).ready(function(){
  $("body").css("background-color", "#F5F5F5");
});
</script>
<h2>Edit user preferences </h2>
<p>Hello <?php echo $_SESSION["jump_user_name"]; ?>, here you can edit your preferences. These preferences drive the product suggestions and are categorized from Facebook. The priority of each preference is obtained from your 'likes' on Facebook and from your activity on Jump, so it is a self-calculated and non-editable parameter.
<form action="<?php echo Yii::app()->homeUrl ?>index.php/user/update/<?php echo $model->id; ?>?update_preferences=1" method="post">
<div class="container-fluid">
    <fieldset>
    <div id="preferences">
    <span>
      <legend>Activate/Deactivate Preferences</legend>
      <?php
	if(count($model->preferences_categories) == 0){
	  echo "No preferences obtained";
	}else{
	  $max = 0;
	  for($i=0;$i<count($model->preferences_categories);$i++){
		if($model->preferences_categories[$i]["count"] > $max)
			$max = $model->preferences_categories[$i]["count"];
	  }
	  echo '<center>';
	  $categories_names = array();
	  for($i=0;$i<count($model->preferences_categories);$i++){
	    $category_id = $model->preferences_categories[$i]["category_id"];
	    $category = Category::model()->findByPk($category_id);
	    array_push($categories_names,$category->name);
	  }
	  $categories = Category::model()->findAll();
	  for($i=0;$i<count($categories);$i++){
		if(!in_array($categories[$i]->name,$categories_names)){
		    echo '<label class="checkbox inline">';
		    echo '<input type="checkbox" name="'.$categories[$i]->id.'" id="'.$categories[$i]->id.'" >';
	    	    echo '<font color="#999"> '.$categories[$i]->name.'<small> (0%) </small></font> ';
	    	    echo '</label>&nbsp;';
		}else{
		    $stop = false;
		    for($j=0;$j<count($model->preferences_categories) && $stop == false;$j++){
		        $category_id = $model->preferences_categories[$j]["category_id"];
			$category = Category::model()->findByPk($category_id);
			if($categories[$i]->name == $category->name){
			    $stop = true;
            		    $count = $model->preferences_categories[$j]["count"];
			    $value = round($count*100/$max);
			    echo '<label class="checkbox inline">';
			    echo '<input type="checkbox" name="'.$category->id.'" id="'.$category->id.'" value="'.$category->id.'" checked>';
			    echo '<strong> '.$category->name.'</strong><small> ('.$value.'%) </small>';
			    echo '</label>&nbsp;';
			}
		    }
		}
	  }
	  echo '</center>';
	}
      ?>
      <br/>
    </span>
    </div>
    <div id="preferences-buttons">
    <button class="btn btn-large btn-block btn-primary" type="submit">Save Changes</a></button>
    </div>
</fieldset>
</div>
</form>
