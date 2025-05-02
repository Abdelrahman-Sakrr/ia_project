<?php
require_once("../vendor/autoload.php"); 
$myDB = new \App\DB();
$authontication = new \App\Auth();
$Game = new \App\Game();
$authontication->redirectUnAuthorizedUsers();	
$authontication->handleLogOut();
$query = $myDB->Connection->prepare("SELECT * FROM games");
$query->execute();
$result = $query->get_result();
$games = $result->fetch_all(MYSQLI_ASSOC);
$Game->deleteGame()



?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../assets/css/style.css">
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<title>Games</title>
</head>
<body>

<?php require_once 'layout/Navbar.php'; ?>
<?php require_once 'layout/Navbar.php'; ?>

<div class="container mt-5">
  <h2 class="mb-4 text-center text-primary">All Games</h2>
  <div class="row">
    <?php foreach ($games as $game): ?>
      <div class="col-md-4 mb-4 ">
        <div class="card bg-dark shadow-xl text-white h-100">
          <div class="card-body d-flex flex-column justify-content-between">
            <div>
              <h5 class="card-title"><?= htmlspecialchars($game['game_name']) ?></h5>
              <p class="card-text">
                <span class="badge bg-primary">$<?= number_format($game['game_price'], 2) ?></span>
              </p>
            </div>
            <div class="d-flex justify-content-end gap-2">
              <a href="EditGame.php?gameId=<?= $game['id'] ?>" class="btn btn-sm btn-outline-primary" title="Edit">
                Update
              </a>
              <a href="?deletGameId=<?php echo $game["id"]?>" type="button" class="btn btn-sm btn-outline-danger" name="deleteGameBtn" title="Delete">
                Delete
              </a>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    <?php $Toaster = new \App\Toaster();
    echo $Toaster->showToaster("created" , "Created Successfully");
    echo $Toaster->showToaster("updated" , "Updated Successfully");
    echo $Toaster->showToaster("deleted" , "Deleted Successfully")
?>
  </div>
</div>
	<script src="../assets/js/home.js"></script>
	<script src="../../assets/js/bootstrap.min.js"></script>
  <script>
	document.querySelectorAll(".toast").forEach((toastEl) => {
		const closeBtn = toastEl.querySelector(".btn-close");
		if (closeBtn) {
		  closeBtn.addEventListener("click", () => {
			toastEl.classList.remove("show");
			toastEl.classList.add("hide");
			setTimeout(() => toastEl.remove(), 300); // Wait for animation
		  });
		}
	  });
</script>
</body>
</html>