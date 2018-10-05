<div class="jump-modal jump-modal-dialog jump-modal-dialog-open jump-modal-friends modal-dialog" tabindex="-1" role="dialog" aria-labelledby="update" aria-hidden="true" >
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h2 class="modal-title" id="myModalLabel"><?php echo Yii::t('strings','Friends to follow');?></h2>
        </div>
        <div class="modal-body">
          <div class="jump-jumbotron-details-modal-friends jump-jumbotron-details-modal jump-jumbotron-details jumbotron">
            <div class="jump-friends-list">
              <ul class="media-list">
              <?php
                  $counter_friends = 0;
                  for($i=0;$i<count($model->friends) && $counter_friends<6;$i++){
                   if($model->friends[$i]["suggestion"] == 1){
                    if($counter_friends %2 != 0)
                       echo '<div class="row">';
                     echo '<div class="col-xs-6">';
              	     $userFriend = User::model()->findByPk($model->friends[$i]["following_id"]);
                	     if(isset($_SESSION["jump_user_id"]))
              		     $friend_facebook = Yii::app()->facebook->api('/'.$userFriend->id.'?fields=picture&access_token='.$_SESSION["access_token"]);
              	     else
              		     $friend_facebook = Yii::app()->facebook->api('/'.$userFriend->id.'?fields=picture');
              	     echo '<li class="media">';
              	     echo '<a class="pull-left" title="View '.$userFriend->first_name.' profile" href="user/'.$userFriend->id.'"><img alt="View profile in Jump" src="'.$friend_facebook["picture"]["data"]["url"].'"></a>';
                   	 echo '<div class="media-body">'.$userFriend->first_name.' '.$userFriend->last_name.'<br/>';
              	     echo '<button class="btn btn-mini btn-primary btn-success" type="button">'.Yii::t('strings','Follow').'</button></div></li>';
                     echo '</div>';
                     if($counter_friends %2 != 0)
                       echo '</div>';
              	     $counter_friends++;
              	   }
                  }
              ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo Yii::t('strings','Close');?></button>
        </div>
      </div>
    </div>
    </form>
  </div>
</div>
