<?php
namespace App;
class Game{
	public function getGameById($gameId){
		$selectStatment = "SELECT * FROM games where id = ?";
		$myDB = new DB();
		$query = $myDB->Connection->prepare($selectStatment);
		$query->bind_param("i" , $gameId);
		$query->execute();
		return $query->get_result()->fetch_assoc();
	}
	public function updateGame($gameId){
		if(isset($_POST["updateGameBtn"])){
			$game_name = $_POST["gameName"];
			$game_price = $_POST["gamePrice"];
			$updateStatment = "Update `games` set game_name = ? , game_price= ? , user_id=? where id = ?";		
			$myDB = new DB();
			$query = $myDB->Connection->prepare($updateStatment);
			$query->bind_param("sdii" , $game_name , $game_price , $_SESSION["userID"],$gameId);
			$query->execute();
			if ($query->execute()) {
				header("Location: Home.php?updated=1");
				exit;
			}
		}

	}
	public function deleteGame(){
		if(isset($_GET["deletGameId"])){
			$gameId = $_GET["deletGameId"];
			$deleteStatment = "DELETE FROM `games` where id = ?";		
			$myDB = new DB();
			$query = $myDB->Connection->prepare($deleteStatment);
			$query->bind_param("i" , $gameId);
			$query->execute();
			if ($query->execute()) {
				header("Location: Home.php?deleted=1");
				exit;
			}
		}

	}


}