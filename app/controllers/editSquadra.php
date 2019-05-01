<?php
  @ob_start();
  session_start();
  include '../dbConnection.php';
  include '../functions.php';
  include '../models/getData.php';
  include '../models/addData.php';
  include '../models/updateData.php';
 ?>
<html>
  <head>
    <script src="../../js/script.js"></script>
    <script src="../../js/sweetalert.js"></script>
    <link type="text/css" rel="stylesheet" href="../../css/style.css" />
    <link rel="stylesheet" href="../../css/font-quicksand.css">
  </head>
  <body>
    <?php
      if (!$error_message) {
        if (isset($_POST['salva'])){
          $id=text_filter($_POST["salva"]);
          $nome = text_filter($_POST["nome"]);
          $editSquadra = updateSquadra($id, $nome, $_SESSION['ID'], $db_conn);
          if ($editSquadra){
            echo "
            <script>
              flatAlert('', 'Squadra modificata con successo', 'success', '../../dashboard.php?redirect=squadre');
            </script>";
            return;
          }else{
            echo "
            <script>
              flatAlert('Errore nella modifica del vigile', 'Controlla bene i dati immessi', 'error', '../../dashboard.php?redirect=squadre');
            </script>";
            return;
          }
        }
      }
    ?>
  </body>
</html>
