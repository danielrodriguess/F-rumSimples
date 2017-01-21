<html>
	<head>
		<link rel="shortcut icon" href="icone/1.ico" type="image/x-icon"/>
	</head>
</html>
<?php
	require_once "config.php";
?>
<html>
	<head>
		<style type="text/css"> 
			a:link{ 
			text-decoration:none;
			} 
		</style>
		<title>Cadastra-se no iPlay</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="estilo.css">
	</head>
	<body bgcolor="#A9A9A9" link="#E1E1E1" alink="#E1E1E1" vlink="#E1E1E1">
		<img src="imagens/2.png" width="640" height="360" align="left">
		<div id="cadastro">
			<!--Tabela dentro do formulario fica mais organizado, ação do php na mesma página é menos confuso-->
			<form method="post" action="?go=cadastrar">	
				<table id="cad_table">
					<!--Adicionando campos-->
					<tr>	
						<td>Nome</td>
						<td><input type="text" name="nome" id="nome" class="txt1" /></td>
					</tr>
					<tr>	
						<td>Data de nascimento(D/M/A)</td>
						<td><input type="text" name="data" id="nome" class="txt1" /></td>
					</tr>
					<tr>	
						<td>E-mail</td>
						<td><input type="text" name="email" id="email" class="txt1" /></td>
					</tr>
					<tr>
						<td>Senha</td>
						<td><input type="password" name="senha" id="cpf" class="txt1" /></td>
						<!--<td><input type="submit" name = "cadastro" value="Buscar CPF" id="bus"></td>-->
					</tr>
					<tr>
						<td>Confirme a senha</td>
						<td><input type="password" name="senha1" id="cpf" class="txt1" /></td>
						<!--<td><input type="submit" name = "cadastro" value="Buscar CPF" id="bus"></td>-->
					</tr>
					<tr>
						<td>Escolha uma pergunta de segurança</td>
						<td>
						<select name="pergunta" class="pergunta">
						<option value="vazio"></option>
						<option value="Qual é o sobrenome da sua madrinha?">Qual é o sobrenome da sua madrinha?</option>
						<option value="Qual era o nome do seu primeiro cachorro?">Qual era o nome do seu primeiro cachorro?</option>
						<option value="Qual era o seu apelido quando criança?">Qual era o seu apelido quando criança?</option>
						<option value="Qual é o sobrenome da sua mãe?">Qual é o sobrenome da sua mãe?</option>
						</select>
						<!--<td><input type="submit" name = "cadastro" value="Buscar CPF" id="bus"></td>-->
					</tr>
						<tr>
							<td>Sua Resposta</td>
							<td><input type="text" name="seguranca" id="cpf" class="txt1" /></td>
							<!--<td><input type="submit" name = "cadastro" value="Buscar CPF" id="bus"></td>-->
						</tr>
						<tr>
							<td><input type="submit" name = "cadastro" value="Cadastrar" id="cad"></td>
							<a href='login.php'><input type="button" value="Logar" class="txt" id="cadd"></a>
							</td>
						</tr>
				</table>
			</form>
		</div>
		<br><br>
		<center>Cadastre-se e obtenha as informações sempre em primeira mão</center>
	</body>
</html>
<?php
	//Se ação for igual a cadastrar que é o nome do formulario
	if (@$_GET['go'] == 'cadastrar'){
		//pegando valores digitados
		$_opcao = $_POST['cadastro'];
		if ($_opcao == 'Cadastrar'){
			$_pergunta = $_POST['pergunta'];
			$_data = $_POST['data'];
			$_nome = $_POST['nome'];
			$_email = $_POST['email'];
			$_senha = $_POST['senha'];
			$_senha1 = $_POST['senha1'];
			$_resposta = $_POST['seguranca'];
			//verificando se campos estão vazios
			echo "<html><head><link rel='stylesheet' type='text/css' href='estilo.css'></head></html>";
			if (empty($_nome)){
				echo "<div class='campo'>Campos vazios</div>";
				echo '<script>window.setTimeout("history.back()", 0500);</script>';
			}elseif (empty($_email)){
				echo "<div class='campo'>Campos vazios</div>";
				echo '<script>window.setTimeout("history.back()", 0500);</script>';
			}elseif (empty($_data)){
				echo "<div class='campo'>Campos vazios</div>";
				echo '<script>window.setTimeout("history.back()", 0500);</script>';
			}elseif (empty($_senha)){
				echo "<div class='campo'>Campos vazios</div>";
				echo '<script>window.setTimeout("history.back()", 0500);</script>';
			}elseif (empty($_senha1)){
				echo "<div class='campo'>Confirme a senha</div>";
				echo '<script>window.setTimeout("history.back()", 0500);</script>';
			}elseif ($_pergunta == 'vazio'){
				echo "<div class='campo'>Escolha uma pergunta</div>";
				echo '<script>window.setTimeout("history.back()", 0500);</script>';
			}elseif (empty($_resposta)){
				echo "<div class='campo'>Responda a pergunta</div>";
				echo '<script>window.setTimeout("history.back()", 0500);</script>';
			}else{
			if ($_senha != $_senha1){
			echo "<div class='campo5'>Senhas não conferem</div>";
			echo '<script>window.setTimeout("history.back()", 0500);</script>';
			}else{
				$_data = $_POST['data'];
				$_verificar = strlen($_data);
				if ($_verificar > 10){
					echo "<div class='campo6'><font color=red>Data inválida</font></div>";
					echo '<script>window.setTimeout("history.back()", 1000);</script>';
				}else{
					$_dia = substr($_data,0,2);
					$_mes = substr($_data,3,2);
					$_ano = substr($_data,6,9);
					if ($_ano > 2008){
						echo "Muito novo para se cadastrar, desculpe!";
						echo '<script>window.setTimeout("history.back()", 1000);</script>';
					}else{
						if ($_ano % 4 == 0 && $_ano % 100 != 0 || $_ano % 400 == 0 ){
							if ($_dia > 29 && $_mes == 02){
								echo "<div class='campo6'><font color=red>Data inválida</font></div>";
								echo '<script>window.setTimeout("history.back()", 1000);</script>';
							}elseif($_dia > '31' or $_mes > '12' or $_dia < 1 or $_mes < 1 or $_ano < 1){
								echo "<div class='campo6'><font color=red>Data inválida</font></div>";
								echo '<script>window.setTimeout("history.back()", 1000);</script>';
							}elseif($_dia == '31' && $_mes != '1' && $_mes != '3' && $_mes != '5' && $_mes != '7' && $_mes != '8' && $_mes != '10' && $_mes != '12'){
								echo "<div class='campo6'><font color=red>Data inválida</font></div>";
								echo '<script>window.setTimeout("history.back()", 1000);</script>';
							}else{
								$_linha = mysql_num_rows(mysql_query("select * from usuario where email = '$_email'"));
								if ($_linha == 1){
									echo "<div class='campo3'>Esse E-mail já foi cadastrado</div>";
									echo '<script>window.setTimeout("history.back()", 1000);</script>';
								}else{
									mysql_query("insert into usuario (nome,email,senha,pergunta,resposta,tipo,datadenascimento) values ('$_nome','$_email','$_senha','$_pergunta','$_resposta','Comum','$_data')");
									echo "<script>alert('Cadastrado com sucesso. Redirecionando para a tela de login')</script>";
									echo "<meta http-equiv='refresh' content='0, url=login.php'>";
								}	
							}
						}else{
							if ($_dia > 28 && $_mes == 02){
								echo "<div class='campo6'><font color=red>Data inválida</font></div>";
								echo '<script>window.setTimeout("history.back()", 1000);</script>';
							}elseif($_dia > '31' or $_mes > '12' or $_dia < 1 or $_mes < 1 or $_ano < 1){
								echo "<div class='campo6'><font color=red>Data inválida</font></div>";
								echo '<script>window.setTimeout("history.back()", 1000);</script>';
							}elseif($_dia == '31' && $_mes != '1' && $_mes != '3' && $_mes != '5' && $_mes != '7' && $_mes != '8' && $_mes != '10' && $_mes != '12'){
								echo "<div class='campo6'><font color=red>Data inválida</font></div>";
								echo '<script>window.setTimeout("history.back()", 1000);</script>';
								}else{
									$_linha = mysql_num_rows(mysql_query("select * from usuario where email = '$_email'"));
									if ($_linha == 1){
										echo "<div class='campo3'>Esse E-mail já foi cadastrado</div>";
										echo '<script>window.setTimeout("history.back()", 1000);</script>';
									}else{
										mysql_query("insert into usuario (nome,email,senha,pergunta,resposta,tipo,datadenascimento) values ('$_nome','$_email','$_senha','$_pergunta','$_resposta','Comum','$_data')");
										echo "<script>alert('Cadastrado com sucesso. Redirecionando para a tela de login')</script>";
										echo "<meta http-equiv='refresh' content='3, url=login.php'>";
									}
								}
							}
						}
					}
				}
			}
		}
	}	
?>