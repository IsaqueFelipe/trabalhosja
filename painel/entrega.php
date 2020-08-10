<!DOCTYPE html>
<html lang="pt">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TrabalhosJá</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/painel.css">
    <link rel="stylesheet" type="text/css" href="../css/entrega.css">  
    <script type="text/javascript" src="../js/jquery-3.4.1.js"></script>
    <script type="text/javascript">  
      function Remove_modal(){
        $("#mmodal").css('display', 'none')     
        }
      setTimeout(Remove_modal, 5000)

    </script>
  </head>
<body class="hold-transition sidebar-mini">

  <?php if (!empty($_GET['mtexto'])) { ?>

    <div id='mmodal'>
        <div class='alerta'>
          <p class='mtexto'><b><?=@$_GET['mtexto']?></b></p>
          <span class='fechar' onclick='Remove_modal()'>x</span>
        </div>
      </div>

  <?php } 
    include_once '../processar/processar_inter.php';




      function FazerTrabalho($idtrabalho)
      {
        global $conexao;
        $sql = "SELECT usuarios.`id_professor`, `nm_usuario`, `materia`, turmas.`id_turma`, `turma`, `data_limite`, `tipo`, `titulo`, `contexto`, `anexo_img`, `anexo_extra`, `link` 
                FROM trabalhos
                INNER JOIN usuarios ON usuarios.id_professor = trabalhos.id_professor
                INNER JOIN turmas ON turmas.id_turma = trabalhos.id_turma 
                INNER JOIN materias ON materias.id_materia = trabalhos.id_materia
                WHERE trabalhos.id_trabalho = $idtrabalho;";

        if(!$constroi = $conexao->query($sql)){
          print_r($dados->errorInfo());
        }else{
          $trabalho = $constroi->fetch();
  ?>



<div class="wrapper">
    <nav class="navbar navbar-expand navbar-white navbar-light">
    <div class="card-header remetente">
      <h3 class="card-title remet">Professor(a): <?=$trabalho['nm_usuario']?></h3>
      <h3 class="card-title remet">Matéria: <?=$trabalho['materia']?></h3>
      <h3 class="card-title remet">Entrega até: <?=$trabalho['data_limite']?></h3>
     </div> 
    <!-- Right navbar links 
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu 
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
    </ul>-->
  </nav>
  <!-- /.navbar -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-9">
            <div class="card card-primary card-outline editor">
              <div class="card-header">
                <h3 class="card-title" style="text-align: center; float: none;"><?=$trabalho['titulo']?></h3>
              </div>
              <center>
                <?php if(!empty(@$trabalho['anexo_extra'])){
                  echo "<a class='fas fa-paperclip' href='$trabalho[anexo_extra]' download='$trabalho[anexo_extra]' target='_blank'>Download</a>";
                } ?> 
              </center>
              <div class="card-header">
                <p class="card-title" style="text-align: center; float: none;"><?=$trabalho['contexto']?></p>
              </div> 


              <div class="">
                <div class="" align="center">
                    <a href="#trabalho" class="trabalho" data-toggle="collapse" data-target="#trabalho" aria-expanded="" aria-controls="trabalho" title="clique para começar o trabalho">
                        Vamos Começar
                    </a>
                </div>

                <div id="trabalho" class="collapse">
                    <!-- /.card-header -->
                  <form enctype="multipart/form-data" action="../processar/processar.php" method="POST">  
                    <div class="card-body">
                      <div class="form-group divdados">
                        <input type="text" name="aluno" class="form-control cpdados" placeholder="Nome Completo" required="">                  
                        <select name="turma" class="form-control cpdados">
                          <?=Reoption('turma', 'turmas', $trabalho['id_professor'], 'id_turma')?>
                        </select>
                
                        <input type="email" name="email" class="form-control cpdados" placeholder="insira seu email" required=""> 

                      </div>
                      <div class="form-group">
                          <textarea id="compose-textarea" name="txtrabalho" class="form-control" style="height: 300px">
                            <center class="placeedit">
                              <h1>...</h1>
                              <h6>use esta área para redigir ou codificar</h6>
                              <p>...</p>
                            </center>  
                          </textarea>
                      </div>
                      <input type="hidden" name="idtrab" value="<?=$idtrabalho?>">
                      <input type="hidden" name="titulo" value="<?=$trabalho['titulo']?>">
                      <input type="hidden" name="idprof" value="<?=$trabalho['id_professor']?>">
                      <input type="hidden" name="chamar" value="entrega">

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <div class="float-right">
                        <div class="btn btn-default btn-file">
                          <i class="fas fa-paperclip"></i> Anexar
                          <input type="file" name="arquivo">
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Entregar</button>
                      </div>
                      <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Descartar</button>
                    </div>
                  </form>  


                </div>
              </div><!--Fim Toogle-->



<?php  } 
    }
      FazerTrabalho($_GET['e']);    
?>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  <footer class="main-footer">
     <strong>Copyright &copy; 2020 <a href="#">Trabalhosjá</a></strong><br> 


    <div class="float-right d-none d-sm-block">
      <b>Versão</b> 3.0.3-pre
    </div>
    <strong>Desing baseado na criação pública Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> Todos os direitos reservados. 
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- Page Script -->
<script>
  $(function () {
    //Add text editor
    $('#compose-textarea').summernote()
  })
</script>
</body>
</html>
