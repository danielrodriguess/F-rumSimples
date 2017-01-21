<html>
	<head>
		<link rel="shortcut icon" href="../icone/1.ico" type="image/x-icon"/>
	</head>
</html>
<?php
	require_once "../config.php";
	session_start();
	if (!isset($_SESSION['email_session']) && !isset($_SESSION['senha_session'])){
	echo "<meta http-equiv='refresh' content='0, url=../index.php'>";
	}else{		
?>
<html>
	<?php
		$_login1 = $_SESSION['email_session'];
		$_linha = mysql_query("select * from usuario where email = '$_login1'");
		$_linhas = @mysql_num_rows($_linha);
		if ($_linhas == 1){
			$_tipo = @mysql_result ($_linha,0,'tipo');
			if ($_tipo == 'Moderador'){
				echo "<meta http-equiv='refresh' content='0, url=moderador.php'>";
			}
		}
	?>
	<head>
	<style type="text/css"> 
		a:link 
		{ 
		 text-decoration:none; 
		} 
		</style>
		<meta charset="utf-8">
		<title>Mande sugestões - iPlay</title>
		<link rel="stylesheet" type="text/css" href="../estilo.css">
	</head>
	<body bgcolor="#A9A9A9" link="#E1E1E1" alink="#E1E1E1" vlink="#E1E1E1">
		<?php
			$_login = $_SESSION['email_session'];
		?>
		<?php echo "<b>Logado como: </b>".$_login;?> <br> <?php echo "<b>Data: </b>".date('d/m/Y');?> | <a href='?go=sair'>Sair</a><br><br>
		<?php
		echo "<br><br>";
		
		echo "<form method=post action='?go=enviar'>
		<center><textarea rows=12 cols=48 name='envio'></textarea></center>
		<br>
		<center><input type=submit value='Enviar Sugestão' class='txt'></center>
		</form>";
		echo "<div class='admin'><center>Os administradores agradecem a sua opinião</center></div>";
		?>
		<?php
	}
	if (@$_GET['go'] == 'sair'){
	//deslogando e fechando sessão
	unset ($_SESSION ['email_session']);
	unset ($_SESSION ['senha_session']);
	echo "<meta http-equiv='refresh' content='0, url=../index.php'>";
	}elseif(@$_GET['go'] == 'enviar'){
		$_sugestao = $_POST['envio'];
		mysql_query("insert into sugestoes (id,email,sugestao,status) values (null,'$_login','$_sugestao','Não lida')");
		echo "<font color='green'><center><div class='enviada'>Sugestão enviada</div></center></font>";
	}
		?>
	</body>
	</html>