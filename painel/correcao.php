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
    <link rel="stylesheet" type="text/css" href="../css/painel.css">
    <link rel="stylesheet" type="text/css" href="../css/correcao.css">  
    <script type="text/javascript" src="../js/jquery-3.4.1.js"></script>
    <script type="text/javascript">  
      function Remove_modal(){
        $("#mmodal").css('display', 'none')     
        }
      setTimeout(Remove_modal, 5000)

    </script>
  </head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- SEARCH FORM -->
      <form class="form-inline ml-3 formpesquisa" action="" method="GET" style="width: 80%">
        <div class="input-group input-group-sm pesquisa">
          <input class="form-control form-control-navbar" name="busca" type="search" placeholder="Buscar" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar btn-pesquisa" type="submit" style="background: aliceblue;">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>
    
      <?php
          include_once '../processar/processar_inter.php';

          if (!empty($_GET['busca'])) {
            $trabalho = @Buscar($_GET['busca']);
          }
      
        if (!empty($_GET['mtexto'])) {
      ?>

      <div id='mmodal'>
        <div class='alerta'>
          <p class='mtexto'><b><?=@$_GET['mtexto']?></b></p>
          <span class='fechar' onclick='Remove_modal()'>x</span>
        </div>
      </div>

  <?php } 


      function Correcao($idt)
      {
        global $conexao;
        $sql = "SELECT * FROM `entregas`
                WHERE entregas.id_entrega = $idt;";

        if(!$constroi = $conexao->query($sql)){
        }else{
          $trabalho = $constroi->fetch();

  ?>




      <nav class="navbar navbar-expand navbar-white navbar-light">
  
    <div class="card-header remetente">
      <h3 class="card-title remet">Aluno: <?=$trabalho['nm_estudante']?> </h3>
      <!-- <h3 class="card-title remet">Matéria:   </h3> -->
      <h3 class="card-title remet">Entregue em:  <?=$trabalho['data_entrega']?></h3>
     </div>
     <div class="card-header">
      <?php if(!empty($trabalho['anexo_extra'])){
        echo "<a class='fas fa-paperclip' href='$trabalho[anexo_extra]' download='$trabalho[anexo_extra]' target='_blank'>Download</a>";
      } ?> 
      </div> 
  </nav>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-9">
          <div class="card card-primary card-outline editor">
            <div class="card-header">
              <h3 class="card-title" style="text-align: center; float: none;"><?=$trabalho['titulo']?></h3>
            </div>
            <div class="card-header">
              <p class="card-title" style="text-align: center; float: none;">
                <textarea id="compose-textarea2" name="txtrabalho" class="form-control" style="height: 400px">
                  <?=$trabalho['conteudo']?>
                </textarea>                  
              </p>
            </div>



          </div>
        </div>
      </div>
    </div>
  </section>

<?php  } 
    }
      if(!empty($_GET['idt'])){
        @Correcao($_GET['idt']);
      }    
?>








  <footer class="main-footer" style="margin-left: 0px;">
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
