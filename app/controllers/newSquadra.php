<?php
  @ob_start();
  session_start();
  include '../dbConnection.php';
  include '../functions.php';
  include '../getData.php';
  include '../addData.php';
  include '../updateData.php';
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
          $nome = text_filter($_POST["nome"]);
          $addSquadra = addSquadra($nome, $_SESSION['ID'], $db_conn);
          if ($addSquadra){
            echo "
            <script>
              flatAlert('', 'Squadra aggiunta con successo', 'success', '../../dashboard.php?redirect=squadre');
            </script>";
            return;
          }else{
            echo "
            <script>
              flatAlert('Errore nell\'aggiunta della squadre', 'Controlla bene i dati immessi', 'error', '../../dashboard.php?redirect=squadre');
            </script>";
            return;
          }
        }
      }
    ?>
  </body>
</html>
