<?php
	require_once "../config.php";
	$_pegar = $_GET['id'];
	echo $_pegar;
	mysql_query("delete from comentario where id = '$_pegar' and status = 'Em análise'");
	echo "<meta http-equiv='refresh' content='0, url=moderador.php'>";
?>