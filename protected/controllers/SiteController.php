<?php

class SiteController extends Controller
{
	public $access_token = '';
	public $welcome = "no";

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	* Performs an update of pinned status of current user
	*/
	public function actionExplore(){
		Yii::app()->session["pinned"] = $_GET["pinned"];
		$user = User::model()->findByPk($_GET["uid"]);
        $user->pinned = Yii::app()->session["pinned"];
	    $user->save();
	}


	/** 
	* Performs an update of user coords
	*/
	public function actionGeoposition(){
		if(isset(Yii::app()->session["jump_user_geoposition_lat"])){
            if(Yii::app()->session["jump_user_geoposition_lat"] != $_GET["geoposition_lat"]){
                Yii::app()->session["jump_user_geoposition_lat"] = $_GET["geoposition_lat"];
                Yii::app()->session["jump_user_geoposition_long"] = $_GET["geoposition_long"];
            }
        }else{
            Yii::app()->session["jump_user_geoposition_lat"] = $_GET["geoposition_lat"];
            Yii::app()->session["jump_user_geoposition_long"] = $_GET["geoposition_long"];
        }

        $user = User::model()->findByPk($_GET["uid"]);
        if(Yii::app()->session["pinned"] == 1){
	    	$user->geolocation_lat = Yii::app()->session["jump_user_geoposition_lat"];
	    	$user->geolocation_long = Yii::app()->session["jump_user_geoposition_long"];
	    	$user->save();
	    }else{
	    	if(isset(Yii::app()->session["welcome_pin"])){
	    		if(Yii::app()->session["welcome_pin"] == "yes"){
		    		$user->geolocation_lat = Yii::app()->session["jump_user_geoposition_lat"];
		    		$user->geolocation_long = Yii::app()->session["jump_user_geoposition_long"];
		    		$user->save();
		    		Yii::app()->session["welcome_pin"] = "no";
		    	}
	    	}
	    }
	}

	/** 
	* Performs a populate of logged user friends on database
	*/
	public function actionPopulate(){
		$response = "";
		Yii::app()->facebook->setAccessToken(Yii::app()->session["access_token"]);
		$this->access_token = Yii::app()->session["access_token"];
		if(!isset($_GET['uid'])){
			$response = '<script type="text/javascript">';
			$response = $response.'$(document).ready(function($) {';
			$user_id = Yii::app()->facebook->getUser();
			$friends_ = Yii::app()->facebook->api('/'.$user_id.'/friends?access_token='.$this->access_token);
			$friends = $friends_["data"];
			for ($i=0;$i<count($friends);$i++){
				$user = User::model()->findByPk($friends[$i]["id"]);
				if(is_null($user)){
					$response = $response." $.ajax({ url:'".Yii::app()->homeUrl."site/populate?uid=".$friends[$i]['id']."', type: 'post'});";
					$response = $response." $.ajax({ url:'".Yii::app()->homeUrl."site/markers?uid=".$user_id."&fid=".$friends[$i]['id']."', type: 'post', success: function (response) { $(\"#friends_markers\").html(response); }});";
				}
			}
			$response = $response.'});</script>';
		}else{
			$fb_user = Yii::app()->facebook->getInfoById($_GET['uid']);
			$user = User::model()->findByPk($_GET['uid']);

			if(is_null($user)){
			    $user = new User();
			    $user->id = $fb_user["id"];
			    $user->first_name = $fb_user["first_name"];
			    $user->last_name = $fb_user["last_name"];

			    $user->suggested_by = Yii::app()->session["jump_user_id"];
				    
			    $external_site = ExternalSite::model()->find('url=:url', array(':url'=>$fb_user["link"]));
			    if(is_null($external_site)){
					$external_site = new ExternalSite();
					$external_site->name = $fb_user["name"]." site on Facebook";
					$external_site->url = $fb_user["link"];
					$source = SourceType::model()->find('name=:name', array(':name'=>"Facebook"));
	 				$external_site->source = $source->id;
					$external_site->save();
			    }
			    $user->external_site_id = $external_site->id;
			    $user->external_site = $external_site;

				Yii::app()->facebook->setAccessToken(Yii::app()->session["access_token"]);
				$query = 'select current_location from user where uid = '.$_GET['uid'];
                $location = Yii::app()->facebook->api(array('method'=>'fql.query','query'=>$query));
    
                if(isset($location[0]["current_location"]["latitude"])){
                	$valid_coord = false;
                	while($valid_coord != true){
		                $user->geolocation_lat = $this->reubicateCoord($location[0]["current_location"]["latitude"]);
						$user->geolocation_long = $this->reubicateCoord($location[0]["current_location"]["longitude"]);
						$valid_coord = $this->validateCoord($user->geolocation_lat, $user->geolocation_long);
					}
				}
			    $user->save();
			}

			$likes_ = Yii::app()->facebook->api('/'.$_GET['uid'].'/likes?access_token='.$this->access_token);
		    $likes = $likes_["data"];

		    for ($i=0;$i<count($likes);$i++) {

				$category = Category::model()->find('name=:name', array(':name'=>$likes[$i]["category"]));
				if(!is_null($category)){
					$preferenceCategory = PreferencesCategories::model()->findByAttributes(array('user_id'=>$_GET['uid'],'category_id'=>$category->id));
					if(is_null($preferenceCategory)){
						$preferenceCategory = new PreferencesCategories();
						$preferenceCategory->user_id = $_GET['uid'];
						$preferenceCategory->user= $user;
						$preferenceCategory->category_id = $category->id;
						$preferenceCategory->category = $category;
						$preferenceCategory->count = 1;
					}else{
						$preferenceCategory->count++;
					}
					$preferenceCategory->save();
				}
		    }			
		}
		echo $response;
	}

	/**
	*  Creates the markers
	**/
	public function actionMarkers(){
		$response = '';
		Yii::app()->facebook->setAccessToken(Yii::app()->session["access_token"]);
		
		if(isset(Yii::app()->session["jump_user_id"]))
			$user_id = Yii::app()->session["jump_user_id"];

		if(isset($_GET['uid']))
			$user_id = $_GET['uid'];

		$user = User::model()->findByPk($user_id);
		if(!is_null($user) && $user->geolocation_lat != 0){
		    $distancesql = 'SELECT * , 3956 *2 * ASIN( SQRT( POWER( SIN( ( '.$user->geolocation_lat.' - ABS( geolocation_lat ) ) * PI( ) /180 /2 ) , 2 ) + COS( '.$user->geolocation_lat.' * PI( ) /180 ) * COS( ABS( geolocation_lat ) * PI( ) /180 ) * POWER( SIN( ('.$user->geolocation_long.' - geolocation_long) * PI( ) /180 /2 ) , 2 ) ) ) AS distance FROM user WHERE id !='.$user_id.' HAVING distance < 600 ORDER BY distance';
		    $dbconnection = Yii::app()->db;
            $cmd = $dbconnection->createCommand($distancesql);
            $near_users = $cmd->queryAll();
            $response = '<script type="text/javascript">';
            foreach($near_users as $near_user){
            	$photo_near_user = Yii::app()->facebook->api('/'.$near_user["id"].'/?fields=picture&access_token='.$this->access_token);

            	$response = $response.'if(typeof pos_'.$near_user["id"].' == "undefined") {';

            	$response = $response.'var pos_'.$near_user["id"].' = new google.maps.LatLng('.$near_user["geolocation_lat"].','.$near_user["geolocation_long"].');';

            	$response = $response."var marker_".$near_user["id"]." = new RichMarker({
            				map: map,
            				position: pos_".$near_user["id"].",
            				flat: true,
				            content: '<div class=\"img-thumbnail img-circle img-fb-marker\"><img class=\"img-circle\" src=\"".$photo_near_user["picture"]["data"]["url"]."\"></div>'});}";
            }           
			$response = $response.'</script>';
        }
        echo $response;
	}

	/**
	 * Performs a login using the login provider (Facebook)
	*/
	public function actionLogin(){

		$loginUrl = Yii::app()->facebook->getLoginUrl(array('scope' => 'user_friends,user_about_me,user_activities,user_groups,user_interests,user_likes,user_location,friends_interests,friends_likes,friends_location,read_friendlists,manage_pages'));
		$newLoginUrl= str_replace("&state=","?facebook-login=1&state=",$loginUrl);
		
		if(isset($_GET['facebook-login'])){

			$user_id = Yii::app()->facebook->getUser();
		    $fb_user = Yii::app()->facebook->getInfoById($user_id);
			$this->access_token = Yii::app()->facebook->getAccessToken();
			Yii::app()->session["access_token"] = $this->access_token;
		
			$user = User::model()->findByPk($user_id);

			if(is_null($user)){
			    $user = new User();
			    $user->id = $fb_user["id"];
			    $user->first_name = $fb_user["first_name"];
			    $user->last_name = $fb_user["last_name"];
				    
			    $external_site = ExternalSite::model()->find('url=:url', array(':url'=>$fb_user["link"]));
			    if(is_null($external_site)){
					$external_site = new ExternalSite();
					$external_site->name = $fb_user["name"]." site on Facebook";
					$external_site->url = $fb_user["link"];
					$source = SourceType::model()->find('name=:name', array(':name'=>"Facebook"));
	 				$external_site->source = $source->id;
					$external_site->save();
			    }
			    $user->external_site_id = $external_site->id;
			    $user->external_site = $external_site;
			    $user->save();

			    $this->welcome = "yes";
			    Yii::app()->session["welcome_pin"] = "yes";
			
			}else{
			    // Welcome again
			    if($user->first_name != $fb_user["first_name"])
					$user->first_name = $fb_user["first_name"];
			    if($user->last_name != $fb_user["last_name"])
					$user->last_name = $fb_user["last_name"];

				if(!is_null($user->suggested_by)){
					$user->suggested_by = NULL;
					$this->welcome = "yes";
					Yii::app()->session["welcome_pin"] = "yes";
				}

				$user->save();

				$name_pinterest = $user->first_name." ".$user->last_name." site on Pinterest";
	            $external_site_pinterest = ExternalSite::model()->find('name=:name', array(':name'=>$name_pinterest));
				if(!is_null($external_site_pinterest)){
					$external_info = ExternalInfo::model()->findByPk(1);
					$username_ = substr($external_site_pinterest->url,strpos($external_site_pinterest->url,".com/"),strlen($external_site_pinterest->url));
		            $username = substr($username_,4,strlen($username_));
					Yii::app()->session["jump_user_pinterest_api"] = $external_info->url.$username;
					Yii::app()->session["jump_user_pinterest"] = $external_site_pinterest->url;
				}
			}

		    $friends_ = Yii::app()->facebook->api('/'.$user_id.'/friends?access_token='.$this->access_token);
		    $friends = $friends_["data"];
		    for ($i=0;$i<count($friends);$i++){
				$user_ = User::model()->findByPk($friends[$i]["id"]);
				if(!is_null($user_)){
					$criteria=new CDbCriteria;
					$criteria->condition='follower_id=:follower_id AND following_id=:following_id';
					$criteria->params=array(':follower_id'=>$user->id,':following_id'=>$friends[$i]["id"]);
					$userFriend=Friends::model()->find($criteria);
					if(is_null($userFriend)){
						$userFriend = new Friends();
						$userFriend->follower_id = $user->id;
						$userFriend->following_id = $friends[$i]["id"];
						$userFriend->suggestion = 1;
						$userFriend->save();
						$user->friends = $userFriend;
					}
				}
		    }

		    $likes_ = Yii::app()->facebook->api('/'.$user_id.'/likes?access_token='.$this->access_token);
		    $likes = $likes_["data"];

		    for ($i=0;$i<count($likes);$i++) {
				$category = Category::model()->find('name=:name', array(':name'=>$likes[$i]["category"]));
				if(!is_null($category)){
					$preferenceCategory = PreferencesCategories::model()->findByAttributes(array('user_id'=>$user->id,'category_id'=>$category->id));
					if(is_null($preferenceCategory)){
						$preferenceCategory = new PreferencesCategories();
						$preferenceCategory->user_id = $user->id;
						$preferenceCategory->user= $user;
						$preferenceCategory->category_id = $category->id;
						$preferenceCategory->category = $category;
						$preferenceCategory->count = 1;
					}else{
						$preferenceCategory->count++;
					}
					$preferenceCategory->save();
				}
		    }

			$photo_ = Yii::app()->facebook->api('/'.$user_id.'/?fields=picture&access_token='.Yii::app()->session["access_token"]);
			$photo_large_ = Yii::app()->facebook->api('/'.$user_id.'/?fields=picture.type(large)&access_token='.Yii::app()->session["access_token"]);
			
			Yii::app()->session["jump_user_id"] = $user_id;
	        Yii::app()->session["jump_user_name"] = $fb_user["first_name"];
	       	Yii::app()->session["jump_user_name_title"] = $fb_user["name"];
	        Yii::app()->session["jump_user_photo"] = $photo_["picture"]["data"]["url"];
	        Yii::app()->session["jump_user_photo_large"] = $photo_large_["picture"]["data"]["url"];
	        if($user->geolocation_lat != 0)
	        	Yii::app()->session["jump_user_geoposition_lat"] = $user->geolocation_lat;
	        if($user->geolocation_long != 0)
	        	Yii::app()->session["jump_user_geoposition_long"] = $user->geolocation_long;

			Yii::app()->session["welcome"] = $this->welcome;
	        Yii::app()->session["pinned"] = $user->pinned;

			$this->render('index');
			exit;
		}
		$this->redirect($newLoginUrl);		
	}
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		$this->welcome = "no";
		$this->access_token = '';
		Yii::app()->facebook->destroySession();
		Yii::app()->user->logout();
		Yii::app()->session->destroy();
		$this->redirect(Yii::app()->homeUrl);
	}


	protected function afterRender($view, &$output)
	{
	  	parent::afterRender($view,$output);
		Yii::app()->facebook->initJs($output); 
		Yii::app()->facebook->renderOGMetaTags(); 
		return true;
	}

	private function reubicateCoord($coord){
		$newcord = '';
		$int = intval($coord);
		$decs = substr(strrchr($coord, "."), 1);
		$rest = rand(100,999);
		$longdec = strlen($decs);
		$newdec = '';
		if($longdec > 1){
			$newdec = $decs[0].$decs[1];
		}else{
			if($longdec != 0)
				$newdec = $decs[0];
		}

		$newcord = $int.'.'.$newdec.$rest;

		if($longdec == 0)
			$newcord = $coord;

		return $newcord;
	}

	private function validateCoord($lat,$long){
		$val = false;
		if($page = @file_get_contents("http://maps.googleapis.com/maps/api/elevation/json?locations=".$lat.",".$long)){
			$data = json_decode($page);
			if($data->results[0]->elevation > 1)
				$val = true;
		}
		return $val;

	}

}
