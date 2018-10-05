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
function deactivate(){
   $.ajax({
            url:'<?php echo Yii::app()->homeUrl ?>user/deactivate/<?php echo $model->id ?>?confirm=1',
            type: 'post',
            beforeSend: function () {
                $("#deactivation-msg").html("Performing deactivation ...");
            },
            success:  function (response) {
                $("#deactivation-msg").html(response);
		$(location).attr('href','<?php echo Yii::app()->homeUrl ?>site/login?facebook-logout=1');
            }
        });
};
</script>

<h2>Deactivate account </h2>
<p>Hello <?php echo $_SESSION["jump_user_name"]; ?>, this is your last chance to cancel your deactivation. The process of deactivation will perform the following actions:</p>
<br/>
<ul class="media-list">
  <li class="media">
	<div class="jump-alert-badge">
	      <img src='<?php echo $_SESSION["jump_user_photo"]; ?>'>
        </div>
      <div class="media-body">
        <h4 class="media-heading">User Account</h4>
	All your user account data will be erased from our database. It includes your personal data and profile pic. In fact, the most of your profile information is obtained at runtime from Facebook. However, there exists information about you that is stored in our architecture. All of these data will be erased.
      </div>
  </li>
  <li class="media">
	<div class="jump-alert-badge">
	      <img src='/jump/images/badges/bronze.png'>
        </div>
      <div class="media-body">
        <h4 class="media-heading">Information</h4>
	All your badges, preferences, jump request and responses, jumps, and other information about you will be erased.
      </div>
  </li>
  <li class="media">
	<div class="jump-alert-badge">
	      <img src='/jump/images/icon_pinterest.png'>
        </div>
      <div class="media-body">
        <h4 class="media-heading">Social Networks</h4>
	All the data that you have provided about your social network links, such as Pinterest, will be erased.
      </div>
  </li>
</ul>

<br/><br/>
<center><small><span id="deactivation-msg"></span></small></center>
<a class="btn btn-large btn-block" href="javascript:deactivate();">Yes, I want to deactivate my jump account</a></button>

