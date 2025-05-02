<?php
require_once("../vendor/autoload.php"); 
$myDB = new \App\DB();
$authontication = new \App\Auth();
$authontication->redirectUnAuthorizedUsers();	
$authontication->handleLogOut();
$query = $myDB->Connection->prepare("SELECT * FROM games");
$query->execute();
$result = $query->get_result();
$games = $result->fetch_all(MYSQLI_ASSOC);



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

<?php if (isset($_GET['created'])): ?>
<div class="toast show position-fixed bottom-0 end-0 m-3 bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast-header text-white bg-success">
    <strong class="me-auto">Success</strong>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
    Game was created successfully!
  </div>
</div>
<script>
  const toastEl = document.querySelector('.toast');
  if (toastEl) new bootstrap.Toast(toastEl, { delay: 3000 }).hide();
</script>
<?php endif; ?>

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
              <a href="editGame.php?id=<?= $game['id'] ?>" class="btn btn-sm btn-outline-primary" title="Edit">
                Update
              </a>
              <a href="deleteGame.php?id=<?= $game['id'] ?>" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this game?')">
                Delete
              </a>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
	<script src="/assets/js/home.js"></script>
	<script src="/assets/js/bootstrap.min.js"></script>
</body>
</html>