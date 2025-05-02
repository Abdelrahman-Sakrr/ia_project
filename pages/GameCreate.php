<?php
require_once("../vendor/autoload.php"); 
$myDB = new \App\DB();
$authontication = new \App\Auth();
$authontication->redirectUnAuthorizedUsers();
$authontication->handleLogOut();	

if(isset($_POST["loginBtn"])){
	$gameName= $_POST["gameName"];
	$gamePrice= $_POST["gamePrice"];
	$insertStatment = "INSERT INTO games (game_name, game_price, user_id) VALUES (?, ?, ?)";
	$queryObject = $myDB->Connection->prepare($insertStatment);
	$queryObject->bind_param("sdi", $gameName, $gamePrice, $_SESSION["userID"]);	
	$responseStatus=$queryObject->execute();
	if($responseStatus){
		header(header:"location:Home.php?created=1");
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>  
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../assets/css/style.css">
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<title>Document</title>
</head>
<body>
<?php require_once 'layout/Navbar.php'; ?>
<div class="container d-flex justify-content-center align-items-center min-vh-100">
	<form class="form-container" method="post">
	<h2 class="text-center mb-4">Create Game</h2>
	  <div class="form-group mb-3">
	    <label for="gameName1">Game Name</label>
	    <input type="text" class="form-control" name="gameName" id="gameName1" aria-describedby="emailHelp" placeholder="Enter Game Name">
	  </div>
	  <div class="form-group mb-3">
	    <label for="gamePrice1">Game Price</label>
	    <input type="number" class="form-control" name="gamePrice" id="gamePrice1" aria-describedby="emailHelp" placeholder="Enter Game Name">
	  </div>
	  <button type="submit" name="loginBtn" class="btn btn-primary w-100">Create Game</button>
	  </form>
</div>
</body>
</html>