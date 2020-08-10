<?php
  include_once '../processar/processar_inter.php';
      if (session_status() <> PHP_SESSION_ACTIVE) {
        session_start();
    }

  $sesao = $_SESSION['usuario'];
  $idprof = $_SESSION['idprof'];
  
  if($sesao == false){
    header('location:../index.php');
  }
  // $mtexto = "Ola $sesao! Seja bem vindo(a)<br>ao nosso sistema."
  if ( substr($_SERVER['QUERY_STRING'], 0, 3) == "DEL") {
    Delete();
  }

?>

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
    <script type="text/javascript" src="../js/jquery-3.4.1.js"></script>
    <script type="text/javascript">  
      function Remove_modal(){
        $("#mmodal").css('display', 'none')     
        }
      setTimeout(Remove_modal, 5000)

    </script>

  </head>
  <body class="hold-transition sidebar-mini" onload="">

  <?php if (!empty($_GET['mtexto'])) { ?>
    <div id='mmodal'>
        <div class='alerta'>
          <p class='mtexto'><b><?=@$_GET['mtexto']?></b></p>
          <span class='fechar' onclick='Remove_modal()'>x</span>
        </div>
      </div>
  <?php } ?> 


  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="margin-left: 270px;">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- SEARCH FORM -->
      <form class="form-inline ml-3 formpesquisa" action="" method="GET">
        <div class="input-group input-group-sm pesquisa">
          <input class="form-control form-control-navbar" name="busca" type="search" placeholder="Buscar" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar btn-pesquisa" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>

      <!-- Right navbar links
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu 
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
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>-->
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="compose.php" class="brand-link">
        
        <span class="brand-text font-weight-light">
          <img src="../imagens/logo_tbj.png" alt="Logo" class="brand-image img-circle elevation-3 logo">
        </span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <a href="../processar/processar.php?chamar=logout">
              <img src="../imagens/icon.png" class="img-circle elevation-2 imgperfil" alt="Imagem de perfil" title="clique para encerrar a sesão">
            <a/>
          </div>
          <div class="info">
            <a href="#" class="d-block" style="margin-top: 15px;"><?= $sesao ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-compact" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-inbox"></i>
                <p>
                  Entregues
                  <!-- <i class="fas fa-angle-left right"></i> -->
                </p>
                <span class="badge badge-danger float-right"><?=@$_SESSION['entregues']?></span>

              </a>               
                  <ul class="nav nav-treeview">
                    <?=Entregues($idprof)?>
                  </ul>         
            </li>

            <li class="nav-item has-treeview active">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-envelope"></i>
                <p>
                  Enviados
                  <!-- <i class="fas fa-angle-left right"></i> -->
                </p>
                <span class="badge bg-warning float-right"><?=@$_SESSION['enviados']?></span>
              </a>               
                  <ul class="nav nav-treeview">
                    <?=Enviados($idprof)?>
                  </ul>         
            </li> 


            <li class="nav-item has-treeview menu-open">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-plus-square"></i>
                <p>
                  Turmas
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">               
                    <form class="nav-link" action="../processar/processar.php" method="POST">
                      <input class="" type="text" name="mat_tur" placeholder="Nome da Turma">
                      <input type="hidden" name="idprof" value="<?=$idprof?>">
                      <input type="hidden" name="tabela" value="turmas">
                      <input type="hidden" name="campo" value="turma">
                      <input type="hidden" name="chamar" value="nvturma">
                      <input class="" type="submit" value="criar">
                  </form>
                </li>
                <?=Rt_mat_tur('turma', 'turmas', $idprof)?>
              </ul>
            </li>          
            <li class="nav-item has-treeview menu-open">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-plus-square"></i>
                <p>
                  Materias
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">               
                    <form class="nav-link" action="../processar/processar.php" method="POST">
                      <input class="" type="text" name="mat_tur" placeholder="Nome da Materia">
                      <input type="hidden" name="idprof" value="<?=$idprof?>">
                      <input type="hidden" name="tabela" value="materias">
                      <input type="hidden" name="campo" value="materia">
                      <input type="hidden" name="chamar" value="nvturma">
                      <input class="" type="submit" value="criar">
                  </form>
                </li>
                <?=Rt_mat_tur('materia', 'materias', $idprof)?>

              </ul>
            </li>    
<!--           <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Formulários
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">

                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Tabelas
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../calendar.html" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                  Calendario
                  <span class="badge badge-info right">2</span>
                </p>
              </a>
            </li>
-->
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <ul>
      <?php
        if (!empty($_GET['busca'])) {
          @Buscar($_GET['busca']);
        }
      ?>
      </ul>
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-9">
              <div class="card card-primary card-outline editor">
                <div class="card-header">
                  <h3 class="card-title">Criar nova tarefa</h3>
                </div>
            <form action="../processar/processar.php" method="POST" enctype="multipart/form-data"> 
              <input type="hidden" name="idprof" value="<?=$idprof?>">
              <input type="hidden" name="chamar" value="gtarefa">
              <input type="hidden" name="" value="">
              <div class="card-body">
                <div class="form-group divdados">
                  <select name="id_turma" class="form-control cpdados" placeholder="Para:">
                    <?=Reoption('turma', 'turmas', $idprof, 'id_turma')?>
                  </select>

                  <select name="id_materia" class="form-control cpdados" placeholder="Para:" required="">
                    <?=Reoption('materia', 'materias', $idprof,'id_materia')?>
                  </select>

                  <input name="dtfin" type="date" value="" class="form-control cpdados" title="Data limite de entrega" required="">
                  <select  class="form-control cpdados" placeholder="Para:">
                    <option value="">email</option>
                    <option value="">classe</option>
                    <option value="">link</option>
                  </select> 
                </div>
                <div class="form-group">
                  <input type="text" name="titulo" class="form-control" placeholder="Titulo" required="">
                </div>
                <div class="form-group">
                    <textarea name="contexto" id="compose-textarea" class="form-control" style="height: 300px">
                      <h1>...</h1>
                      <h6><u>use esta área para redigir ou codificar</u></h6>
                      <p>...</p>
                    </textarea>
                </div>
                <div class="form-group">
                  <div class="btn btn-default btn-file">
                    <i class="fas fa-paperclip"></i> Anexar
                    <input type="file" name="arquivo">
                  </div>
                  <p class="help-block">Max. 32MB</p>
                </div>
              </div>
               
                <!-- /.card-body -->
                <div class="card-footer">
                  <div class="float-right">
                    <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Enviar</button>
                  </div>
                  <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Descartar</button>
                </div>
            </form> 
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
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
       <strong>Copyright &copy; 2020 <a href="#">Trabalhosjá</a></strong><br> 


      <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.0.3-pre
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
