<?php
	//=TrabalhosJa=//
	try {
		$conexao = new PDO("mysql:host=localhost;port=3306;dbname=bdtrabalhosja;charset=utf8", "root", "");
		$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 } catch(PDOException $e){
	   	echo $e->getMessage();
	        die();
	    }
	
	$idprof = 'null';

	function Cadastrar(&$nome, &$email, &$senha)
	{

		$sql = "INSERT INTO usuarios (nm_usuario, email, senha) 
				VALUES ('$nome', '$email',  '$senha');";

		global $conexao;

		if($conexao->exec($sql) == true){

			echo "<script>alert('Cadastrado com Sucesso!')</script>";
			// echo "<script type='text/javascript'>window.location.assign('../painel/compose.php')</script>";
			echo Login($nome, $senha);

		}else{
			print_r($conexao->errorInfo());
			echo "<script type='text/javascript'>window.location.assign('index.php')</script>";
		}	
	}


	function Login($usuario, $senha)
	{	
		global $conexao;
		$sql = "SELECT id_professor, nm_usuario, email, senha 
				FROM usuarios 
				WHERE email = '$usuario' 
				OR nm_usuario = '$usuario';";

		if(!$dados = $conexao->query($sql)){
			print_r($dados->errorInfo());
		}else{
			//$valida = $dados->fetch(PDO::FETCH_ASSOC);
			$valida = $dados->fetch();
		}						 

		if (	(	(@$valida['nm_usuario'] == $usuario) || (@$valida['email'] == $usuario)	) & (@$valida['senha'] == $senha)  ) {
			
			$mtexto = "Ola $usuario! Seja bem vindo(a)<br>ao nosso sistema.";

			echo "<script type='text/javascript'>window.location.assign('../painel/compose.php?mtexto=$mtexto')</script>";

			session_start();
			$_SESSION['usuario'] = $valida['nm_usuario'];
			$_SESSION['idprof'] = $valida['id_professor'];

			}
			elseif((@$valida['nm_usuario'] == $usuario) || (@$valida['email'] == $usuario)){	
				echo "<script>window.location.assign('../index.php?mtexto=Senha incorreta!')</script>";
			}else{
				echo "<script>window.location.assign('../index.php?mtexto=Nome de usuário incorreto ou inexistente!')</script>";			
		}

	}

	
	function Logout()
	{
		session_start();
		session_destroy();
		session_unset();
		header('location:../index.php');
	}	

	function Nv_mat_tur($tabela, $campo, $idprof, $mat_tur)
	{
		$sql = "INSERT INTO $tabela (id_professor, $campo) 
				VALUES ($idprof,'$mat_tur');";

		global $conexao;

		if($conexao->exec($sql) == true){
		echo "<script type='text/javascript'>window.location.assign('../painel/compose.php')</script>";		
		}
	}


	function GerarTarefa($idprof, $id_materia, $id_turma, $dtfin, $titulo, $contexto)
	{
		global $conexao;	
		
		if(isset($_FILES['arquivo']['name']) && $_FILES['arquivo']['error'] == 0){
			$arquivo_tmp = $_FILES['arquivo']['tmp_name'];
			$nome = $_FILES['arquivo']['name'];
			$extensao = pathinfo( $nome, PATHINFO_EXTENSION );// Pegando a extensão
			//Criando um nome unico
			$novoNome =  date("d.m.Y-H.i.s") . uniqid() . '.' . $extensao;
			//endereço e nome
			$destino = '../painel/upload/' . $novoNome;
			//Movendo
			if(move_uploaded_file($arquivo_tmp, $destino) == true){
				//Salvando endereço no banco
				$sql = "INSERT INTO `trabalhos`(`id_professor`, `id_turma`, `id_materia`, `data_limite`, `titulo`, `contexto`, `anexo_extra`)
 				VALUES ($idprof, $id_turma, $id_materia, '$dtfin', '$titulo', '$contexto', '$destino');";
				$conexao->query($sql);
				$idt = $conexao->lastInsertId();
				$link = "http://localhost/trabalhosja/?I$idt" . "ENT";
				$conexao->query("UPDATE `trabalhos` SET `link`='$link' WHERE id_trabalho = $idt");
				$mtexto = "Muito bem! Seus alunos já podem começar a fazer seus trabalhos.<br>$link<br>";	
				echo "<script type='text/javascript'>window.location.assign('../painel/compose.php?mtexto=$mtexto')</script>";				

			}else{
				$mtexto = "Desculpe não foi possivel mover seu anexo!<br>$link<br> ERRO: " . $_FILES['arquivo']['error'];	
				echo "<script type='text/javascript'>window.location.assign('../painel/compose.php?mtexto=$mtexto')</script>";
			}
		}else{
				$sql = "INSERT INTO `trabalhos`(`id_professor`, `id_turma`, `id_materia`, `data_limite`, `titulo`, `contexto`)
 				VALUES ($idprof, $id_turma, $id_materia, '$dtfin', '$titulo', '$contexto');";
				$conexao->query($sql);
				$idt = $conexao->lastInsertId();
				$link = "http://localhost/trabalhosja/?I$idt" . "ENT";
				$conexao->query("UPDATE `trabalhos` SET `link`='$link' WHERE id_trabalho = $idt");
				$mtexto = "Muito bem! Seus alunos já podem começar a fazer seus trabalhos.<br>$link<br>";	
				echo "<script type='text/javascript'>window.location.assign('../painel/compose.php?mtexto=$mtexto')</script>";	
		}		
	}			

	function EntregarTarefa($idtrab, $turma, $idprof, $aluno,  $email,   $titulo, $txtrabalho)
	{	
		global $conexao;
		if(isset($_FILES['arquivo']['name']) && $_FILES['arquivo']['error'] == 0){
			$arquivo_tmp = $_FILES['arquivo']['tmp_name'];
			$nome = $_FILES['arquivo']['name'];
			$extensao = pathinfo( $nome, PATHINFO_EXTENSION );// Pegando a extensão
			//Criando um nome unico
			$novoNome =  date("d.m.Y-H.i.s") . uniqid() . '.' . $extensao;
			//endereço e nome
			$destino = '../painel/upload/' . $novoNome;
			//Movendo
			if(move_uploaded_file($arquivo_tmp, $destino)){
				//Salvando endereço no banco
				$sql = "INSERT INTO `entregas`(`id_trabalho`, `id_turma`, `id_professor`, `nm_estudante`, `email`, `titulo`, `conteudo`, `anexo_extra`)
			 	VALUES ($idtrab, $turma, $idprof, '$aluno', '$email', '$titulo', '$txtrabalho', '$destino');";
				if($conexao->query($sql)){
					$mtexto = "Muito bem! Você entregou seu trabalho a tempo!.<br>";	
					echo "<script type='text/javascript'>window.location.assign('../?mtexto=$mtexto')</script>";
				}else{
					$mtexto = "Descuple! Houve um erro ao entregar seu trabalho, tente nopvamente mais tarde!.<br>";	
					echo "<script type='text/javascript'>window.location.assign('../?mtexto=$mtexto')</script>";			
				}
			}else{
				echo "Impossivel Mover";
			}
		}else{
			echo "Não fooi possivel carregar a imagem!";
			print($_FILES['arquivo']['error']);
		}

	}

//Chamando as funções
if (empty($_POST['chamar'])) {
		@$chamar = $_GET['chamar'];
	}else{
		@$chamar = $_POST['chamar'];
	}

	switch ($chamar) {
		case 'cadastro':
			Cadastrar($_POST['nome'], $_POST['email'], $_POST['senha']);
			break;

		case 'login':	
			Login($_POST['usuario'], $_POST['senha']);
			break;

		case 'logout':	
			Logout();
			break;

		case 'nvturma':
			Nv_mat_tur($_POST['tabela'], $_POST['campo'], $_POST['idprof'], $_POST['mat_tur']);
			break;

		case 'gtarefa':
			GerarTarefa($_POST['idprof'], $_POST['id_materia'], $_POST['id_turma'], $_POST['dtfin'], $_POST['titulo'], $_POST['contexto']);
			break;

		case 'entrega':
			EntregarTarefa($_POST['idtrab'], $_POST['turma'], $_POST['idprof'], $_POST['aluno'], $_POST['email'], $_POST['titulo'],  $_POST['txtrabalho']);
;	

		default:
		}


//=========================================== 
// 	function Inserir_Foto(){
// 		if(isset($_FILES['arquivo']['name']) && $_FILES['arquivo']['error'] == 0){
// 			$arquivo_tmp = $_FILES['arquivo']['tmp_name'];
// 			$nome = $_FILES['arquivo']['name'];

// 			$extensao = pathinfo( $nome, PATHINFO_EXTENSION );// Pegando a extensão
// 				//Criando um nome unico
// 				$novoNome =  date("d.m.Y-H.i.s") . uniqid() . '.' . $extensao;
// 				//endereço e nome
// 				$destino = 'upload/' . $novoNome;
// 				//Movendo
// 				if(move_uploaded_file($arquivo_tmp, $destino)){
// 					//Salvando endereço no banco
// 			        $sql = "UPDATE membros SET url_perfil = '$destino' WHERE nome = '{$_SESSION['sessao']['nome']}';";

// 			        global $conecta;
// 				 	if(!$conecta->query($sql)){
// 						print("Falha ao executar a query: (" . $conecta->errno . ") " . $conecta->error);
// 					}
// 				}else{
// 					echo "Impossivel Mover";
// 				}
// 		}else{
// 			echo "Não fooi possivel carregar a imagem!";
// 			print($_FILES['imagem']['error']);
// 	}
// }


?>
