<?php
// next line means you imported all classes inside the folder name class
require_once("../vendor/autoload.php"); 
$myObj = new \App\DB();
$errorMsg='';

if(isset($_POST['loginBtn'])){
	$email = $_POST['email'];
	$password = $_POST['password'];
	$hashedPassword = password_hash($password , algo:PASSWORD_DEFAULT);
	$selectStatment = "Select * from `users` where email = ?";
	$queryStatment = $myObj->$Connection->prepare($selectStatment);
	$queryStatment->bind_param("s", $email);
	$queryStatus = $queryStatment->execute();
	if($queryStatus){
		$result = $queryStatment->get_result();
		if($result->num_rows==1){
			$row = $result-> fetch_assoc(); 
			if(password_verify($password , $row["password"])){
				header("Location: Home.php");
			}else{
				$errorMsg = "Invalid Email Or Password";
			}
		}else{
			$errorMsg = "Email Not Found";
		}
	}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/style.css">

	<title>Login</title>
</head>
<body>
<div class="container d-flex justify-content-center align-items-center min-vh-100">
	<form class="form-container" method="post">
	<?php if(isset($_GET['signUp'])){
			echo "<h6 class='alert alert-success text-center'>Account Created Successfully</h6>";
			unset($_GET['signUp']);
			}
			if ($errorMsg){
				echo "<h6 class='alert alert-success text-center'>$errorMsg</h6>";
			}?>
	<h2 class="text-center mb-4">Login</h2>
	  <div class="form-group mb-3">
	    <label for="exampleInputEmail1">Email address</label>
	    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
	    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
	  </div>
	  <div class="form-group mb-3">
	    <label for="exampleInputPassword1">Password</label>
	    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
	  </div>
	  <div class="form-check mb-3">
		<a href="SignUp.php" class="ms-4">Don't Have an account</a>
	  </div>
	  <button type="submit" name="loginBtn" class="btn btn-primary w-100">Login</button>
	  </form>
</div>
	<script src="/assets/js/home.js"></script>
	<script src="/assets/js/"></script>
</body>
</html>