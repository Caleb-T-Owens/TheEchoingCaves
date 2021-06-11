<html>
	<body>
		<?php require("./scripts/global_imports.php") ?>
		<?php require("./static_components/header.php") ?>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
			Email: <input type="email" name="email"><br>
			Password: <input type="password" name="password"><br>
			<input type="submit">
		</form>
	</body>
</html>
