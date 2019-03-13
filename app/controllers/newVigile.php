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
          $cognome = text_filter($_POST["cognome"]);
          $cellulare = text_filter($_POST["cellulare"]);
          $matricola = text_filter($_POST["matricola"]);
          $idGrado = text_filter($_POST["grado"]);
          $autista = text_filter($_POST["autista"]);
          $addVigile = addFireman($nome, $cognome, $cellulare, $matricola, $idGrado, $_SESSION['ID'], $autista, null, $db_conn);
          if ($addVigile){
            echo "
            <script>
              flatAlert('', 'Vigile aggiunto con successo', 'success', '../../dashboard.php?redirect=vigili');
            </script>";
            return;
          }else{
            echo "
            <script>
              flatAlert('Errore nell\'aggiunta del vigile', 'Controlla bene i dati immessi', 'error', '../../dashboard.php?redirect=vigili');
            </script>";
            return;
          }
        }
      }
    ?>
  </body>
</html>
