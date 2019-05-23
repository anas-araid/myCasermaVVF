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
        if (isset($_POST['aggiorna'])){
          $id=text_filter($_POST["aggiorna"]);
          $caserma = text_filter($_POST["caserma"]);
          $email = text_filter($_POST["email"]);
          $telefono = text_filter($_POST["telefono"]);
          $editCorpo = updateCorpo($id, $caserma, $email, $telefono, $db_conn);
          if ($editCorpo){
            echo "
            <script>
              flatAlert('', 'Caserma modificata con successo', 'success', '../../dashboard.php?redirect=impostazioni');
            </script>";
            return;
          }else{
            echo "
            <script>
              flatAlert('Errore nella modifica della caserma', 'Controlla bene i dati immessi', 'error', '../../dashboard.php?redirect=impostazioni');
            </script>";
            return;
          }
        }
      }
    ?>
  </body>
</html>
