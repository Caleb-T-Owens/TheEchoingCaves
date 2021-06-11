<?php
function createConnection () {
	$servername = "localhost";
	$username = "yoozernaym";
	$password = "parsword";

	$dbname = "rougelike";

	return new mysqli($servername, $username, $password, $dbname);
}
?>
