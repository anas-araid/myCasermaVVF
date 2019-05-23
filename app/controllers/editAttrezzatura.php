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
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
          $attrezzatura = text_filter($_POST["attrezzatura"]);
          $quantita = text_filter($_POST["quantita"]);
          $editAttrezzatura = updateAttrezzatura($id, $attrezzatura, $quantita, $_SESSION['ID'], $db_conn);
          if ($editAttrezzatura){
            echo "
            <script>
              flatAlert('', 'Modifica effettuata con successo', 'success', '../../dashboard.php?redirect=attrezzature');
            </script>";
            return;
          }else{
            echo "
            <script>
              flatAlert('Errore nella modifica', 'Controlla bene i dati immessi', 'error', '../../dashboard.php?redirect=attrezzature');
            </script>";
            return;
          }
        }
      }
    ?>
  </body>
</html>
