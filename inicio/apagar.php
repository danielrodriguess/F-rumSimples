<?php
	require_once "../config.php";
	$_pegar = $_GET['id'];
	mysql_query("delete from moderador where id = '$_pegar'");
	mysql_query("delete from comentario where id = '$_pegar'");
	echo "<meta http-equiv='refresh' content='0, url=gerenciar.php'>";
?>