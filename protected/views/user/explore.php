<?php
if(!isset($_SESSION))
      session_start();
/* @var $this UserController */
/* @var $model User */
?>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=false"></script>
<script type="text/javascript">
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
                  url:'<?php echo Yii::app()->homeUrl ?>user/explore/<?php echo $model->id ?>?google-map=1',
                  type: 'GET',
                  data: {"geoposition_lat":pos.lat(),
                         "geoposition_long":pos.lng()},
                  success:  function (response) {
                    $('span#near_people').html(response);
                  }
                });

        });
      }

      $.ajax({
              url:'<?php echo Yii::app()->homeUrl ?>user/explore/<?php echo $model->id ?>?google-map=1',
          type: 'GET',
          data: {"geoposition_lat":pos.lat(),
                 "geoposition_long":pos.lng()},
          success:  function (response) {
            $('span#near_people').html(response);
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

      function makeInfoWindowEvent(map, infowindow, contentString, marker) {
         google.maps.event.addListener(marker, 'click', function() {
         infowindow.setContent(contentString);
        infowindow.open(map, marker);
        });
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

<div class="map-user-container">
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
   <center><div id="map_canvas" style="width:100%; height:600px"></div></center>
   <span id="near_people"></span>
</div>
</div>
<div class="user-tools">
  <ul class="nav nav-pills">
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
  </ul>
</div>

<div class="jump-separator-horizontal"></div>
<div class="row">
</div>
</div>
<div class="jump-separator-horizontal"></div>
<h2>Explore</h2>
<p>Hello <?php echo $_SESSION["jump_user_name"]; ?>, here you can explore your area filtering by your preferences. These preferences drive the product suggestions and are categorized from Facebook. The priority of each preference is obtained from your 'likes' on Facebook and from your activity on Jump, so it is a self-calculated and non-editable parameter.
<form action="<?php echo Yii::app()->homeUrl ?>#" method="post">
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
    <button class="btn btn-large btn-block btn-primary" type="submit">Launch a Campaign here!</a></button>
    </div>
</fieldset>
</div>
</form>

</div>

