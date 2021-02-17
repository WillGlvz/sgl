<?php
	session_start();  
	unset($_SESSION['code']);
	unset($_SESSION['name']);
	echo "<script>window.location='http://localhost/SGL/desprendimientos';</script>";
?>