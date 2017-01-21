<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="icone/1.ico" type="image/x-icon"/>
	</head>
</html>
<?php
	session_start();
	require_once "config.php";
	//se a sessão estiver fechada
	if (!isset($_SESSION['email_session']) && !isset($_SESSION['senha_session'])){
?>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="utf-8">
		<title>Acesse e aproveite - iPlay</title>
		<link rel="stylesheet" type="text/css" href="estilo.css">
	</head>
	<body bgcolor="#A9A9A9" link="#E1E1E1" alink="#E1E1E1" vlink="#E1E1E1">
	<div class="img5"><center><img src="imagens/1.png" width="640" height="360"></center></div>
		<div id="cadastro">
			<form method="post" action="?go=logar ">
				<table id="login">
					<tr>
						<td>E-mail</td>
						<td><input type="text" name="email" id="email" class="txt" placeholder="Seu e-mail"/></td>
					</tr>
					<tr>
						<td>Senha</td>
						<td><input type="password" name="senha" id="senha" class="txt" placeholder="Sua senha"/></td>
					</tr>
					<tr>
						<td><input type="submit" value="LOGAR" id="cad"></td>
						&nbsp;<a href='cadastro.php'><input type="button" value="Cadastrar-se" class="txt" id="cadd"></a></td>
					</tr>
				</table>
			</form>
		</div>
	</body>
</html>
<?php
	}else{
	echo "<meta http-equiv='refresh' content='0, url=./inicio/'>";
}
?>
<?php
	//se ação do botão for 'logar'
	if (@$_GET['go'] == 'logar'){
		//pegando valores para realizar a autenticação junto ciomo bd
		$_email = $_POST['email'];
		$_senha = $_POST ['senha'];
		//verificando se os campos estão preenchidos
		if (empty($_email)){
			echo "Preencha todos os campos para logar-se";
		}elseif (empty($_senha)){
			echo "Preencha todos os campos para logar-se";
		}else{
			//realizar contagem para verificar se os dados foram inseridos
			$_linha = mysql_num_rows(mysql_query("select * from usuario where email = '$_email' and senha = '$_senha'"));
			//se o resultado for igual a '1' significa que sim
			if ($_linha == 1){
				$_nome = @mysql_result ($_linha,0,'nome');
				//sessão
				$_SESSION ['email_session'] = $_email;
				$_SESSION ['senha_session'] = $_senha;
				$_SESSION ['nome_session'] = 'a';
				//redirecionando para home
				echo "<meta http-equiv='refresh' content='0, url=./inicio/'>";
			}else{
				//caso dados estejam inválidos
				echo "<div id='dados'>Dados inválidos</div>";
			}
		}
	}
?>