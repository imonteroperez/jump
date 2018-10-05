<?php

class UserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	public $error_code = '';
	public $likes = array();

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array('update','deactivate','preferences','friends', 'explore'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);
	//	Yii::app()->facebook->setAccessToken($_SESSION["access_token"]);
	/*	$likes_ = Yii::app()->facebook->api('/me/likes?access_token='.$_SESSION["access_token"]);
		$this->likes = $likes_["data"];
		for($i=0;$i<count($this->likes);$i++){
			$like = Yii::app()->facebook->api('/'.$this->likes[$i]["id"].'?fields=picture&access_token='.$_SESSION["access_token"]);
			$this->likes[$i]["image"] = $like["picture"]["data"]["url"];
		}
	*/
		if(isset($_GET["google-map"])){
		  if(isset($_SESSION["jump_user_geoposition_lat"])){
		    if($_SESSION["jump_user_geoposition_lat"] != $_GET["geoposition_lat"]){
			$_SESSION["jump_user_geoposition_lat"] = $_GET["geoposition_lat"];
			$_SESSION["jump_user_geoposition_long"] = $_GET["geoposition_long"];
		    }
		  }else{
			$_SESSION["jump_user_geoposition_lat"] = $_GET["geoposition_lat"];
			$_SESSION["jump_user_geoposition_long"] = $_GET["geoposition_long"];
                  }
 		  if($id == $_SESSION["jump_user_id"]){
			$user = User::model()->findByPk($id);
			$user->geolocation_lat = $_SESSION["jump_user_geoposition_lat"];
			$user->geolocation_long = $_SESSION["jump_user_geoposition_long"];
			$user->save();
			exit;
		  }
		}

		if(isset($_GET["pin"])){
  		 if($id == $_SESSION["jump_user_id"]){
		   if($_GET["pin"] == 1 || $_GET["pin"] == 0){
			$user = User::model()->findByPk($id);
			$user->pinned = $_GET["pin"];
			$user->save();
			exit;
		   }
		 }
		}


		if(isset($_GET["google-api-search"])){

			function cmp($a, $b)
			{
			    return $b['count'] - $a['count'];
			}

			$preferences_categories_ = $model->preferences_categories;
			usort($preferences_categories_,"cmp");

			$google = ExternalInfo::model()->findByPk(2);
			$html_content = '<ul class="thumbnails">';
			foreach($preferences_categories_ as $p){
			    $query_search = "&q=";
		            $category_id = $p["category_id"];
		            $category = Category::model()->findByPk($category_id);
			    $query_search = $query_search.$category->name;
			    $query_search_ = str_replace("/"," ",$query_search);
			    $query_search__ = str_replace(" ","+",$query_search_);
			    $url = $google->url.$google->API;
			    if(isset(Yii::app()->session["language"]))
				$url = $url."&country=".Yii::app()->session["language"];
			    else
				$url = $url."&country=US";
			    $url = $url.$query_search__;
			    $contents = file_get_contents($url);
			    $content_json = json_decode($contents);
			    if(isset($content_json->items)){
				    $name = $content_json->items[0]->product->title;
				    $description = $content_json->items[0]->product->description;
				    $link = $content_json->items[0]->product->link;
				    $image = $content_json->items[0]->product->images[0]->link;
				    $html_content = $html_content.'<li class="span2"><div class="thumbnail"><a href="'.$link.'" target="_blank"><center><img src="'.$image.'" alt="Click for details"></center></a></div></li>';
			    }
			}
			$html_content = $html_content.'</u>';
			echo $html_content;
			exit;
		}

		$this->render('view',array(
			'model'=>$model,
		));
	}

	/**
         * Deactivate a particular model
         * @param integer $id the ID of the model to be deactivated
         */
	public function actionDeactivate($id)
	{
		// $this->authorizeUser($id);

		if(isset($_GET["confirm"]))
		{
			$model = $this->loadModel($id);
			// Delete catalogs from user
			Catalog::model()->deleteAll('user_id=:user_id', array(':user_id'=>$model->id));
			// Delete catalog votes
			CatalogVote::model()->deleteAll('user_id=:user_id', array(':user_id'=>$model->id));
			// Delete follower and following friends
			Friends::model()->deleteAll('follower_id=:follower_id', array(':follower_id'=>$model->id));
			Friends::model()->deleteAll('following_id=:following_id', array(':following_id'=>$model->id));
			// Delete external sites
			$external_sites = ExternalSite::model()->findAll("name like :search", array(':search'=>'%'.$model->first_name.' '.$model->last_name.'%'));
			for($i = 0; $i < count($external_sites); $i++)
				ExternalSite::model()->deleteByPk($external_sites[$i]->id);
			// Delete feedbacks
			Feedback::model()->deleteAll('user_id=:user_id', array(':user_id'=>$model->id));
			// Delete Jump Requests
			JumpRequest::model()->deleteAll('author_id=:user_id', array(':user_id'=>$model->id));
			// Delete Jump votes
			JumpVote::model()->deleteAll('user_id=:user_id', array(':user_id'=>$model->id));
			// Delete Preferences brands
			PreferencesBrands::model()->deleteAll('user_id=:user_id', array(':user_id'=>$model->id));
			// Delete Preferences categories
			PreferencesCategories::model()->deleteAll('user_id=:user_id', array(':user_id'=>$model->id));
			// Delete User badges
			UserBadge::model()->deleteAll('user_id=:user_id', array(':user_id'=>$model->id));
			// Delete User Jump Requests
			UserJumpRequest::model()->deleteAll('user_id=:user_id', array(':user_id'=>$model->id));
			// Delete User Jump Responses
			UserJumpResponse::model()->deleteAll('user_id=:user_id', array(':user_id'=>$model->id));
			// Delete user
			User::model()->deleteByPk($model->id);
			echo "Account deactivated succesfully";
                        exit;
		}


		$this->render('deactivate',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
         * Shows and edit the preferences of an user
         * @param integer $id the ID of the model to be updated
         */
	public function actionPreferences($id)
	{
		// $this->authorizeUser($id);
		$model=$this->loadModel($id);

		$this->render('preferences',array(
			'model'=>$model,
		));
	}

	/**
         * Shows friends to follow
         * @param integer $id the ID of the model to be updated
         */
	public function actionFriends($id)
	{
		// $this->authorizeUser($id);
		$model=$this->loadModel($id);

		$this->render('friends',array(
			'model'=>$model,
		));
	}

	/**
         * Shows and edit the map of an user
         * @param integer $id the ID of the model to be updated
         */
	public function actionExplore($id)
	{
		// $this->authorizeUser($id);
		$model=$this->loadModel($id);

		if(isset($_GET["google-map"])){
		  if(isset($_SESSION["jump_user_geoposition_lat"])){
		    if($_SESSION["jump_user_geoposition_lat"] != $_GET["geoposition_lat"]){
			$_SESSION["jump_user_geoposition_lat"] = $_GET["geoposition_lat"];
			$_SESSION["jump_user_geoposition_long"] = $_GET["geoposition_long"];
		    }
		  }else{
			$_SESSION["jump_user_geoposition_lat"] = $_GET["geoposition_lat"];
			$_SESSION["jump_user_geoposition_long"] = $_GET["geoposition_long"];
          }
 		  
 		  $distance_sql = "
 		  SELECT id, ( 3959 * ACOS( COS( RADIANS( geolocation_lat=:lat ) ) * 
 		  			   COS( RADIANS( geolocation_lat=:lat ) ) * COS( RADIANS( geolocation_long=:lng ) - 
 		  			   RADIANS( geolocation_long=:lng ) ) + SIN( RADIANS( geolocation_lat=:lat ) ) * 
 		  			   SIN( RADIANS( geolocation_lat=:lat ) ) ) ) AS distance,
				 first_name,
				 last_name,
				 geolocation_lat,
				 geolocation_long
 		  FROM user
 		  HAVING distance <25
 		  ORDER BY distance
 		  LIMIT 0 , 20
 		  ";

          $dbconnection = Yii::app()->db;
          $cmd = $dbconnection->createCommand($distance_sql);
          $cmd->bindParam(":lat",$_SESSION["jump_user_geoposition_lat"],PDO::PARAM_STR);
          $cmd->bindParam(":lng",$_SESSION["jump_user_geoposition_long"],PDO::PARAM_STR);
          $near_users = $cmd->queryAll();
          
          $response = '<script type="text/javascript">';

          foreach($near_users as $near_user){
          	$near_user_id = $near_user["id"];
          	Yii::app()->facebook->setAccessToken($_SESSION["access_token"]);
			$photo_ = Yii::app()->facebook->api('/'.$near_user_id.'/?fields=picture&access_token='.$_SESSION["access_token"]);
			$near_user_marker = $photo_["picture"]["data"]["url"];
			
			$near_user_username = $near_user["first_name"]." ".$near_user["last_name"];
          	$near_user_lat = $near_user["geolocation_lat"];
          	$near_user_long = $near_user["geolocation_long"];

          	$response = $response.'
          				 pos_'.$near_user_id.' = new google.maps.LatLng('.$near_user_lat.','.$near_user_long.');
          				 marker_'.$near_user_id.' = new google.maps.Marker({
          				 	icon: "'.$near_user_marker.'",
             	      		position: pos_'.$near_user_id.',
		      				draggable: false,
        	      			map: map,
        	      			title: \''.$near_user_username.'\'
        	    		});
						makeInfoWindowEvent(map, new google.maps.InfoWindow(), "<a href=\"'.Yii::app()->homeUrl."user/".$near_user_id.'\">'.$near_user_username.'</a>", marker_'.$near_user_id.');';

          }
          $response = $response.'</script>';
          echo $response;
          exit;

 		  if($id == $_SESSION["jump_user_id"]){
			$user = User::model()->findByPk($id);
			$user->geolocation_lat = $_SESSION["jump_user_geoposition_lat"];
			$user->geolocation_long = $_SESSION["jump_user_geoposition_long"];
			$user->save();
			exit;
		  }
		}

		if(isset($_GET["pin"])){
  		 if($id == $_SESSION["jump_user_id"]){
		   if($_GET["pin"] == 1 || $_GET["pin"] == 0){
			$user = User::model()->findByPk($id);
			$user->pinned = $_GET["pin"];
			$user->save();
			exit;
		   }
		 }
		}

		$this->render('explore',array(
			'model'=>$model,
		));
	}


	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		// $this->authorizeUser($id);
		$model=$this->loadModel($id);

		$success_code = "";

		if(isset($_GET["update_preferences"])){

			// Remove preferences categories
			$preferences = PreferencesCategories::model()->findAll('user_id=:user_id',array(':user_id'=>$model->id));
			for($i=0;$i<count($preferences);$i++){
				if(!isset($_POST[$preferences[$i]["category_id"]])){
					$preferences[$i]->delete();
				}
			}

			// Load new preferences categories
			$categories = Category::model()->findAll();
			for($i=0;$i<count($categories);$i++){
				if(isset($_POST[$categories[$i]["id"]])){
					$preference = PreferencesCategories::model()->findAll('category_id=:category_id AND user_id=:user_id', array(':category_id'=>$categories[$i]["id"],':user_id'=>$model->id));
					if(empty($preference)){
						$preference_ = new PreferencesCategories();
						$preference_->category_id = $categories[$i]["id"];
						$preference_->user_id = $model->id;
						$preference_->count = 1;
						$preference_->save();
					}
				}
			}

			$success_code = $success_code."?update_success=1";
		    echo Yii::app()->homeUrl."user/update/".$model->id.$success_code;
		    exit;
		}


		if(isset($_GET['user_language'])){
			Yii::app()->session["language"] = $_GET['user_language'];
		}

		if(isset($_GET['user_pinterest'])){
			$url_pinterest = $_GET['user_pinterest'];
			if($this->validate_url($url_pinterest,$model)){
				$_SESSION["jump_user_pinterest"] = $url_pinterest;
				if(!isset(Yii::app()->session["language"]))
					$success_code = $success_code."?update_success=1";
				else{
					if(Yii::app()->language != Yii::app()->session["language"]){
						$success_code = $success_code."?update_success=1&lang=".Yii::app()->session["language"];
						Yii::app()->language = Yii::app()->session["language"];
					}
					//else
					//	$success_code = $success_code."?update_success=1&lang=".Yii::app()->language;
				}
			    echo Yii::app()->homeUrl."user/update/".$model->id.$success_code;
			    exit;
			}else{
			    echo Yii::app()->homeUrl."user/update/".$model->id."?error_code=".$this->error_code;
			    exit;
			}
		}


		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		if(isset($_GET["facebook-photo-refresh"]))
		{
			Yii::app()->facebook->setAccessToken($_SESSION["access_token"]);
			$photo_ = Yii::app()->facebook->api('/me/?fields=picture&access_token='.$_SESSION["access_token"]);
 			$photo_large_ = Yii::app()->facebook->api('/me/?fields=picture.type(large)&access_token='.$_SESSION["access_token"]);
		    $_SESSION["jump_user_photo"] = $photo_["picture"]["data"]["url"];
		    $_SESSION["jump_user_photo_large"] = $photo_large_["picture"]["data"]["url"];
		    echo '<img src="'.$_SESSION["jump_user_photo_large"].'">';
			exit;
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('User');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	private function validate_url($url,$model){
		$response = false;
		if($url != ''){
		  if($this->validate_pinterest_url_syntax($url)){
			$username_ = substr($url,strpos($url,".com/"),strlen($url));
			$username = substr($username_,5,strlen($username_));
			$external_info = ExternalInfo::model()->findByPk(1);
			if($page = @file_get_contents($external_info->url.$username."/pins")){
				$response = true;
				$_SESSION["jump_user_pinterest_api"] = $external_info->url.$username;
				$name = $model->first_name." ".$model->last_name." site on Pinterest";
				$external_site = ExternalSite::model()->find('name=:name', array(':name'=>$name));
				if(is_null($external_site)){
					$external_site = new ExternalSite();
					$external_site->name = $name;
					$external_site->url = $url;
					$source = SourceType::model()->find('name=:name', array(':name'=>"Pinterest"));
	                                $external_site->source = $source->id;
					$external_site->save();
				}
			}else{
				$response = false;
				$this->error_code = "01";
			}
		  }else{
			$response = false;
			$this->error_code = "02";
		  }
		}else{
			$response = true;
		}

		return $response;

	}

	private function validate_pinterest_url_syntax($url)
	{
	    return preg_match('|^http://pinterest.com/([a-zA-Z0-9]+)+$|i', $url);
	}

        public function countJumps($id){
   	    $model=User::model()->findByPk($id);
   	    $jumps = 0;
	    for($i = 0; $i<count($model->user_jump_requests); $i++){
		if($model->user_jump_requests[$i]->is_jump == true)
		   $jumps++;
	    }
	    return $jumps;
	}

	public function getFollowings($id){
	    $criteria=new CDbCriteria;
            $criteria->condition='follower_id=:follower_id AND suggestion=:suggestion';
            $criteria->params=array(':follower_id'=>$id,':suggestion'=>0);
            return count(Friends::model()->find($criteria));
	}

	public function getFollowers($id){
	    $criteria=new CDbCriteria;
            $criteria->condition='following_id=:following_id AND suggestion=:suggestion';
            $criteria->params=array(':following_id'=>$id,':suggestion'=>0);
            return count(Friends::model()->find($criteria));
	}

}
