<?php 

	if (!empty($_SERVER['QUERY_STRING'])){
		$idtrab = substr($_SERVER['QUERY_STRING'], 1, 3);// pegando id do trabalho na url

		$link = "Location:painel/entrega.php?e=$idtrab";

		if(is_numeric($idtrab)){
			header($link);
		}

	}	
?>

<!DOCTYPE html>
<html lang="pt" dir="ltr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>::  TrabalhosJá  ::</title>

		<link rel="stylesheet" href="css/bootstrap-grid.css">

		<link rel="stylesheet" href="css/bootstrap.css">

		<link rel="stylesheet" href="css/index.css">

		<script type="text/javascript" src="js/jquery-3.4.1.js"></script>
		<script type="text/javascript">	

		    function Remove_modal(){
		      $("#mmodal").css('display', 'none')     
		      }
		    
		    setTimeout(Remove_modal, 5000)


			var status = true;
			$(document).ready(function(){

				$('#tecadastro').click(function(){
						$('#login').addClass('fadeform');
						$('#cadastro').addClass('form_vista')
				});

				$('#telogin').click(function(){
					$('#login').removeClass('fadeform');
					$('#cadastro').removeClass('form_vista')
				});



				$(document).on('keyup', '#senha2', function(){
					if ($('#senha').val() != $('#senha2').val()) {
						$('#senha2').css('color','red');
						$('#senha2').attr('title','As senha não coincidem!')
						$('#cadastrar').css('display', 'none')
				 	}else{
				 		$('#senha2').css('color','white');
				 		$('#senha2').attr('title', '');
				 		$('#cadastrar').css('display', '')
				 	}
					
			 	});

			});

		</script>
	</head>
	<body>
	<?php if (!empty($_GET['mtexto'])) { ?>
		<div id='mmodal'>
		    <div class='alerta'>
		      <p class='mtexto'><b><?=@$_GET['mtexto']?></b></p>
		      <span class='fechar' onclick='Remove_modal()'>x</span>
		    </div>
		  </div>
	<?php } ?>  
	
		<main class="container-fluid">
			<div class="row area">
				<section class="col-lg-6 col-md-6">

					<h4 id="telogin">Login</h4>
					<h4 id="tecadastro">Cadastro</h4>
					

					<form id="login" action="processar/processar.php" method="POST">

						<input class="campo" type="text" name="usuario" placeholder="Nome de usuário ou e-mail" title="insira seu usuário ou e-mail" required="required"><br>
						<input class="campo" type="password" name="senha" placeholder="senha" title="insira sua senha" required="required"><br>
						<input type="hidden" name="chamar" value="login">


						<input type="submit" id="entrar" value="Entrar">
					</form>
	 
					<form id="cadastro" action="processar/processar.php" method="POST">

						<input class="campo"  type="text" name="nome" placeholder="Nome de usuário" title="" required="required" id="usuario"><br>
						<input class="campo"  type="email" name="email" placeholder="E-Mail" required="" id="email"><br>
						<input class="campo"  type="password" name="senha" placeholder="Senha" required="required" id="senha"><br>
						<input class="campo"  type="password" name="senha2" placeholder="confirme a senha" required="required" id="senha2"><br>
						<input type="hidden" name="chamar" value="cadastro">

						<input id="cadastrar" type="submit" value="Cadastrar-se">
					</form>

				</section>


				<section class="col-lg-6 col-md-6 campanha">
					<h1>TrabalhosJá</h1>
					<h4>Não perca tempo com organização de folhas,<br>seja prático na entrega de seus trabalhos.</h4>
				</section>
			</div>
		</main>

		<div class="rodape">
			<i>TrabalhosJá</i>
		</div>

		<script type="text/javascript" src="js/bootstrap.js"></script>

	</body>
</html>
