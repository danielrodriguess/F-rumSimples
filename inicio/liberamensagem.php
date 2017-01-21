<?php
	require_once "../config.php";
	$_pegar = $_GET['id'];
	echo $_pegar;
	mysql_query("update sugestoes set status = 'Lida' where id = '$_pegar'");
	echo "<meta http-equiv='refresh' content='0, url=moderador.php'>";
?>