<?php
require_once "../config.php";
$_pegar = $_POST['id'];
$_comentario = $_POST['comentario'];
$_login1 = $_POST['log'];
echo $_login1;
mysql_query("insert into comentario (id,email,post,status) values ('$_pegar','$_login1','$_comentario','Em análise')");
echo "<meta http-equiv='refresh' content='0, url=index.php'>";
?>