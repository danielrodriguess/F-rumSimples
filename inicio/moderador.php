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
		<title>Bem vindo moderador - iPlay</title>
		<link rel="stylesheet" type="text/css" href="../estilo.css">
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body bgcolor="#A9A9A9" link="#E1E1E1" alink="#E1E1E1" vlink="#E1E1E1">
		<?php
			$_login = $_SESSION['email_session'];
		?>
		<?php echo "<b>Logado como: </b>".$_login;?> <br> <?php echo "<b>Data: </b>".date('d/m/Y');?> | <a href='?go=sair'>Sair</a><br><br>
		<form method='post' action='?go=gerenciar'>	
				<table id='cad_table'>
					<!--Adicionando campos-->
					<tr>
						<td><input type='submit' name = 'cadastro' value='GERENCIAR' id='cadge'></td>
					</tr>
				</table>
			</form>
			
		<?php
			$_linha = mysql_query("select * from moderador where status = 'Em análise'");
			$_linhas = @mysql_num_rows($_linha);
			echo "Você tem ".$_linhas." novas publicações";
			echo "<br><br>";
			while($_resultado = mysql_fetch_array($_linha)){
				echo "<div class='aceitar2'>";
				echo "<table id='cad_table1' border=5 bgcolor='gray' height=100 width=150></table>";
				echo "<b>Nome: </b>";
				echo $_resultado['email'];
				echo "<br>";
				echo "<b>Título do post: </b>";
				echo $_resultado['titulo'];
				echo "<br><p>";
				echo "<b>Post enviado: </b>";
				echo $_resultado['post'];
				$id = $_resultado['id'];
				echo "<br></p>";
						echo "<span><a href='libera.php?id=$id'><input type='submit' name = 'cadastro' value='Aceitar' id='cad'></a></span>
						<span><a href='recusa.php?id=$id'><input type='submit' name = 'cadastro' value='Recusar' id='cad'></a></span>
					</tr>
				</table>
			</form>";
			echo "<br><br>";
				echo "<table id='cad_table1' border=5 bgcolor='gray' height=100 width=150></table>";
				echo "</div>";
				echo "<br>";
			echo "<br>";
			}
			$_linha = mysql_query("select * from comentario where status = 'Em análise'");
			$_linhas = @mysql_num_rows($_linha);
			echo "Você tem ".$_linhas." novos comentarios";
			echo "<br><br>";
			while($_resultado = mysql_fetch_array($_linha)){
				echo "<br>";				echo "<table id='cad_table1' border=5 bgcolor='gray' height=100 width=150></table>";

				echo "<b>Nome: </b>";
				echo $_resultado['email'];
				echo "<br>";
				echo "<b>Post que vai receber o comentario: </b>";
				echo $_resultado['post'];
				$id = $_resultado['id'];
				echo "<br>";
						echo "<span><a href='liberacomentario.php?id=$id'><input type='submit' name = 'cadastro' value='Aceitar' id='cad' class='txt'></a></span>
						<span><a href='recusacomentario.php?id=$id'><input type='submit' name = 'cadastro' value='Recusar'  id='cad' class='txt'></a></span>
					</tr>
				</table>
			</form>";
			echo "<br>";
				echo "<table id='cad_table1' border=5 bgcolor='gray' height=100 width=150></table>";
				echo "<br>";
			echo "<br>";
			}
			$_linha = mysql_query("select * from sugestoes where status = 'Não lida'");
			$_linhas = @mysql_num_rows($_linha);
			echo '<center><img class="imgmensagem"src="../imagens/4.png" width="48" height="48"></center>';
			echo "<div class=a>Você tem ".$_linhas." mensagens não lidas</div>";
			echo "<br><br><br>";
			while($_resultado = mysql_fetch_array($_linha)){
				echo "<br><div class=aa>";				
				echo "<table id='cad_table1' border=5 bgcolor='gray' height=100 width=150></table>";
				echo "<b>Enviado por: </b>";
				echo $_resultado['email'];
				echo "<br>";
				echo "<b>Mensagem: </b>";
				echo $_resultado['sugestao'];
				
				$id = $_resultado['id'];
				echo "<br>";
						echo "<span><a href='liberamensagem.php?id=$id'><input type='submit' name = 'cadastro' value='Ok' id='cad'></a></span>
					</tr>
				</table>
			</form>";
			echo "<br><br>";
				echo "<table id='cad_table1' border=5 bgcolor='gray' height=100 width=150></table>";
				echo "</div>";
				echo "<br>";
			echo "<br>";
			}
		?>
	</body>
</html>
<?php
	}if (@$_GET['go'] == 'sair'){
		//deslogando e fechando sessÃ£o
		unset ($_SESSION ['email_session']);
		unset ($_SESSION ['senha_session']);
		echo "<meta http-equiv='refresh' content='0, url=../index.php'>";
	}elseif(@$_GET['go'] == 'aceitar'){
		$_resposta = $_POST["cadastro"];
		if ($_resposta == 'Aceitar'){
	
			
		}elseif($_resposta == 'Recusar'){
			
		}
	}elseif(@$_GET['go'] == 'gerenciar'){
		echo "<meta http-equiv='refresh' content='0, url=gerenciar.php'>";
	}	
?>