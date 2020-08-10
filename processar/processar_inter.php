<?php

	//=TrabalhosJa=//
	try {
		$conexao = new PDO("mysql:host=localhost;port=3306;dbname=bdtrabalhosja;charset=utf8", "root", "");
		$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 } catch(PDOException $e){
	   	echo $e->getMessage();
	        die();
	    }

	function Rt_mat_tur($campo, $tabela, $idprof)
	{	
		global $conexao;


		$id = 'id_' . $campo;

		$sql = "SELECT $id, $campo FROM $tabela WHERE id_professor = $idprof";

		if(!$dados = $conexao->query($sql)){
			print_r($dados->errorInfo());
		}else{
			//$valida = $dados->fetch(PDO::FETCH_ASSOC);
			while ($valida = $dados->fetch()) {		
?>				
                <li class="nav-item">
                	<a href="?DEL<?=$valida['id_' . $campo], $tabela?>" class="nav-link" title="excluir">                   
                    <p style="margin: 0px 6px 0px 6px;"><?=$valida[$campo]?></p>    
                	<i class="far fa-trash-alt"></i>
                  	</a>
                </li>
<?php

			}

		}		
	}

	function Reoption($campo, $tabela, $idprof, $idordem)

	{	
		global $conexao;
		$sql = "SELECT * FROM $tabela WHERE id_professor = $idprof  ORDER BY  $idordem DESC";

		if(!$dados = $conexao->query($sql)){
			print_r($dados->errorInfo());
		}else{
			//$valida = $dados->fetch(PDO::FETCH_ASSOC);
			while ($valida = $dados->fetch()) {
?>				
				<option value="<?=$valida['id_' . $campo]?>">     
                    <p><?=$valida[$campo]?></p>          
            	</option>   
<?php

			}				
		}		
	}

	function Delete()
	{
		global $conexao;

		$campo = substr($_SERVER['QUERY_STRING'], 3, 3);

		$tabela = substr($_SERVER['QUERY_STRING'], 6);

		$id = "id_" . substr($tabela, 0, -1);
		$sql = "DELETE FROM  $tabela WHERE $id = $campo";

		$conexao->query($sql);
	}



	// trabalhos entregues
	function Enviados($idprof)
	{	
		global $conexao;
		$sql = "SELECT titulo, link FROM `trabalhos` WHERE trabalhos.id_professor = $idprof;";

		if(!$result = $conexao->query($sql)){
			print_r($dados->errorInfo());
		}else{
			while ($dados = $result->fetch()) {		
?>				

                    <li class="nav-item active">
                      <a href="<?=$dados['link']?>" class="nav-link" target="_Blank">
                     	<p><?=$dados['titulo']?></p><br>
                        <i><?=$dados['link']?></i>
                      </a>
                    </li>
<?php
			}
		$count = $conexao->query("SELECT count(*) FROM `trabalhos` WHERE trabalhos.id_professor = $idprof")->fetchColumn();
		$_SESSION['enviados'] = $count;
		}
	}

	function Entregues($idprof)
	{	
		global $conexao;
		$sql = "SELECT id_entrega, nm_estudante, titulo  FROM `entregas` 
				INNER JOIN usuarios
				WHERE usuarios.id_professor = $idprof;";

		if(!$result = $conexao->query($sql)){
			print_r($dados->errorInfo());
		}else{
			while ($dados = $result->fetch()) {		
?>				
                <li class="nav-item active">
                  <a href="correcao.php?idt=<?=$dados['id_entrega']?>" class="nav-link" target="_Blank">
                 	<p><?=$dados['nm_estudante']?></p><br>
                    <i><?=$dados['titulo']?></i>
                  </a>
                </li>
<?php
			}
		$count = $conexao->query("SELECT count(*) FROM `entregas` WHERE entregas.id_professor = $idprof")->fetchColumn();
		$_SESSION['entregues'] = $count;	
		}
	}


	function Buscar($busca){
		global $conexao;
		$sql = "SELECT * FROM `entregas` WHERE nm_estudante LIKE '%$busca%'";

		$result = $conexao->query($sql);

		while ($dados = $result->fetch()) {		
?>				
            <li class="nav-item active">
              <a href="correcao.php?idt=<?=$dados['id_entrega']?>" class="nav-link" target="_Blank">
             	<p><?=$dados['nm_estudante']?> :
               	<?=$dados['titulo']?></p>

              </a>
            </li>
<?php
		}
		
	}

?>
