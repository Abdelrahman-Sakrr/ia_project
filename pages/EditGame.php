<?php
require_once("../vendor/autoload.php"); 
$myDB = new \App\DB();
$authontication = new \App\Auth();
?>
<!DOCTYPE html>
<html lang="en">
<head>  
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../assets/css/style.css">
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<title>Edit Game</title>
</head>
<body>
<?php require_once 'layout/Navbar.php'; ?>
<?php if(empty($_GET["gameId"])):?>
	<h4 class="bg-danger text-white"> You Cannot Access This Page</h4>
	<?php exit(); ?>
	<?php endif; ?>
	<?php 
	$oneGame = new \App\Game();
$authontication->redirectUnAuthorizedUsers();
$authontication->handleLogOut();
$gameId=$_GET["gameId"];
$getGame=$oneGame->getGameById($gameId)	;
$oneGame->updateGame($gameId);
?>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
	<form class="form-container" method="post">
	<h2 class="text-center mb-4">Update Game</h2>
	  <div class="form-group mb-3">
	    <label for="gameName1">Game Name</label>
	    <input type="text" value="<?php echo $getGame["game_name"]?>" class="form-control" name="gameName" id="gameName1" aria-describedby="emailHelp" placeholder="Enter Game Name">
	  </div>
	  <div class="form-group mb-3">
	    <label for="gamePrice1">Game Price</label>
	    <input type="number" value="<?php echo $getGame["game_price"]?>" class="form-control" name="gamePrice" id="gamePrice1" aria-describedby="emailHelp" placeholder="Enter Game Name">
	  </div>
	  <button type="submit" name="updateGameBtn" class="btn btn-primary w-100">Update Game</button>
	  </form>
</div>
</body>
</html>