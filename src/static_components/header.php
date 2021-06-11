<div class="header-body">
<?php 
$paths = [
	["/src/index.php", "Index"],
	["/src/login.php", "Login"],
	["/src/register.php", "Register"],
	["/src/profile.php", "Profile"]];

foreach ($paths as $path) {
	echo(
		"<div class=\"header-item-container " .
		($path[0] === $_SERVER["PHP_SELF"] ?
			"header-item-container-selected" :
			"") .
	 	"\">" .
		"<a class=\"header-item\" href=" .
		$path[0] .
		">" .
		$path[1] .
		"</a></div>");
}
?>
</div>

<script src="scripts/js/static_components/header.js" type="module"></script>

<style>
.header-body {
	width: 100vw;
	height: 30px;
	position: sticky;
	top: 0;
	background-color: #AAA;
	display: flex;
	justify-content: right;
	align-items: center
}
.header-item-container {
	padding-left: 5px;
	padding-right: 5px;
	margin-right: 5px;
	height: 20px;
	background-color: #CCC;
}
.header-item-container-selected {
	background-color: #FFF;
}
.header-item-container-hovered {
	background-color: #FFF;
}
.header-item {
	color: black;
	text-decoration: none;
}
</style>
