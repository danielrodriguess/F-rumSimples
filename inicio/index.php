<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
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
			$_nome = @mysql_result ($_linha,0,'nome');
			$_tipo = @mysql_result ($_linha,0,'tipo');
			if ($_tipo == 'Moderador'){
				echo "<meta http-equiv='refresh' content='0, url=moderador.php'>";
			}
		}
	?>
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css"> 
		a:link 
		{ 
		 text-decoration:none; 
		} 
		</style>
		<meta charset="utf-8">
		<title>Tire suas dúvidas - iPlay</title>
		<link rel="stylesheet" type="text/css" href="../estilo.css">
	</head>
	<body bgcolor="#A9A9A9" link="#E1E1E1" alink="#E1E1E1" vlink="#E1E1E1">
		<?php
			$_login = $_SESSION['email_session'];
		?>
		<?php echo "<b>Logado como: </b>".$_login;?> <br> <?php echo "<b>Data: </b>".date('d/m/Y');?> | <a href='?go=sair'>Sair</a><br><br>
		<center><img src="../imagens/1.png"></center>
		<div id="cadastro">
			<form method="post" action="alterar.php">
				<table id="login">
					<tr>
						<td><input type="submit" value="ALTERAR DADOS" id="cadalterar1"></td>
					</tr>
				</table>
			</form>
		</div>
		<center>Bem vindo ao nosso fórum</center>
		<br><br>
		<form method="post" action="?go=publicar">
				<table id="login">
					<tr>
						<div class="titulo">Titulo</div>
						<center><input type="text" name="titulo" class="txt"></center>
						<br>
						<center><textarea class="textoarea" cols="48" rows="14" name="post"></textarea></center>
						<input type="submit" value="Publicar" id="post">
					</tr>
				</table>
			</form>
		<?php
		echo '<a href="sugestoes.php"><center><img class="imgsuges"src="../imagens/3.png" width="1280" height="360"></center></a>';
		echo "<div class='ordenacao'>
				<form method='post' action='?go=opcao'>
				Ordenar por:
				<select name='pergunta' class='pergunta'>
				<option value='vazio'></option>
				<option value='Data'>Data mais recente</option>
				<option value='Ordem alfabetica do titulo'>Orderm alfabetica do titulo</option>
				<option value='Ordem alfabetica do usuário'>Ordem alfabetica do usuário</option>
				</select>
				</form>
				</div>";
		$_linha = mysql_query("select * from moderador where status = 'Confirmado'");
		$_linhas = @mysql_num_rows($_linha);	
		echo "<center><h2>Todas as publicações</h2></center>";
		echo "<table id='cad_tablemoderador' border=5 bgcolor='gray' height=100 width=150></table>";
		for ($_i=0;$_i<$_linhas;$_i++){
			echo "<div class='fundos'>";
			$_resultado = mysql_fetch_assoc($_linha);
			$id = $_resultado['id'];
			echo "<b>Publicado por: </b>";
			echo "<img src='../imagens/2.png' width=150px height=100px align='right'>";
			echo $_resultado['email'];
			echo "<br>";
			echo "<div class='data'><i><font color='#808080' size=3>Data: ";
			echo $_resultado['dataa'];
			echo "</i></font></a></div><br>";
			echo "<p><center>";
			echo "<b>".$_resultado['titulo'];
			echo "</b>";
			echo "<br>";
			echo $_resultado['post'];
			echo "</center></p>";
			echo "<form method='post' action='?go=comentar'>
			<input type='text' name='comentario' id='coment4' class='txt'>
			<input type='hidden' value='$id' name='id'>
			<input type='hidden' value='$_login1' name='log'>
			<input type='submit' name='btncomentario' value='Comentar' class='txt'>
			</form>";
			echo "<form method='post' action='listarcomentarios.php'>
			<input type='hidden' value='$id' name='id'>
			<input type='submit' name='btncomentario' value='Listar comentários' id='listarcomentar' class='txt'>
			</form>";
			echo "<table id='cad_tablemoderador' border=5 bgcolor='gray' height=100 width=150></table>";
			echo "</div>";
		}
		?>
	</body>
</html>
<?php
	if (@$_GET['go'] == 'publicar'){
		$_post = $_POST["post"];
		$_titulo = $_POST["titulo"];
		$data = date("d/m/Y");
		if (empty($_post)){
			echo "<font color='red'><div class='digite1'>Digite algo</div></font>";
		}elseif(empty($_titulo)){
			echo "<font color='red'><div class='digite1'>Digite algo</div></font>";
		}else{
		mysql_query("insert into moderador (id,email,titulo,post,status,dataa)values (null,'$_nome','$_titulo','$_post','Em análise','$data')");
		echo "<script>alert('Enviado ao moderador')</script>";
		}
	}
	elseif (@$_GET['go'] == 'comentar'){
				$_pegar = $_POST['id'];
				$_comentario = $_POST['comentario'];
				$_login1 = $_POST['log'];
				mysql_query("insert into comentario (idcom,id,nome,email,post,status) values (null,'$_pegar','$_nome','$_login1','$_comentario','Confirmado')");

			}
	if (@$_GET['go'] == 'sair'){
	//deslogando e fechando sessão
	unset ($_SESSION ['email_session']);
	unset ($_SESSION ['senha_session']);
	echo "<meta http-equiv='refresh' content='0, url=../index.php'>";
	}elseif(@$_GET['go'] == 'coment'){
		$_comentario = $_POST['comentar'];
		if (empty($_comentario)){
			echo "Digite algo";
		}else{
			mysql_query("insert into comentario (id,email,post,status) values ('$id','$_login','$_comentario','Ok')");
		}
	}
	}
?>