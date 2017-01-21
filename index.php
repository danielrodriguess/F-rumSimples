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
		a:link 
		{ 
		 text-decoration:none; 
		} 
		</style>
		<meta charset="utf-8">
		<title>Tire suas dúvidas - iPlay</title>
		<link rel="stylesheet" type="text/css" href="estilo.css">
	</head>
	<body bgcolor="#A9A9A9" link="#E1E1E1" alink="#E1E1E1" vlink="#E1E1E1">
	Bem vindo visitante
	<br>
	Data: 
	<?php
	echo date("d/m/Y");
	?>
		<center><img src="imagens/1.png"></center>
		<center>Bem vindo ao nosso fórum</center>
		<br><br>
		<form method="post" action="?go=publicar">
				<table id="login">
					<tr>
						<div class="titulo"></div>
						Efetue login ou cadastre-se para comentar/ver comentários ou postar algo. Obrigado!
						</td>
						<div align="top">
						<a href='login.php'><input type="button" value="Logar" class="txt" id="cadd5"></a></td>
						</div>
		</form>
		<?php
		$_linha = mysql_query("select * from moderador where status = 'Confirmado'");
		$_linhas = @mysql_num_rows($_linha);	
		echo "<center><h2>Publicações</h2></center>";
		echo "<table id='cad_tablemoderador' border=5 bgcolor='gray' height=100 width=150></table>";
		for ($_i=0;$_i<$_linhas;$_i++){
			echo "<div class='fundos2'>";
			$_resultado = mysql_fetch_assoc($_linha);
			$id = $_resultado['id'];
			echo "<b>Publicado por: </b>";
			echo "<img src='imagens/2.png' width=150px height=100px align='right'>";
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

			echo "<br>";
			echo "<table id='cad_tablemoderador' border=5 bgcolor='gray' height=100 width=150></table>";
			echo "</div>";
			echo "<br>";
		}
		?>
	</body>
</html>