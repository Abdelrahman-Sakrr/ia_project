<?php
namespace App;
class Auth{
	public function isAuthorized(){
		return isset($_SESSION["userID"]);
	}
	public function redirectUnAuthorizedUsers(){
		if(!$this->isAuthorized()){
			header(header:"location:Login.php");
		}
	}
	public function redirectIfAuthorized(){
		if($this->isAuthorized()){
			header(header:"location:Home.php");
		}
	}
	public function handleLogOut(){
		if(isset($_GET["logout"])){
			session_unset();
			session_destroy();
			header(header:"location:Login.php");
		}
	}

}