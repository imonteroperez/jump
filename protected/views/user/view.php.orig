<?php
if(!isset($_SESSION))
      session_start();
/* @var $this UserController */
/* @var $model User */
?>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=false"></script>
<script type="text/javascript">
   function refreshFacebookPhoto(){
   $.ajax({
            url:'<?php echo Yii::app()->homeUrl ?>user/update/<?php echo $model->id ?>?facebook-photo-refresh=1',
            type: 'post',
            beforeSend: function () {
                $('span#jump-image-profile').html('<center><img src="<?php echo Yii::app()->homeUrl ?>images/loader.gif" style="border:0;"><center>');
            },
            success:  function (response) {
                $('span#jump-image-profile').html(response);
            }
        });
   };
      var map;
      var pos;
      var pinned = <?php echo $model->pinned; ?>;
      var marker;
      var circle;
      var populationOptions;

      function initialize() {
        var current_user = <?php echo $model->id; ?>;
        var id = <?php if(isset($_SESSION["jump_user_id"]))
			 echo $_SESSION["jump_user_id"];
		       else
			 echo $model->id."0"; ?>;

        <?php if(isset($_SESSION["jump_user_id"])):?>
	var pin = document.getElementById('pin').style.height;
	<?php endif?>
        <?php if(!isset($_SESSION["jump_user_id"])):?>
	var pin = "1px";
	<?php endif?>

        var mapOptions = {
          zoom: 18,
	        disableDefaultUI: true,
          navigationControl: true,
          scrollwheel: false,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
        if(navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            if(current_user != id){
		    pos = new google.maps.LatLng(<?php echo $model->geolocation_lat.','.$model->geolocation_long;?>);
	    }else{
	      <?php if(isset($_SESSION["jump_user_id"])):?>
		if(pin == "1px"){
		   if(pinned == 0){
 	             pos = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
		   }else{
		     pos = new google.maps.LatLng(<?php echo $model->geolocation_lat.','.$model->geolocation_long;?>);
		   }
		}else{
		     pos = new google.maps.LatLng(<?php echo $model->geolocation_lat.','.$model->geolocation_long;?>);
		}
	     <?php endif?>
 	     <?php if(!isset($_SESSION["jump_user_id"])):?>
 	       pos = new google.maps.LatLng(<?php echo $model->geolocation_lat.','.$model->geolocation_long;?>);
	     <?php endif?>

	    }
            map.setCenter(pos);

	    if(current_user == id){
		    marker = new google.maps.Marker({
		      icon: "http://www.google.com/intl/en_us/mapfiles/ms/micons/green-dot.png",
             	      position: pos,
		      draggable: true,
        	      map: map,
        	      title: '<?php echo $model->first_name; ?> was here!'
        	    });

		    populationOptions = {
       		       strokeColor: '#62C462',
       		       strokeOpacity: 0.8,
        	       strokeWeight: 1,
              	       fillColor: '#9ADFA7',
	               fillOpacity: 0.35,
        	       map: map,
             	       center: pos,
              	       radius: 100
            	    };

		    circle = new google.maps.Circle(populationOptions);

	            google.maps.event.addListener(marker, "drag", function() {
			circle.setVisible(false);
	    	    });


	            google.maps.event.addListener(marker, "dragend", function() {
			    pos = marker.getPosition();
			    map.panTo(pos);
			    circle.setCenter(pos);
			    circle.setVisible(true);
			    $.ajax({
            			url:'<?php echo Yii::app()->homeUrl ?>user/<?php echo $model->id ?>?google-map=1',
			        type: 'GET',
				data: {"geoposition_lat":pos.lat(),
				       "geoposition_long":pos.lng()},
        			success:  function (response) {
			        }
		            });

		    });
	    }

	    $.ajax({
            	url:'<?php echo Yii::app()->homeUrl ?>user/<?php echo $model->id ?>?google-map=1',
	        type: 'GET',
		data: {"geoposition_lat":pos.lat(),
		       "geoposition_long":pos.lng()},
        	success:  function (response) {
	        }
            });

          }, function() {
            handleNoGeolocation(true);
          });
        } else {
          handleNoGeolocation(false);
        }
       }
      function handleNoGeolocation(errorFlag) {
        if (errorFlag) {
          var content = 'Error: The Geolocation service failed.';
        } else {
          var content = 'Error: Your browser does not support geolocation.';
        }
	alert(content);
      }


      function reset(){
        if(navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
             pos = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
	     $("#pin").css('height','1px');
	     pinned = 0;
	     initialize();
	  });
	}
      }


      $("#pin").live('click', function () {
	var tip = document.getElementById('pin').style.height;
	if(tip == '1px'){
	   $.ajax({
                url:'<?php echo Yii::app()->homeUrl ?>user/<?php echo $model->id ?>?pin=1',
                type: 'POST',
                beforeSend:  function () {
			$("#pin").css('color','#62C462');
			$("#pin").css('height','2px');
                },
                success:  function (response) {
                }
           });
	}else{
	   $.ajax({
                url:'<?php echo Yii::app()->homeUrl ?>user/<?php echo $model->id ?>?pin=0',
                type: 'POST',
                beforeSend:  function () {
			$("#pin").css('color','#777777');
			$("#pin").css('height','1px');
			reset();
                },
                success:  function (response) {
                }
           });
	}
     });

$("#explore").live('click', function () {

    $('#geopositionMap').modal('show');

    var input = document.getElementById("keyword");
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo("bounds", map);

    google.maps.event.addListener(autocomplete, "place_changed", function()
    {
        var place = autocomplete.getPlace();

        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(16);
        }

        marker.setPosition(place.geometry.location);
    });

    google.maps.event.addListener(map, "click", function(event)
    {
        marker.setPosition(event.latLng);
    });

    pos = marker.getPosition();
    map.panTo(pos);
    circle.setCenter(pos);
    circle.setVisible(true);
});


$(document).ready(function(){
	google.maps.event.addDomListener(window, 'load', initialize);
        $("body").css("background-color", "#F5F5F5");
	/*$.ajax({
            url:'<?php echo Yii::app()->homeUrl ?>?r=user/view&id=<?php echo $model->id ?>&google-api-search=1',
            type: 'post',
            beforeSend: function () {
                $("#container").html("Loading ...");
            },
            success:  function (response) {
                $("#container").html(response);
            }
        });*/
        $('div.jump-image-main-user').on({
            hover: function() {
                var buttonDiv = $(this).children('div.jump-image-button-edit');
                buttonDiv.toggle();
            }
        });
        $('div.jump-stats-main-user').on({
            hover: function() {
                var buttonDiv = $(this).children('div.jump-stats-button-edit');
                buttonDiv.toggle();
            }
        });
});
</script>

<?php if(!isset($_SESSION["jump_user_id"])):?>
<div class="jump-user-join">
 <div class="hero-unit">
  <h2><?php echo $model->first_name; ?> is in <span class="brand-jump-logo-join">jump</span></h2>
  Where your <strong>shopping list wishes</strong> can come <strong>true</strong><br/>
  <p>
    <a class="btn btn-success btn-large">
      Join to the Jump experience
    </a>
    <a class="btn btn-large">
      Tour
    </a>
  </p>
 </div>
</div>
<?php endif?>

<div class="user-container">
<div id="geopositionMap" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="geopositionMapLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
 <div class="modal-body">
 <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Search a location</h3>
    <div class="control-group">
        <div class="controls">
            <input type="text" class="span5" name="keyword" id="keyword" placeHolder="Introduce a location to search">
        </div>
    </div>
 </div>
</div>

<div id="jump-user-bar" class="jump-user-bar">
   <center><div id="map_canvas" style="width:100%; height:315px"></div></center>
</div>

<?php if(isset($_SESSION["jump_user_id"])):?>
<div class="jump-stats-main-user">
  <?php
  if($_SESSION["jump_user_id"] == $model->id)
      echo '<div class="jump-stats-button-edit"><a style="text-decoration:none;" href="#"><font color="#777"><center><font class="lsf">graph</font><small> Explore stats</small></center></font></a></div>';
  echo '<div id="stats" class="jump-stat-result"></div>';
  ?>
  <?php if(count($model->preferences_categories) != 0):?>
    <?php
      $topten = array();
      for($i=0;$i<count($model->preferences_categories);$i++){
        array_push($topten, $model->preferences_categories[$i]["count"]);
      }
      arsort($topten);
      echo '<script text="javascript">
              Morris.Donut({
                element: \'stats\',
                colors: ["#62C462","rgb(193, 207, 163)","rgba(225, 247, 232, 0.57)"],
                data: [';
      $sum = 0;
      $counter = 0;
      foreach ($topten as $key => $value) {
        $sum = $sum + $value;
        $counter++;
        if($counter == 3)
          break;
      }
      $counter = 0;
      foreach ($topten as $key => $value) {
           $category_id = $model->preferences_categories[$key]["category_id"];
           $category = Category::model()->findByPk($category_id);
           $val = round(($value*100)/$sum);
           echo '{label: "'.$category->name.'", value:'.$val.'}';
           if($counter < 2)
            echo ',';
           $counter++;     
           if($counter == 3)
            break;
        }
      echo ']});</script>';
    ?>   
  <?php endif?>
</div>
<?php endif?>

<div class="jump-image-main-user">
  <?php
	if(isset($_SESSION["access_token"])){
		$picture_ = Yii::app()->facebook->api('/'.$model->id.'?fields=picture.type(large)&access_token='.$_SESSION["access_token"]);
		if($_SESSION["jump_user_id"] == $model->id)
			echo '<div class="jump-image-button-edit"><a style="text-decoration:none;" href="javascript:refreshFacebookPhoto();"><font color="#777"><center><font class="lsf">refresh</font><small> Refresh from Facebook</small></center></font></a></div>';
	}else
		$picture_ = Yii::app()->facebook->api('/'.$model->id.'?fields=picture.type(large)');

	echo '<span id="jump-image-profile"><img src="'.$picture_["picture"]["data"]["url"].'"></span>';
  ?>
</div>
</div>
<div class="user-tools">
	<ul class="nav nav-pills">
  	  <?php if(isset($_SESSION["jump_user_id"])):?>
	  <?php if($_SESSION["jump_user_id"] != $model->id):?>
	  <li><button class="btn btn-success" type="button"><font class="lsf">friend</font>&nbsp;Follow user</button></li>
	  <li><a rel="tooltip" data-toggle="tooltip" data-placement="top" title="Make a gift to <?php echo $model->first_name; ?>" href="#"><font id="pin" style="height:1px;" class="lsf" color="#777" size="3px">gift</font></a></li>
	  <?php endif?>
	  <?php endif?>
	  <li><a rel="tooltip" data-toggle="tooltip" data-placement="top" title="Explore your jumps" href="#"><font color="#777"><strong><?php echo $this->countJumps($model->id);?> jumps</strong></font></a></li>
	  <li><a rel="tooltip" data-toggle="tooltip" data-placement="top" title="Explore your jump requests" href="#"><font color="#777"><strong><?php echo count($model->jump_requests); ?> requests</strong></font></a></li>
	  <li><a rel="tooltip" data-toggle="tooltip" data-placement="top" title="Explore your jump responses" href="#"><font color="#777"><strong><?php echo count($model->user_jump_responses); ?> responses</strong></font></a></li>
  	  <?php if(isset($_SESSION["jump_user_id"])):?>
	  <?php if($_SESSION["jump_user_id"] == $model->id):?>
	  <li><a rel="tooltip" data-toggle="tooltip" data-placement="top" title="Explore your settings" href="/jump/user/update/<?php echo $_SESSION["jump_user_id"]; ?>"><font class="lsf" color="#777" size="3px">gear</font></a></li>
	  <?php endif?>
	  <?php if($_SESSION["jump_user_id"] == $model->id):?>
	  <?php if($model->pinned == 0):?>
	  <li><a rel="tooltip" data-toggle="tooltip" data-placement="top" title="Pin your position" href="#"><font id="pin" class="lsf" style="height:1px;" color="#777" size="3px">pin</font></a></li>
	  <?php endif?>
	  <?php if($model->pinned == 1):?>
	  <li><a rel="tooltip" data-toggle="tooltip" data-placement="top" title="Deactivate your position pin" href="#"><font id="pin" class="lsf" style="height:2px;" color="#62C462" size="3px">pin</font></a></li>
	  <?php endif?>
	  <li id="explore"><a rel="tooltip" data-toggle="tooltip" data-placement="top" title="Explore and set your position" href="#"><font class="lsf" color="#777" size="3px">geo</font></a></li>
	  <?php endif?>
	  <?php endif?>
	  <li><a rel="tooltip" data-toggle="tooltip" data-placement="top" title="Explore your followers" href="#"><font color="#777"><strong><?php echo $this->getFollowers($model->id); ?> followers</strong></font></a></li>
	  <li><a rel="tooltip" data-toggle="tooltip" data-placement="top" title="Explore who are you following" href="#"><font color="#777"><strong><?php echo $this->getFollowings($model->id); ?> following</strong></font></a></li>
	</ul>
</div>

<div class="jump-separator-horizontal"></div>
<div class="row">
  <div class="span3">
    <h3><?php echo $model->first_name." ".$model->last_name; ?></h3>
  </div>
  <div class="span5">
    <div class="jump-badges-user">
    <?php
	for($i=0;$i<count($model->badges);$i++){
	 $badge = Badge::model()->findByPk($model->badges[$i]->badge_id);
	 echo '<img src="/jump/images/'.$badge->img.'" 
rel="tooltip" data-toggle="tooltip" data-placement="top" title="'.$badge->title.'" >&nbsp;';
	}
    ?>
    </div>
  </div>
</div>
</div>
<div class="jump-separator-horizontal"></div>

<div class="row">
 <div class="span8 jump-main">
  <div class="row">
   <div class="span1">
       <div class="jump-user-section">
          <div class="jump-user-section-search">
             <a href="#" title="Search jumps by category" style="text-decoration:none">
		<font class="lsf" size="20px">&nbsp;search</font>
	     </a>
          </div>
       </div>
   </div>
   <div class="span1">
       <div class="jump-user-section">
	  <div class="jump-user-section-location">
             <a href="#" title="Explore jumps in your area" style="text-decoration:none">
		<font class="lsf" size="20px">&nbsp;pin</font>
	     </a>
	  </div>
       </div>
   </div>
   <div class="span1">
       <div class="jump-user-section">
          <div class="jump-user-section-jump">
             <a href="#" title="Add a jump request" style="text-decoration:none">
		<font class="lsf" size="20px">plus</font>
	     </a>
 	  </div>
       </div>
   </div>
   <div class="span5 jump-lateral-albums">
       <div class="jump-user-section">
		<div class="jump-user-albums" rel="tooltip" data-toggle="tooltip" data-placement="top" title="<?php echo $model->first_name;?> brands and shops">
 		 <img id="image-brand" src="http://profile.ak.fbcdn.net/hprofile-ak-snc7/s160x160/398839_10150820564473888_31237359_a.jpg" class="img-polaroid">
 		 <img src="/jump/images/empty-album.png" class="img-polaroid">
 		 <img src="/jump/images/empty-album.png" class="img-polaroid">
 		 <img src="/jump/images/empty-album.png" class="img-polaroid">
		</div>
		<br/>
       </div>
   </div>
 </div>
 </div>
 <div class="span3 jump-lateral">
   <div class="jump-user-container-external">
   <br/>
   <center>
   <a title="Show <?php echo $model->first_name;?> tags" href="#" style="text-decoration:none;"><font size="8px" class="lsf">tag</font></a>&nbsp;
   <a title="Show <?php echo $model->first_name;?> activity" href="#" style="text-decoration:none;"><font size="8px" class="lsf">earth</font></a>&nbsp;
   <a title="<?php echo $model->first_name;?> site on Facebook" target="_blank" href='<?php echo $model->external_site->url; ?>' style="text-decoration:none;"><font size="8px" class="lsf">facebook</font></a>&nbsp;
   <?php
     $name = $model->first_name." ".$model->last_name." site on Pinterest";
     $external_site = ExternalSite::model()->find('name=:name', array(':name'=>$name));
     if(!is_null($external_site)){
	echo '<a title="'.$model->first_name.' site on Pinterest" target="_blank" href="'.$external_site->url.'" style="text-decoration:none;"><font size="8px" class="lsf">pinterest</font></a>';
     }
   ?>
   </center>
   </div>
   <div class="jump-user-container-friends">
   <small><strong><font color="#5C5C5C">Friends to follow</font></strong>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" style="text-decoration:none;"><font color="#858585">Invite more</font></a></small>
   <hr />
   <ul class="media-list">
<?php
    $counter_friends = 0;
    for($i=0;$i<count($model->friends) && $counter_friends<2;$i++){
        if($model->friends[$i]["suggestion"] == 1){
	     $userFriend = User::model()->findByPk($model->friends[$i]["following_id"]);
  	     if(isset($_SESSION["jump_user_id"]))
		     $friend_facebook = Yii::app()->facebook->api('/'.$userFriend->id.'?fields=picture&access_token='.$_SESSION["access_token"]);
	     else
		     $friend_facebook = Yii::app()->facebook->api('/'.$userFriend->id.'?fields=picture');
	     echo '<li class="media">';
	     echo '<div class="jump-friend-badge"><a title="View '.$userFriend->first_name.' profile" href="'.$userFriend->id.'"><img alt="View profile in Jump" src="'.$friend_facebook["picture"]["data"]["url"].'"></a></div>';
     	     echo '<div class="media-body"><small>'.$userFriend->first_name.' '.$userFriend->last_name.'</small><br/>';
	     echo '<button class="btn btn-mini btn-primary btn-success" type="button">Follow</button></div></li>';
	     $counter_friends++;
	}
    }
?>
   </ul>
   </div>
 </div>
</div>