<?php
session_start();
if(isset($_SESSION["Auth"]->slug)){
	session_unset();
	header("Location: index.php");
	}
?>