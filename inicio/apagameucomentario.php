<?php
	require_once "../config.php";
	$_pegar = $_POST['id'];
	mysql_query("delete from comentario where idcom = '$_pegar'");
	echo "<meta http-equiv='refresh' content='0, url=index.php'>";
?>