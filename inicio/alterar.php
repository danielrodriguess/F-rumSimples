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
	<head>
	<style type="text/css"> 
		a:link 
		{ 
		 text-decoration:none; 
		} 
		</style>
		<title>Altere suas configurações - iPlay</title>
		<link rel="stylesheet" type="text/css" href="../estilo.css">
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body bgcolor="#A9A9A9" link="#E1E1E1" alink="#E1E1E1" vlink="#E1E1E1">
		<?php
			$_login = $_SESSION['email_session'];
		?>
		<?php echo "<b>Logado como: </b>".$_login;?> <br> <?php echo "<b>Data: </b>".date('d/m/Y');?> | <a href='?go=sair'>Sair</a><br><br>
		<?php
			$_linha = @mysql_query("select * from usuario where email = '$_login'");
			$_result = @mysql_num_rows($_linha);
			if ($_result == 1){
				$_nome = @mysql_result ($_linha,0,'nome');
				$_email = @mysql_result ($_linha,0,'email');
				$_data = @mysql_result ($_linha,0,'datadenascimento');
				echo "<center>Seus dados</center><br>";
				echo "<b>Nome: </b>".$_nome;
				echo "<br>";
				echo "<b>Email: </b>".$_email;
				echo "<br>";
				echo "<b>Data de nascimento: </b>".$_data;
			}else{
				echo "Erro com o servidor";
			}
		?>
		<div id="cadastro">
			<form method="post" action="?go=alterar">
				<table id="login">
					<tr>
						<td><input type="submit" name = "cadas1" value="Alterar dados" id="cadalterar"></td>
						<td><input type="submit" name = "cadas1" value="Deletar dados" id="caddel"></td>
						<td><input type="submit" name = "cadas1" value="Alterar senha" id="cadsenha"></td>
					</tr>
				</table>
			</form>
		</div>
	</body>
</html>
<?php
	}

	if (@$_GET['go'] == 'sair'){
		//deslogando e fechando sessÃ£o
		unset ($_SESSION ['email_session']);
		unset ($_SESSION ['senha_session']);
		echo "<meta http-equiv='refresh' content='0, url=../index.php'>";
	}elseif(@$_GET['go'] == 'alterar'){
		$_opcao = $_POST['cadas1'];
		if ($_opcao == 'Alterar dados'){
			echo "<form method='post' action='?go=cadastrar'>	
				<table id='cad_table'>
					<!--Adicionando campos-->
					<tr>	
						<td>Novo nome</td>
						<td><input type='text' name='nome' id='nome' class='txt' /></td>
					</tr>
					<tr>
						<td><input type='submit' name = 'cadastro' value='Alterar' id='cad'></td>
					</tr>
				</table>
			</form>";
		}elseif($_opcao == 'Deletar dados'){
			echo "<form method='post' action='?go=deletar'>	
				<table id='cad_table'>
					<!--Adicionando campos-->
					<tr>	
						<td>Resposta da sua pergunta de segurança:</td>
						<td><input type='text' name='resposta' id='nome' class='txt' /></td>
					</tr>
					<tr>
						<td><input type='submit' name = 'cadastro' value='Confirmar' id='cad'></td>
					</tr>
				</table>
			</form>";
		}elseif($_opcao == 'Alterar senha'){
			echo "<form method='post' action='?go=alterarsenha'>	
				<table id='cad_table'>
					<!--Adicionando campos-->
					<tr>	
						<td>Digite sua atual senha</td>
						<td><input type='password' name='atual' id='nome' class='txt' /></td>
					</tr>
					<tr>	
						<td>Nova senha</td>
						<td><input type='password' name='novasenha' id='nome' class='txt' /></td>
					</tr>
					<tr>	
						<td>Confirme sua nova senha</td>
						<td><input type='password' name='novasenha1' id='nome' class='txt' /></td>
					</tr>
					<tr>
						<td><input type='submit' name = 'cadastro' value='Confirmar' id='cad'></td>
					</tr>
				</table>
			</form>";
		}
	}
?>
<?php
	if(@$_GET['go'] == 'cadastrar'){
		$_nome = $_POST["nome"];
		$_linha = mysql_num_rows(mysql_query("select * from usuario where email = '$_login'"));
		if ($_linha == 1){
			mysql_query("update usuario set nome = '$_nome' where email = '$_login'");
			echo "<meta http-equiv='refresh' content='0.5, url=alterar.php'>";
			echo "Alterado com sucesso";
		}else{
			echo "Erro com o servidor";
		}
	}elseif(@$_GET['go'] == 'deletar'){
		$_resposta = $_POST["resposta"];
		$_linha = mysql_query("select * from usuario where resposta = '$_resposta' and email = '$_login'");
		$_linhas = @mysql_num_rows($_linha);
			if ($_linhas == 1){
				mysql_query("delete from usuario where email = '$_login'");
				unset ($_SESSION ['email_session']);
				unset ($_SESSION ['senha_session']);
				echo "<meta http-equiv='refresh' content='0, url=../index.php'>";
			}else{
				echo "Resposta errada";
			}
	}elseif(@$_GET['go'] == 'alterarsenha'){
		$_senha = $_POST["atual"];
		$_senha1 = $_POST["novasenha"];
		$_senha2 = $_POST["novasenha1"];
		$_linha = mysql_query("select * from usuario where email = '$_login' and senha = '$_senha'");
		$_linhas = @mysql_num_rows($_linha);
			if ($_linhas == 1){
				if ($_senha1 != $_senha2){
					echo "Senhas não conferem";
				}else{
						mysql_query("update usuario set senha = '$_senha1' where email = '$_login'");
						unset ($_SESSION ['email_session']);
						unset ($_SESSION ['senha_session']);
						echo "<meta http-equiv='refresh' content='0, url=../index.php'>";
				}
			}else{
				echo "Atual senha incorreta";
			}
	}
?>