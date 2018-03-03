<?php
	session_start();
	$mysqli = new mysqli("localhost","root","","db_hadis");
	// $mysqli = new mysqli("localhost","appstudio_tisnadinata","Appstudio27","appstudio_hadis");
	if (mysqli_connect_errno()){
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$mysqli->query("SET NAMES 'utf8'");
			
	const FACEBOOK_ID = "326896394488658";
	const FACEBOOK_SECRET = "6a341131c6c918ab2a50d77ea278f590";
	const TWITTER_KEY = "Hlmwnmia3SwDzsdJyyZCbzAwm";
	const TWITTER_SECRET = "h2omx7cuDUVlVUPHUQrNd8jk3jqlZMfyTrfScQf1zDsVYeOcTX";

	if (mysqli_connect_errno()){
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	function getDataByCollumn($table_name,$field_name,$value){
		global $mysqli;
		$stmt = $mysqli->query('select * from $table_name where $field_name LIKE "$value"');
		return $stmt;		
	}
	function getDataCount($table_name,$field_name,$value){
		global $mysqli;
		$stmt = $mysqli->query("select * from $table_name where $field_name='$value'");
		if($stmt){
			return $stmt->num_rows;
		}else{
			return 0;
		}
	}
	function getDataByCondition($table_name,$condition,$order_by){		
		global $mysqli;
		$stmt = $mysqli->query("select * from $table_name where $condition order by $order_by");
		return $stmt;
	}
	function getDataTable($table_name,$order_by){		
		global $mysqli;
		$stmt = $mysqli->query("select * from $table_name order by $order_by");
		return $stmt;
	}	
	function BASE_URL(){
		return getPengaturan("url_web")->value_pengaturan;
	}

	function enkripPassword($value){
		// return sha1(md5($value));	
		return md5($value);	
	}
	function login($username,$password){
		$password = enkripPassword($password);
		$login = getDataByCondition("getrich_users","user_username = '".$username."' AND user_password = '".$password."'","user_id");
		return $login;
	}

	// require_once 'facebook-sdk-v5/autoload.php';
	// define('FACEBOOK_SDK_V4_SRC_DIR', 'facebook-sdk-v5/');
	// require_once "twitter_sdk/autoload.php";
	// use Abraham\TwitterOAuth\TwitterOAuth;
	// $fb = new Facebook\Facebook([
	// 	'app_id' => FACEBOOK_ID,
	// 	'app_secret' => FACEBOOK_SECRET,
	// 	'default_graph_version' => 'v2.11',
	// ]);
	
?>