<?php
function createConnection () {
	$servername = "localhost";
	$username = "access";
	$password = "access";

	$dbname = "the_echoing_caves";

	return new mysqli($servername, $username, $password, $dbname);
}
?>
