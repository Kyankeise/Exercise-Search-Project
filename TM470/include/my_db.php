<?php

class db {

	var $server;
	var $user;
	var $pass;
	var $database;
	var $connected;
	var $handle;

	function __construct(){

		$this->connected  = false;
	}

	function connect() {

		if ($this->connected === false)	{

			$this->handle = mysqli_connect($this->server, $this->user, $this->pass, $this->database);

			if ($this->handle === false) {
				$this->connected = false;
				echo  "Could not connect to database.<br />\n" ;
				return false;
			}
			else {
					$this->connected = true;

					if (mysqli_select_db($this->handle, $this->database )) {
						return true;
					}
					else {
						echo mysqli_error($this->handle)."<br />\n";
					}
			}
		}
		else {
			return true;
		}
	}

	function lastid(){

		if ($this->connect()) {
				return mysqli_insert_id(($this->handle));
		}
		else {
				return false;
		}
	}

  

	function query($query) {

		if ($this->connect()) {

			$result = mysqli_query($this->handle, $query);

			if ($result === false)	{
				echo mysqli_error($this->handle)."<br />\n" ;
				return false;
			}
			else {
				if ($result === true) {
					return true;
				}
				elseif ($result !== false) {
					$rows = array();
					while ($row = mysqli_fetch_object($result))
						$rows[] = $row;

					mysqli_free_result($result);
					return $rows;
				}
				else {
					return false;
				}
			}
		}
		else {
			return false;
		}
	}
}

// Create new instance of database object
// --------------------------------------
	$db = new db;
	$db->server   = constant("DB_SERVER");
	$db->user     = constant("DB_USER");
	$db->pass     = constant("DB_PASS");
	$db->database = constant("DB_DATABASE");

?>
