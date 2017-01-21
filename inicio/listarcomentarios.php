<html>
<head>
<style type="text/css"> 
		a:link 
		{ 
		 text-decoration:none; 
		} 
		</style>
<link rel="shortcut icon" href="../icone/1.ico" type="image/x-icon"/>
<title>Todos os comentários - iPlay</title>
<link rel="stylesheet" type="text/css" href="../estilo.css">
</head>
<body bgcolor="#A9A9A9" link="#E1E1E1" alink="#E1E1E1" vlink="#E1E1E1">
<?php
	require_once "../config.php";
	session_start();
	if (!isset($_SESSION['email_session']) && !isset($_SESSION['senha_session'])){

	}else{
		$_login1 = $_SESSION['email_session'];
		$_linha = mysql_query("select * from usuario where email = '$_login1'");
		$_linhas = @mysql_num_rows($_linha);
		if ($_linhas == 1){
			$_tipo = @mysql_result ($_linha,0,'tipo');
			if ($_tipo == 'Moderador'){
				echo "<meta http-equiv='refresh' content='0, url=moderador.php'>";
			}
		}
		$_login = $_SESSION['email_session'];
		echo "<b>Logado como: </b>".$_login; echo "<br>"; echo "<b>Data: </b>".date('d/m/Y'); echo "|"; echo "<a href='?go=sair'>Sair</a><br><br>";
	$_pegar = $_POST['id'];
	$_linha = mysql_query("select * from comentario where id = '$_pegar' and status='Confirmado'");
	$_linhas = @mysql_num_rows($_linha);
	echo "<div class='todos1'><center><h2>Todos os comentários($_linhas)</h2></center></div>";
	for ($_i=0;$_i<$_linhas;$_i++){
		echo "<table id='cad_tablemoderador' border=5 bgcolor='gray' height=100 width=150></table>";
		echo "<div class='comentarios'>";
			$_resultado = mysql_fetch_assoc($_linha);
			echo "<br>";
			echo "<b><font size='4'>";
			$_email = $_resultado['email'];
			$id1 = $_resultado['idcom'];
			echo $_resultado['nome'];
			echo "</b> disse:<br>";
			echo "<p><center>";
			echo $_resultado['post'];
			if ($_email == $_login){
				echo "<form method='post' action='apagameucomentario.php'>
				<input type='hidden' value='$id1' name='id'>
				<input type='submit' name='btncomentario' value='Excluir' id='listarcomentar2' class='txt'>
				</form>";
			}
			echo "<br></font></center></p>";
			echo "<table id='cad_tablemoderador' border=5 bgcolor='gray' height=100 width=150></table>";
			echo "</div>";
		}
	}
	if (@$_GET['go'] == 'sair'){
	//deslogando e fechando sessão
	unset ($_SESSION ['email_session']);
	unset ($_SESSION ['senha_session']);
	echo "<meta http-equiv='refresh' content='0, url=../index.php'>";
	}
?>
</body>
</html>