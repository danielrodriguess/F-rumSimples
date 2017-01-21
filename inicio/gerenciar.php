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
			$_nome = @mysql_result ($_linha,0,'nome');
			if ($_tipo == 'Comum'){
				echo "<meta http-equiv='refresh' content='0, url=index.php'>";
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
		<title>Gerenciamento do fórum - iPlay</title>
		<link rel="stylesheet" type="text/css" href="../estilo.css">
	</head>
	<body bgcolor="#A9A9A9" link="#E1E1E1" alink="#E1E1E1" vlink="#E1E1E1">
		<?php
			$_login = $_SESSION['email_session'];
		?>
		<?php echo "<b>Logado como: </b>".$_login;?> <br> <?php echo "<b>Data: </b>".date('d/m/Y');?> | <a href='?go=sair'>Sair</a><br><br>
		<div id="cadastro">
			<form method="post" action="alterar.php">
				<table id="login">
					<tr>
						<td><input type="submit" value="ALTERAR DADOS" id="cadalterar1"></td>
					</tr>
				</table>
			</form>
			<form method="post" action="alterar.php">
				<table id="login">
					<tr>
						<td><input type="submit" value="ALTERAR DADOS" id="cadalterar6"></td>
					</tr>
				</table>
			</form>
		</div>
		<center>Bem vindo moderador - iPlay</center>
		<br><br>
		<form method="post" action="?go=publicar">
				<table id="login">
					<tr>
						<div class="titulo">Titulo</div>
						<center><input type="text" name="titulo" class="txt"></center>
						<br>
						<center><textarea cols="48" rows="14" name="post"></textarea></center>
						<input type="submit" value="Publicar" id="post">
					</tr>
				</table>
			</form>
		<?php
		$_linha = mysql_query("select * from moderador where status = 'Confirmado'");
		$_linhas = @mysql_num_rows($_linha);
		echo "<div class='todos'>";
		echo "<center><h2>Todas as publicações</h2></center>";
		echo "</div>";
		
		for ($_i=0;$_i<$_linhas;$_i++){
			echo "<table id='cad_tablemoderador' border=5 bgcolor='gray' height=100 width=150></table>";
			echo "<div class='fundos1'>";
			$_resultado = mysql_fetch_assoc($_linha);
			$id = $_resultado['id'];
			echo "<b>Publicado por:  </b>";
			echo "<img src='../imagens/2.png' width=150px height=100px align='right'>";
			echo $_resultado['email'];
			echo "<br>";
			echo "<div class='data'><i><font color='#808080' size=3>Data: ";
			echo $_resultado['dataa'];
			echo "</i></font></div><br>";
			echo "<p><center>";
			echo "<b>".$_resultado['titulo'];
			echo "</b>";
			echo "<br>";
			echo $_resultado['post'];
			echo "</center></p>";
			echo "<a href='apagar.php?id=$id'><input type='submit' name = 'cadastro' value='Excluir publicação' id='coment3'></a>";
			echo "<br>";
			$_linha1 = mysql_query("select * from comentario where id = '$id' and status='Confirmado'");
			$_linhas1 = @mysql_num_rows($_linha1);
			echo "<div class='todos1'><center><h2>Todos os comentários($_linhas1)</h2></center></div>";
			for ($_k=0;$_k<$_linhas1;$_k++){
				echo "<center>";
				echo "<table id='cad_tablecomentario' border=5 bgcolor='gray' height=100 width=150></table>";
				echo "<div class='comentarios1'>";
				$_resultado = mysql_fetch_assoc($_linha1);
				$id1 = $_resultado['idcom'];
				echo "<br>";
				echo "<b><font size='4'>";
				echo "<div class='alinhanome'>";
				echo $_resultado['nome'];
				echo "</b> disse:<br>";
				echo "</div>";
				echo "<p><center>";
				echo $_resultado['post'];
				echo "<br></font></center></p>";
				echo "<form method='post' action='apagacomentario.php'>
				<input type='hidden' value='$id1' name='id'>
				<input type='submit' name='btncomentario' value='Excluir' id='listarcomentar1' class='txt'>
				</form>";
				echo "<table id='cad_tablecomentario' border=5 bgcolor='gray' height=100 width=150></table>";
				echo "</div>";
				echo "</center>";
			}
			}
			echo "<table id='cad_tablemoderador' border=5 bgcolor='gray' height=100 width=150></table>";
			echo "</div>";
			echo "<br>";
		
		?>
	</body>
</html>
<?php
	if (@$_GET['go'] == 'publicar'){
		$_post = $_POST["post"];
		$_titulo = $_POST["titulo"];
		$data = date("d/m/Y");
		if (empty($_post)){
			echo "<font color='red'><div class='digite'>Digite algo</div></font>";
		}elseif(empty($_titulo)){
			echo "<font color='red'><div class='digite'>Digite algo</div></font>";
		}else{
		mysql_query("insert into moderador (id,email,titulo,post,status,dataa)values (null,'$_nome','$_titulo','$_post','Confirmado','$data')");
		echo "<meta http-equiv='refresh' content='0, url=gerenciar.php'>";
	}
	}
	if (@$_GET['go'] == 'sair'){
	//deslogando e fechando sessão
	unset ($_SESSION ['email_session']);
	unset ($_SESSION ['senha_session']);
	echo "<meta http-equiv='refresh' content='0, url=../index.php'>";
	}
	}
?>