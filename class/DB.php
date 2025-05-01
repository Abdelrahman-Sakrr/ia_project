<?php
namespace App;
use mysqli;	
class DB {
	private string $hostname = 'localhost';
	private string $username = 'root';
	private string $password = '';
	private string $database = 'ia_project';
	public mysqli $Connection;
	public function __constructor()
	{
		$this->Connection = new mysqli($this->hostname , $this->username , $this->password , $this->database);
	}	
}