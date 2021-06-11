<html>
	<body>
		<?php require("./scripts/global_imports.php") ?>
		<?php require("./static_components/header.php") ?>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
			Username: <input type="text" name="username"><br>
			Email: <input type="email" name="email"><br>
			Password: <input type="password" name="password"><br>
			<input type="submit">
		</form>
	</body>
</html>

<?php
include("./scripts/create_connenction.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$conn = createConnection();

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT email FROM users WHERE email = '" .
		$_POST["email"] .
		"'";

	$result = $conn->query($sql);

	if ($result == FALSE) {
		die("Error: " . $conn->error);
	}

	if ($result->num_rows > 0) {
		die("Error: user with that email already exists");
	}

	$sql = "INSERT INTO users (username, email, password) VALUES ('" .
		$_POST["username"] .
		"', '" .
		$_POST["email"] .
		"', '" .
		hash("MD5", $_POST["password"], FALSE) .
		"')";

	if ($conn->query($sql) == FALSE) {
		die("Error: " . $conn->error);
	}

	echo "Success";
}
?>
