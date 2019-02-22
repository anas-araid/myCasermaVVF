<?php
  @ob_start();
  session_start();
  include 'dbConnection.php';
  include 'functions.php';
  include 'getData.php';
  include 'addData.php';
 ?>
<html>
  <head>
    <script src="../js/script.js"></script>
    <script src="../js/sweetalert.js"></script>
    <link type="text/css" rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/font-quicksand.css">
  </head>
  <body>
    <?php
      if (!$error_message) {
        if (isset($_POST['conferma'])){
          $caserma = text_filter($_POST["caserma"]);
          $email = text_filter($_POST["email"]);
          $telefono = text_filter($_POST["telefono"]);
          $password = text_filter_encrypt(text_filter($_POST["password"]));
          $addCaserma = addCaserma($caserma, $email, $telefono, $password, $db_conn);
          if ($addCaserma){
           echo "
           <script>
             flatAlert('', 'Corpo VVF aggiunto con successo', 'success', '../dashboard.php');
           </script>";
          }else{
           echo "
           <script>
             flatAlert('Errore', 'Errore nell\'aggiunta del Corpo VVF: contattare l\'amministratore', 'error', '../config.php');
           </script>";
          }
        }
      }
    ?>
  </body>
</html>
