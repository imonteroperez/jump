<script type="text/javascript">
$(document).ready(function($) {
  $("#user-update-form").on("submit",function(e){
      e.preventDefault();
      $.ajax({
              url:'<?php echo Yii::app()->homeUrl ?>index.php/user/update/<?php echo $model->id ?>?'+$(this).serialize()+"&user_pinterest="+document.getElementById("user_pinterest").value,
              type: 'post',
              beforeSend: function () {
                $("#img-loading").css({"display":"block"});
              },
              success:  function (response) {
                  $("#img-loading").css({"display":"none"});
                  alertify.set({delay: 5000});
                  if(response.indexOf("error_code=01") > -1)
                    alertify.error(<?php echo Yii::t('strings','"Provided Pinterest user does not exists"');?>);
                  else if(response.indexOf("error_code=02") > -1)
                    alertify.error(<?php echo Yii::t('strings','"Please review provided Pinterest URL"');?>);
                  else
                    alertify.success(<?php echo Yii::t('strings','"Updated user settings"');?>);
                  if(response.indexOf("lang") > -1){
                    alertify.set({delay: 5000});
                    alertify.log(<?php echo Yii::t('strings','"Changing language ... Reloading Jump in 5 seconds"');?>);
                    window.setTimeout(function(){ 
                      window.location.href = location.protocol + "//" + location.host + location.pathname;
                    },5000);
                  }
              }
      })
  });
});

function updateUser(){
  $("#user-update-form").submit();
}


function refreshFacebookPhoto(){
   $.ajax({
            url:'<?php echo Yii::app()->homeUrl ?>user/update/<?php echo $model->id ?>?facebook-photo-refresh=1',
            type: 'post',
            beforeSend: function () {
                $("#photo-facebook").html(<?php echo Yii::t('strings','"Loading ..."');?>);
            },
            success:  function (response) {
                $("#photo-facebook").html(response);
            }
        });
  };

</script>

<div class="jump-modal jump-modal-dialog jump-modal-dialog-open modal-dialog" tabindex="-1" role="dialog" aria-labelledby="update" aria-hidden="true" >
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h2 class="modal-title" id="myModalLabel"><?php echo Yii::t('strings','Edit Account Settings');?></h2>
        </div>
        <div class="modal-body">
          <div class="jump-jumbotron-details-modal jump-jumbotron-details jumbotron">
              <div class="row">
                <p><?php echo Yii::t('strings','Hello');?> <?php echo Yii::app()->session["jump_user_name"]; ?>, <?php echo Yii::t('strings','here you can review your personal settings and profile info.');?> <a href='<?php if(strpos(Yii::app()->request->requestUri,"welcome")){ echo Yii::app()->request->requestUri; }else{  echo Yii::app()->homeUrl.'user/update/'.$model->id.'?welcome=1'; };?>' style="text-decoration:none;"><font color="#999"> (<?php echo Yii::t('strings','Please, show me how to do it');?>) </font> </a></p>
                <br>
                <form id="user-update-form">
                <div class="col-xs-4">
                  <span>
                    <fieldset>
                      <legend><?php echo Yii::t('strings','Image');?></legend>
                        <center><span id="photo-facebook"><img src='<?php echo Yii::app()->session["jump_user_photo_large"]; ?>'></span>
                      <br/><br/>
                      <a class="btn btn-default" href="javascript:refreshFacebookPhoto();"><?php echo Yii::t('strings','Refresh from Facebook');?></a></center>
                    </fieldset>
                  </span>
                </div>     
                <div class="col-xs-7">
                  <span class="form-horizontal">
                    <fieldset>
                      <legend><?php echo Yii::t('strings','Profile info');?></legend>
                        <div class="control-group">
                          <label class="control-label" for="inputFirstName"><?php echo Yii::t('strings','First Name');?>:</label>
                            <div class="controls jump-user-info">
                              <input type="text" class="form-control" id="inputFirstName" placeholder='<?php echo $model->first_name; ?>' value='<?php echo $model->first_name; ?>' readonly>
                            </div>
                          <label class="control-label" for="inputLastName"><?php echo Yii::t('strings','Last Name');?>:</label>
                            <div id="standout-social-markup" class="controls jump-user-info">
                              <input type="text" class="form-control" id="inputLastName" placeholder='<?php echo $model->last_name; ?>' value='<?php echo $model->last_name; ?>' readonly>
                            </div>
                        </div>
                        <span class="help-block"><strong><?php echo Yii::t('strings','Source');?>:</strong> <a href='<?php echo $model->external_site->url; ?>' target="_blank"><?php echo $model->external_site->name; ?></a>.</span><br/>
                    </fieldset>
                  </span>
                  <span class="form-horizontal">
                    <fieldset>
                      <legend><?php echo Yii::t('strings','Language');?></legend>
                        <div id="languages" rel="popover" data-placement="top" data-original-title="This is your profile info and language. All this data is obtained from Facebook too, but you can modify (if you want) the language settings of the platform." data-content='<div id="showBadges"><button type="button" class="btn btn-primary">Next</button></div>'/>
                          <div class="jump-select">
                            <select class="form-control" name="user_language">
                              <?php if(Yii::app()->language == "en"):?>
                                <option value="en"selected ><?php echo Yii::t('strings','English');?></option>
                                <option value="es"><?php echo Yii::t('strings','Spanish');?></option>
                              <?php endif?>
                              <?php if(Yii::app()->language == "es"):?>
                                <option value="en"><?php echo Yii::t('strings','English');?></option>
                                <option value="es"selected ><?php echo Yii::t('strings','Spanish');?></option>
                              <?php endif?>
                            </select>
                          </div>
                    </fieldset>
                  </span>
                </div>
            </div>
            <br/>
            <div class="row">
              <div id="standout-social" class="col-xs-11">
                <span id="standout-social-markup-responsive" class="form-horizontal">
                   <fieldset>
                    <legend><?php echo Yii::t('strings','Social Networks');?></legend>
                        <div class="control-group">
                          <label class="control-label" for="Facebook">Facebook:</label>
                          <div class="controls jump-social-info">
                            <input type="text" class="form-control" name="user_facebook" id="user_facebook" placeholder='<?php echo $model->external_site->url; ?>' value='<?php echo $model->external_site->url; ?>' readonly>
                          </div>
                          <label class="control-label" for="Pinterest">Pinterest:</label>
                          <div class="controls jump-social-info">
                            <?php if(!isset($_SESSION["jump_user_pinterest"])):?>
                              <input type="text" class="form-control" name="user_pinterest" id="user_pinterest" placeholder='<?php echo Yii::t('strings','Place here your Pinterest URL. (optional)');?>'>
                            <?php endif?>
                            <?php if(isset($_SESSION["jump_user_pinterest"])):?>
                              <input type="text" class="form-control" name="user_pinterest" id="user_pinterest" placeholder='<?php echo Yii::t('strings','Place here your Pinterest URL. (optional)');?>' value='<?php echo $_SESSION["jump_user_pinterest"]; ?>'>
                            <?php endif?>
                          </div>
                      </div>
                  </fieldset>
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <img class="img-loading" id="img-loading" src="<?php echo Yii::app()->baseUrl; ?>/images/jump-loader.gif">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo Yii::t('strings','Close');?></button>
          <button type="button" id="save-button-deactivate-account" class="btn btn-default"><?php echo Yii::t('strings','Deactivate Account');?></button>
          <a href="javascript:updateUser();" id="save-button-user-update" class="btn btn-primary"><?php echo Yii::t('strings','Save Changes');?></a>
        </div>
      </div>
    </div>
    </form>
  </div>
</div>