<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/css/bootstrap-theme.min.css" /> 
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/css/idangerous.swiper.css" /> 
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/css/animate.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/css/alertify.core.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/css/alertify.default.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/jump.css" />

	<title><?php echo CHtml::encode("Jump"); ?></title>

	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/js/holder.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/js/idangerous.swiper-2.3.min.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/js/jPushMenu.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/js/classie.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/js/uisearch.js"></script>
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=false"></script>
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=drawing&sensor=false"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/js/richmarker.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/js/alertify.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/js/typeahead.bundle.js"></script> 
	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/js/jquery.cookie.js"></script> 

	<?php if((Yii::app()->controller->id != "user") || (Yii::app()->controller->action->id != "update")):?>
	<?php if((Yii::app()->controller->id != "user") || (Yii::app()->controller->action->id != "friends")):?>

	<script type="text/javascript" >
	$(document).ready(function($) {
		$('.jump-jumbotron').css({'display':'block'});
		$('.jump-jumbotron').addClass('animated fadeInDown');
		$('.toggle-menu').jPushMenu();
		$('#search-trigger').hover(
			function(){
				$('#search-button').css({'text-decoration':'none','background': 'rgb(163, 212, 144)','color': '#fff'});
			},
			function(){
				$('#search-button').css({'background': '#f7f7f7','color': '#999'});
			}
		);
		var mySwiper = $('.swiper-container').swiper({
			pagination: '.swiper-pagination',
    		paginationClickable: true,
    		slidesPerView: 6,
    		watchActiveIndex: true
    	});
    <?php if(isset(Yii::app()->session["jump_user_id"])):?>
    	$('#explore-button').on("click", function() {
        	if($('#menu-explore').hasClass('current')){
        		$('#menu-explore').removeClass('current');
        		$.ajax({
        			url: '<?php echo Yii::app()->homeUrl ?>site/explore?pinned=0&uid=<?php echo Yii::app()->session["jump_user_id"]; ?>',
            		type: 'post',
            		success:  function (response) {}
        		});
	        }else{
	        	$('#menu-explore').addClass('current');
	        	$.ajax({
        			url: '<?php echo Yii::app()->homeUrl ?>site/explore?pinned=1&uid=<?php echo Yii::app()->session["jump_user_id"]; ?>',
            		type: 'post',
            		success:  function (response) {}
        		});
	        }
   		});
   		
   	<?php endif?>
        
        $('#pages-button').on( "click", function() {
        	if($('#menu-pages').hasClass('current')){
        		$('#menu-pages').removeClass('current');
        		$('#pages-slider').removeClass('animated bounceInDown');
        		$('#pages-slider').addClass('animated fadeOutUp');
	        }else{
	        	$('#menu-pages').addClass('current');
	        	$('#pages-slider').css({'z-index':'100'});
	        	$('#pages-slider').css({'background-color':'rgba(124, 131, 122, 0.45)'});
	        	$('#pages-slider img').css({'display':'block'});
	        	$('#pages-slider').removeClass('animated fadeOutUp');
        		$('#pages-slider').addClass('animated bounceInDown');
	        }
   		});

   		

        /* typeahead configuration */
        var sanitized = "";
		var pages = new Bloodhound({
		    datumTokenizer: function (d) {
		        return Bloodhound.tokenizers.whitespace(d.value);
		    },
		    queryTokenizer: Bloodhound.tokenizers.whitespace,
		    remote: {
     		   url: 'https://graph.facebook.com/search?access_token=<?php echo Yii::app()->session["access_token"];?>&type=page&q=%QUERY',
		        filter: function (pages) {
		        	var pages_ = pages.data.slice(0,5);
		            return $.map(pages_, function (page) {
		            	$.getJSON('https://graph.facebook.com/'+page.id+'/?access_token=<?php echo Yii::app()->session["access_token"];?>&fields=picture', function(json) {
						  localStorage.setItem("img_fbpage_"+page.id,json["picture"]["data"]["url"]);
						 });
		            	var string_img = "";
		            	if (localStorage.getItem("img_fbpage_"+page.id) != null)
		            		string_img = '<img src="'+localStorage.getItem("img_fbpage_"+page.id)+'" >';
		                return {
		                	value: '<a href="/jump/brand/'+page.id+'">'+string_img+'&nbsp;'+page.name+'</a>'
		                };
		            });
		        }
		    }
		});

		pages.initialize();

		$('.typeahead').typeahead(null, {
		    displayKey: 'value',
		    source: pages.ttAdapter(),
		});

		$('.typeahead').on('typeahead:selected', function($e, datum){
			var init_pos = datum.value.indexOf("/jump/brand/");
			var end_pos = datum.value.indexOf(">")-1;
			var ref = datum.value.substring(init_pos,end_pos);
			var body = datum.value;
			var temp = document.createElement("div");
			temp.innerHTML = body;
			sanitized = temp.textContent || temp.innerText;
        	document.getElementById("pages").value=sanitized;
        	if($(this).hasClass("sb-search-input")){
        		document.location.href = ref;
        	}else{
        		// alert(ref);
        		document.getElementById("input-jump-brand").value = sanitized;

        	}
        });

        $('.typeahead').on('typeahead:autocompleted', function($e, datum){
			var body = datum.value;
			var temp = document.createElement("div");
			temp.innerHTML = body;
			sanitized = temp.textContent || temp.innerText;
        	document.getElementById("pages").value=sanitized;
        });

		$('.typeahead').on('typeahead:cursorchanged', function($e, datum){
			var body = datum.value;
			var temp = document.createElement("div");
			temp.innerHTML = body;
			sanitized = temp.textContent || temp.innerText;
        	document.getElementById("pages").value=sanitized;
        	document.getElementById("input-jump-brand").value=sanitized;
        });

        $('.typeahead').focusout(function(){
        	if(!$(this).hasClass("sb-search-input")){
        		var text = document.getElementById("input-jump-brand").value;
        		document.getElementById("input-jump-brand").value = sanitized;
				$(this).typeahead('destroy');
				$(this).typeahead(null, {
				    displayKey: 'value',
				    source: pages.ttAdapter(),
				})
			}
        }); 

		/* modals */
		$("#update-user").on( "click", function() {
		  event.preventDefault();
		  $('#update-user-modal').modal('show');
		});

		$("#friends-user").on( "click", function() {
		  event.preventDefault();
		  $('#friends-user-modal').modal('show');
		});

/*		$(document).on('hidden.bs.modal', function () {
        	$('.modal').removeData("bs.modal").find(".modal-content").empty();
			$('.modal').removeData('bs.modal');
			$('.modal').empty();
        });
*/
		$('#update-user-modal').on('hidden.bs.modal', function(){
			$(this).removeData("bs.modal").find(".modal-content").empty();
			$(this).removeData('bs.modal');
			$(this).empty();		
			var ttahead = document.getElementsByClassName('twitter-typeahead');
			var ttaheaddelete = ttahead[1];
			if(ttaheaddelete !== undefined)
				ttaheaddelete.parentNode.removeChild(ttaheaddelete);
		});

	/*	$('#update-user-modal').on('hidden.bs.modal', function(e){
			$(e.target).removeData("bs.modal").find(".modal-content").empty();
			$(this).removeData('bs.modal');
			$(this).empty();		
		});
*/
		$('#friends-user-modal').on('hidden.bs.modal', function(){
			$(this).removeData("bs.modal").find(".modal-content").empty();
			$(this).removeData('bs.modal');
			$(this).empty();		
			var ttahead = document.getElementsByClassName('twitter-typeahead');
			var ttaheaddelete = ttahead[1];
			if(ttaheaddelete !== undefined)
				ttaheaddelete.parentNode.removeChild(ttaheaddelete);
		});

/*		$('#friends-user-modal').on('hidden.bs.modal', function(e){
			$(e.target).removeData("bs.modal").find(".modal-content").empty();
			$(this).removeData('bs.modal');
			$(this).empty();		
		});
*/

   		$('a[href*=#]:not([href=#])').click(function() {
	     if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
	      var target = $(this.hash);
	      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
	      if (target.length) {
	        $('html,body').animate({
	          scrollTop: target.offset().top
	        }, 1000);
	        return false;
	      }
	     }
	  	});
	});
	</script>
	<?php endif?>
	<?php endif?>
</head>

<body>

	<!-- page admin slider -->
	<?php if(isset(Yii::app()->session["jump_user_id"])):?>
	<?php if((Yii::app()->controller->id != "user") || (Yii::app()->controller->action->id != "update")):?>
	<?php if((Yii::app()->controller->id != "user") || (Yii::app()->controller->action->id != "friends")):?>
	<div id="pages-slider" class="pages-slider">
		<?php 
		 $response = '<div class="swiper-container"><div id="swiper-wrapper" class="swiper-wrapper">';
		 Yii::app()->facebook->setAccessToken(Yii::app()->session["access_token"]);
		 $pages = Yii::app()->facebook->api('/'.Yii::app()->session["jump_user_id"].'/accounts');
		 foreach($pages["data"] as $page){
		 	$page_detail = Yii::app()->facebook->api('/'.$page["id"]);
		    if(isset($page_detail["is_published"])){
		    	if($page_detail["is_published"] == "true"){
				    $response = $response.'<div id="swiper-slide" class="swiper-slide">';
					$page_photo = Yii::app()->facebook->api('/'.$page["id"].'/?fields=picture');		
					$response = $response.'<a href="'.$page_detail["link"].'?sk=insights" target="_blank">';
					$response = $response.'<img src="'.$page_photo["picture"]["data"]["url"].'" alt="'.$page_detail["name"].'" class="img-thumbnail img-responsive">';
					$response = $response.'</a>';
					$response = $response.'</div>';
				}
			}
		 }
		 $response = $response.'<div id="swiper-slide" class="swiper-slide"><img src="'.Yii::app()->baseUrl.'/images/follow_page_button.png" alt="..." class="img-thumbnail-button img-responsive"></div>';
		 $response = $response.'</div></div>';
         echo $response;
        ?>
		<div class="swiper-pagination"></div>
	</div>
	<?php endif?>
	<?php endif?>
	<?php endif?>
	
	<!-- photo profile -->
	<?php if(isset(Yii::app()->session["jump_user_id"])):?>
	<?php if((Yii::app()->controller->id != "user") || (Yii::app()->controller->action->id != "update")):?>
	<?php if((Yii::app()->controller->id != "user") || (Yii::app()->controller->action->id != "friends")):?>
	<div class="img-profile">
    	<img src="<?php echo Yii::app()->session["jump_user_photo"]?>" class="img-circle img-responsive">
    </div>
    <?php endif?>
    <?php endif?>
	<?php endif?>

	<!-- search bar -->
	<?php if(isset(Yii::app()->session["jump_user_id"])):?>
	<?php if((Yii::app()->controller->id != "user") || (Yii::app()->controller->action->id != "update")):?>
	<?php if((Yii::app()->controller->id != "user") || (Yii::app()->controller->action->id != "friends")):?>
	<div id="sb-search" class="sb-search">
		<form id="search">
			<input class="sb-search-submit" type="submit" value="">
			<a id="search-trigger" href="#" class="sb-icon-search icon-search" alt="<?php echo Yii::t('strings','Search'); ?>"></a>
			<input id="pages" autocomplete="off" class="sb-search-input typeahead" placeholder="<?php echo Yii::t('strings','What are you looking for?');?>" type="search" value="" name="search">
		</form>
	</div>
	<?php endif?>
	<?php endif?>
	<?php endif?>
	
	<!-- launcher menu -->
	<?php if(isset(Yii::app()->session["jump_user_id"])):?>
	<?php if((Yii::app()->controller->id != "user") || (Yii::app()->controller->action->id != "update")):?>
	<?php if((Yii::app()->controller->id != "user") || (Yii::app()->controller->action->id != "friends")):?>
	<ul class="launcher-menu">
		<li><a href="#" class="icon-logo" ></a></li>
		<li><a id="search-button" href="#" class="icon-search" alt="<?php echo Yii::t('strings','Search'); ?>"><?php echo Yii::t('strings','Search'); ?></a></li>	
		<li id="menu-campaigns"><a id="campaigns-button" href="#" class="icon-campaigns" alt="<?php echo Yii::t('strings','Campaigns'); ?>"><?php echo Yii::t('strings','Campaigns'); ?></a></li>
		<?php if(Yii::app()->session["pinned"] != 0):?>
			<li id="menu-explore" class="current">
		<?php endif?>
		<?php if(Yii::app()->session["pinned"] != 1):?>
			<li id="menu-explore">
		<?php endif?>
			<a id="explore-button" href="#" class="icon-explore" alt="<?php echo Yii::t('strings','Explore'); ?>"><?php echo Yii::t('strings','Explore'); ?></a></li>
		<li id="menu-pages"><a id="pages-button" href="#" class="icon-mypages" alt="<?php echo Yii::t('strings','My Pages'); ?>"><?php echo Yii::t('strings','My Pages'); ?></a></li>
		<li id="menu-channels"><a href="#" class="icon-channels" alt="<?php echo Yii::t('strings','Channels'); ?>"><?php echo Yii::t('strings','Channels'); ?></a></li>
		<li><a href="#" class="icon-settings toggle-menu menu-right push-body" alt="<?php echo Yii::t('strings','Settings'); ?>"><?php echo Yii::t('strings','Settings'); ?></a></li>
	</ul>
	<?php endif?>
	<?php endif?>
	<?php endif?> 

	<!-- push menu -->
	<?php if(isset(Yii::app()->session["jump_user_id"])):?>
	<?php if((Yii::app()->controller->id != "user") || (Yii::app()->controller->action->id != "update")):?>
	<?php if((Yii::app()->controller->id != "user") || (Yii::app()->controller->action->id != "friends")):?>
	<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right">
		<h2><pusher-menu-jump-logo>jump</pusher-menu-jump-logo></h2>
		<a id="update-user" href="#"><font class="symbol" size="5px">user</font>&nbsp;<?php echo strtoupper(Yii::app()->session["jump_user_name"]);?></a>
		<a id="friends-user" href="#"><font class="symbol" size="5px">group</font>&nbsp;<?php echo Yii::t('strings','FRIENDS'); ?></a>
		<a href="#"><font class="symbol" size="5px">tag</font>&nbsp;<?php echo Yii::t('strings','TAGS'); ?></a>
		<a href="#"><font class="symbol" size="5px">crown</font>&nbsp;<?php echo Yii::t('strings','BADGES'); ?></a>
		<a href="#"><font class="symbol" size="5px">help</font>&nbsp;<?php echo Yii::t('strings','HELP'); ?></a>
		<a href="<?php echo Yii::app()->baseUrl; ?>/site/logout"><font class="symbol" size="5px">out</font>&nbsp;<?php echo Yii::t('strings','LOGOUT'); ?></a>
	</nav>
	<?php endif?>
	<?php endif?>
	<?php endif?>

	<!-- content -->
	<?php if(isset(Yii::app()->session["jump_user_id"])):?>
	<div class="jump-container-logged" id="page">
	<?php endif?>
	<?php if(!isset(Yii::app()->session["jump_user_id"])):?>
	<div class="jump-container" id="page">
	<?php endif?>
		<?php echo $content; ?>
		<?php if(!isset(Yii::app()->session["jump_user_id"])):?>
			<div class="jump-jumbotron jumbotron">
				<div class="row">
  					<div class="col-xs-3">
  						<center><jump-logo id="jump-logo">jump</jump-logo></center>
  					</div>
  					<div class="col-xs-9">
  						<h2><?php echo Yii::t('strings','Locate your likes, promote your desires and explore interests');?></h2>
  						<p><a href="<?php echo Yii::app()->baseUrl; ?>/site/login" class="btn btn-primary btn-lg" role="button"><?php echo Yii::t('strings','Login with Facebook');?></a>&nbsp;<a class="btn btn-default" href="#learn-more" role="button"><?php echo Yii::t('strings','Learn more');?></a></p>
					</div>
				</div>
			</div>
		<?php endif?>
		<div id="learn-more"></div>
	<?php if((Yii::app()->controller->id != "user") || (Yii::app()->controller->action->id != "update")):?>
	<?php if((Yii::app()->controller->id != "user") || (Yii::app()->controller->action->id != "friends")):?>
		<div id="footer" class="footer">
			<center>
				<footer-jump-logo>jump</footer-jump-logo> &copy; 2014.
				<a href="#">&nbsp;<?php echo Yii::t('strings','About'); ?></a>&nbsp;|&nbsp;
				<a href="#" target="_blank"><?php echo Yii::t('strings','Blog'); ?></a>&nbsp;|&nbsp;
				<a href="#"><?php echo Yii::t('strings','Business'); ?></a>&nbsp;|&nbsp;
				<a href="#"><?php echo Yii::t('strings','Developers'); ?></a>&nbsp;|&nbsp;
				<a href="#"><?php echo Yii::t('strings','Terms and Conditions'); ?></a>
			</center>
		</div>	
	<?php endif?>
	<?php endif?>
</div>

	<!-- update user modal -->
	<div class="jump-modal modal fade" id="update-user-modal" tabindex="-1" role="dialog" aria-labelledby="update" aria-hidden="true" data-remote="<?php echo Yii::app()->baseUrl; ?>/user/update/<?php echo Yii::app()->session["jump_user_id"]; ?>" >
	  <div class="jump-modal-dialog modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h2 class="modal-title"><?php echo Yii::t('strings','Edit Account Settings'); ?></h2>
	      </div>
	      <div class="modal-body"><center><img src="<?php echo Yii::app()->baseUrl; ?>/images/jump-loader.gif"></center>
	      </div>
	      <div class="modal-footer">
	      </div>
	    </div>
	  </div>
	</div>

	<!-- friends user modal -->
	<div class="jump-modal modal fade" id="friends-user-modal" tabindex="-1" role="dialog" aria-labelledby="update" aria-hidden="true" data-remote="<?php echo Yii::app()->baseUrl; ?>/user/friends/<?php echo Yii::app()->session["jump_user_id"]; ?>" >
	  <div class="jump-modal-dialog modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h2 class="modal-title"><?php echo Yii::t('strings','Friends to follow');?></h2>
	      </div>
	      <div class="modal-body"><center><img src="<?php echo Yii::app()->baseUrl; ?>/images/jump-loader.gif"></center>
	      </div>
	      <div class="modal-footer">
	      </div>
	    </div>
	  </div>
	</div>	


</body>
<?php if(isset(Yii::app()->session["jump_user_id"])):?>
<script type="text/javascript">
	new UISearch(document.getElementById('sb-search'));
</script>
<?php endif?>

</html>

