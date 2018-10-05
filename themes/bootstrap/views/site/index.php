<!-- load map -->


<?php if($this->beginCache(Yii::app()->session["jump_user_id"])) { ?>

<script type="text/javascript">
  var map;
  var pos;
  var mapHeight = 0;
  var marker;
  var jumpcircle;
 
  function initialize() {
    var mapOptions = {
      zoom: 15,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      streetViewControl: false,
      mapTypeControl: false
    };
    map = new google.maps.Map(document.getElementById('map_jump'), mapOptions);
    if(navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        pos = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
        <?php if(isset(Yii::app()->session["welcome"])):?>
          <?php if(Yii::app()->session["welcome"]=="yes"):?>
            pos = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
          <?php endif?>
        <?php endif?>
        <?php if(isset(Yii::app()->session["jump_user_geoposition_lat"])):?>
          pos = new google.maps.LatLng(<?php echo Yii::app()->session["jump_user_geoposition_lat"].','.Yii::app()->session["jump_user_geoposition_long"]; ?>);
        <?php endif?>
        map.setCenter(pos);
    
    <?php if(isset(Yii::app()->session["jump_user_id"])):?>
        marker = new RichMarker({
          map: map,
          position: pos,
          flat: true,
          draggable: true,
          content: '<div class="img-thumbnail img-circle"><div class="img-thumbnail img-circle img-marker"><img class="img-circle" src="<?php echo Yii::app()->session["jump_user_photo"]; ?>"></div></div>'
        });

        google.maps.event.addListener(marker, "dragend", function() {
          pos = marker.getPosition();
          map.panTo(pos);
          $.ajax({
            url:'<?php echo Yii::app()->homeUrl; ?>site/geoposition?geoposition_lat='+pos.lat()+'&geoposition_long='+pos.lng()+'&uid=<?php echo Yii::app()->session["jump_user_id"]; ?>',
            type: 'post',
            success:  function (response) {}
          });
          $.ajax({
            url:'<?php echo Yii::app()->homeUrl; ?>site/markers?uid=<?php echo Yii::app()->session["jump_user_id"];?>',
            type: 'post',
            success:  function (response) { 
              $("#friends_markers").html(response); 
            }
          });
        });

        $.ajax({
          url:'<?php echo Yii::app()->homeUrl; ?>site/geoposition?geoposition_lat='+pos.lat()+'&geoposition_long='+pos.lng()+'&uid=<?php echo Yii::app()->session["jump_user_id"]; ?>',
          type: 'post',
          success:  function (response) {}
        });


        var drawingManager = new google.maps.drawing.DrawingManager({
          drawingMode: google.maps.drawing.OverlayType.CIRCLE,
          drawingControl: false,
          circleOptions: {
            fillColor: '#a3d490',
            fillOpacity: 0.5,
            strokeWeight: 0,
            clickable: false,
            zIndex: 1,
            editable: false,
            draggable: false
          }
        });

        google.maps.event.addListener(drawingManager, 'circlecomplete', function(circle) {
          jumpcircle = circle;
          $('.jump-campaign-wizzard').css({'display':'block'});
          drawingManager.setMap(null);
        });

        $('#campaigns-button').on("click",function(){
          if($('#menu-campaigns').hasClass('current')){
            $('#menu-campaigns').removeClass('current');
          }else{
            $('#menu-campaigns').addClass('current');
            if(!$.cookie('modal_dismiss')){
              $('#jump-campaign-modal-step1').modal('show');
            }else{
              drawingManager.setMap(map);
              alertify.log(<?php echo Yii::t('strings','"Select area"'); ?>);
            }
          }
        });

        $('#select-area').on("click", function(){
            drawingManager.setMap(map);
            var status = $("input[name=dismiss]", this).is(":checked");
            $.cookie('modal_dismiss', status, {
                expires: 7,
                path: '/'
            });
        });

        $('#undo-jump-campaign').on("click",function(){
          jumpcircle.setMap(null);
          drawingManager.setMap(map);
        });

        $('#cancel-jump-campaign').on("click",function(){
          jumpcircle.setMap(null);
          drawingManager.setMap(null);
          $('.jump-campaign-wizzard').css({'display':'none'});
          $('#menu-campaigns').removeClass('current');
        });

        $('#confirm-jump-campaign').on("click",function(){
          drawingManager.setMap(null);
          $('.jump-campaign-wizzard').css({'display':'none'});
          $('#jump-campaign-modal-step2').modal('show');
        });

       $('#input-jump-brand').on("change",function(e){
          console.log($(this).val());
        });
   

    <?php endif?>

      }, function() {
        handleNoGeolocation(true);
      });
    } else {
      handleNoGeolocation(false);
    }


  <?php if(isset(Yii::app()->session["jump_user_id"])):?>

    var input = document.getElementById("keyword");
    var autocomplete = new google.maps.places.Autocomplete(input);
     

    $("#search").submit(function(event) {
      event.preventDefault();
      var place = autocomplete.getPlace();
    
      if (place.geometry.viewport) {
        map.fitBounds(place.geometry.viewport);
      } else {
        map.setCenter(place.geometry.location);
      }
      marker.setPosition(place.geometry.location);
      pos = marker.getPosition();
      map.panTo(pos);
      map.setZoom(18);

      $.ajax({
          url:'<?php echo Yii::app()->homeUrl; ?>site/geoposition?geoposition_lat='+pos.lat()+'&geoposition_long='+pos.lng()+'&uid=<?php echo Yii::app()->session["jump_user_id"]; ?>',
          type: 'post',
          success:  function (response) {}
      });

    });

    google.maps.event.addListener(map, "click", function(event)
    {
          marker.setPosition(event.latLng);
    });
  <?php endif?>

  
    google.maps.event.addDomListener(window, 'resize', function() {
      var center = map.getCenter();
      google.maps.event.trigger(map, "resize");
      map.setCenter(center);
      var H = $(window).height();
      $('#map_jump').height(H-=10);
    });
  }
  
  function handleNoGeolocation(errorFlag) {
    if (errorFlag) {
      var content = 'Error: The Geolocation service failed.';
    } else {
      var content = 'Error: Your browser does not support geolocation.';
    }
    alert(content);
  }
 
$(document).ready(function(){
  google.maps.event.addDomListener(window, 'load', initialize);
  var H = $(window).height();
  $('#map_jump').height(H-=10);

  <?php if(isset(Yii::app()->session["jump_user_id"])):?>
    <?php if(isset(Yii::app()->session["welcome"])):?>
      <?php if(Yii::app()->session["welcome"]=="no"):?>
       $.ajax({
        url:'<?php echo Yii::app()->homeUrl; ?>site/markers?uid=<?php echo Yii::app()->session["jump_user_id"];?>',
        type: 'post',
        beforeSend: function () { 
              alertify.set({delay: 5000});
              alertify.log(<?php echo Yii::t('strings','"Retrieving friends positions in your area ... It could take a while"');?>);
        },
        success:  function (response) {
         $("#friends_markers").html(response); 
         alertify.set({delay: 5000});
         alertify.success(<?php echo Yii::t('strings','"Friends positions loaded!"');?>);
        }
       });
      <?php endif?>  
      <?php if(Yii::app()->session['welcome'] == 'yes'):?>
        $.ajax({
            url:'<?php echo Yii::app()->homeUrl ?>site/populate',
            type: 'post',
            beforeSend: function () { 
              alertify.set({delay: 5000});
              alertify.log(<?php echo Yii::t('strings','"Populating friends positions in your area  ... It could take a while"');?>);
            },
            success:  function (response) {
                $("#friends").html(response);
                alertify.set({delay: 5000});
                alertify.success(<?php echo Yii::t('strings','"Friends positions populated!"');?>);
            }
        });
      <?php endif?>
    <?php endif?>
  <?php endif?>
});
</script>

<div id="map_jump" style="background: url(<?php echo Yii::app()->baseUrl; ?>/images/jump-background.png) repeat 50% 50%;width:120%;margin-left:-10px;margin-top:-15px;"></div>
<span id="friends"></span>
<span id="friends_markers"></span>
<div class="jump-campaign-wizzard">
  <button id="confirm-jump-campaign" type="button" class="btn btn-success"><?php echo Yii::t('strings','Confirm');?></button>
  <button id="undo-jump-campaign" type="button" class="btn btn-default"><?php echo Yii::t('strings','Undo');?></button>
  <button id="cancel-jump-campaign" type="button" class="btn btn-danger"><?php echo Yii::t('strings','Cancel');?></button>
</div>
<?php $this->endCache(); } ?>


<!-- Jump Campaign Modal -->
<!-- step 1 -->
<div class="jump-modal modal fade" id="jump-campaign-modal-step1" tabindex="-1" role="dialog" aria-labelledby="update" aria-hidden="true">
  <div class="jump-modal-dialog-wizzard-step1 modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title"><?php echo Yii::t('strings','Create a Jump Request'); ?></h2>
      </div>
      <div class="modal-body"><?php echo Yii::t('strings','First, you will have to select the area on which to implement the campaign');?>
      </div>
      <div class="modal-footer">
        <div class="checkbox">
          <label>
            <input type="checkbox" name="dismiss"><?php echo Yii::t('strings','Please, do not show this message again');?>
          </label>
        </div>
         <button id="select-area" type="button" class="btn btn-primary" data-dismiss="modal"><?php echo Yii::t('strings','Select area');?></button>
      </div>
    </div>
  </div>
</div>

<!-- step 2 -->
<div class="jump-modal modal fade" id="jump-campaign-modal-step2" tabindex="-1" role="dialog" aria-labelledby="update" aria-hidden="true">
  <div class="jump-modal-dialog-wizzard-step2 modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title"><?php echo Yii::t('strings','Create a Jump Request'); ?></h2>
      </div>
      <div class="modal-body"><div class="modal-tip"><?php echo Yii::t('strings','Once area has been selected, please provide Jump details');?></div>
        <form class="form-horizontal" role="form">
          <div class="form-group">
            <label for="input-jump-brand" class="col-sm-2 control-label"><?php echo Yii::t('strings','Brand');?></label>
            <div class="col-sm-10">
              <input class="form-control typeahead" id="input-jump-brand" placeholder="<?php echo Yii::t('strings','Please, introduce a brand');?>">
            </div>
          </div>
          <div class="form-group">
            <label for="input-jump-name" class="col-sm-2 control-label"><?php echo Yii::t('strings','Name');?></label>
            <div class="col-sm-10">
              <input class="form-control" id="input-jump-name" placeholder="<?php echo Yii::t('strings','Please, introduce a descriptive Jump name');?>">
            </div>
          </div>
          <div class="form-group">
            <label for="input-jump-description" class="col-sm-2 control-label"><?php echo Yii::t('strings','Description');?></label>
            <div class="col-sm-10">
              <textarea class="form-control" rows="3" id="input-jump-description"></textarea>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
         <button id="confirm-data-jump" type="button" class="btn btn-primary" data-dismiss="modal"><?php echo Yii::t('strings','Continue');?></button>
      </div>
    </div>
  </div>
</div>


<!--

<?php if(isset(Yii::app()->session["jump_user_id"])):?>

<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/bubbletree/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/bubbletree/jquery.history.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/bubbletree/raphael-min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/bubbletree/vis4.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/bubbletree/Tween.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/bubbletree/bubbletree.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bubbletree/bubbletree.css" />  

<script type="text/javascript">
 
    $(function() {

      var data = {
        label: 'Your preferences',
        amount: 100,
        color: '#A3D490',
        children: [
          <?php
            $preferences_categories_ = PreferencesCategories::model()->findAll('user_id=:user_id', array(':user_id'=>Yii::app()->session["jump_user_id"]));
            $max = 0;
            foreach($preferences_categories_ as $preferences_category){
              $max = $max + $preferences_category["count"];
            }

            $preferences_categories = PreferencesCategories::model()->findAll('user_id=:user_id', array(':user_id'=>Yii::app()->session["jump_user_id"]));
            $i = 0;
            foreach($preferences_categories as $preferences_category){
              $category_id = $preferences_category["category_id"];
              $category = Category::model()->findByPk($category_id);
              $count = $preferences_category["count"];
              $value = round($count*100/$max);
              if($i != count($preferences_categories)-1)
                echo "{ label: '".$category->name."', amount: ".$value.", color: '#A3DA90' },";
              else
                echo "{ label: '".$category->name."', amount: ".$value.", color: '#A3DA90' }";
              $i++;
            }
          ?>
        ]
      };

      new BubbleTree({
        data: data,
        container: '.bubbletree'
      });
    });
  </script>

<div class="bubbletree-wrapper">
  <div class="bubbletree"></div>
</div>

<?php endif?>

-->