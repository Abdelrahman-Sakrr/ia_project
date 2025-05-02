<?php
// next line means you imported all classes inside the folder name class
require_once("../vendor/autoload.php"); 
$myDB = new \App\DB();
$errorMsg = '';
if(isset($_POST['signUpBtn'])){
	$userName = $_POST['userName'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$confirmPassword = $_POST['confirmPassword'];
	if($password!=$confirmPassword){
		$errorMsg = "Confirm Password Donot Match Please Try Again";
	}else{
		$insertStatement = 'INSERT INTO `Users` (name, email, password) VALUES (?, ?, ?)';
		$query = $myDB->Connection->prepare($insertStatement);
		$hashedPassword = password_hash($password , algo:PASSWORD_DEFAULT);
		$query->bind_param('sss', $userName, $email, $hashedPassword);
		$responseStatus = $query->execute();
		echo $responseStatus;
		if ($responseStatus) {
			header(header:'location:index.php?signUp=1');
		} else {
			$errorMsg = "Something went wrong. Please try again.";
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
	<title>Sign Up</title>
</head>
<body>
<div class="container d-flex justify-content-center align-items-center min-vh-100 flex-column">
	<form class="form-container" method="post">

		<?php
			if($errorMsg){
				echo "<h6 class='alert alert-danger text-center'>$errorMsg</h6>";
			}?>

		<h2 class="text-center mb-4">Create Account</h2>

		<div class="form-group mb-3">
			<label for="name1" class="form-label">Name</label>
			<input required type="text" class="form-control" name="userName" id="name1" placeholder="Enter your name">
		</div>

		<div class="form-group mb-3">
			<label for="exampleInputEmail1" class="form-label">Email address</label>
			<input required type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Enter email">
			<small id="emailHelp" class="form-text text-muted">We’ll never share your email with anyone else.</small>
		</div>

		<div class="form-group mb-3">
			<label for="exampleInputPassword1" class="form-label">Password</label>
			<input required type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
		</div>

		<div class="form-group mb-3">
			<label for="exampleInputPassword2" class="form-label">Confirm Password</label>
			<input required type="password" name="confirmPassword" class="form-control" id="exampleInputPassword2" placeholder="Confirm Password">
		</div>

		<div class="form-check mb-3 text-end">
			<a href="index.php" class="text-decoration-none text-primary">Already have an account?</a>
		</div>

		<button type="submit" name="signUpBtn" class="btn btn-primary w-100">Sign Up</button>
	</form>
</div>

<script src="/assets/js/home.js"></script>
</body>

</html>