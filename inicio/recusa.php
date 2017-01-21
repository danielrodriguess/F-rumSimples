<?php
	require_once "../config.php";
	$_pegar = $_GET['id'];
	echo $_pegar;
	mysql_query("delete from moderador where id = '$_pegar'");
	echo "<meta http-equiv='refresh' content='0, url=moderador.php'>";
?>