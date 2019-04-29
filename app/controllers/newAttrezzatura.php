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
          $attrezzatura = text_filter($_POST["attrezzatura"]);
          $quantita = text_filter($_POST["quantita"]);
          $addAttrezzatura = addAttrezzatura($attrezzatura, $quantita, $_SESSION['ID'], $db_conn);
          if ($addAttrezzatura){
            echo "
            <script>
              flatAlert('', 'Attrezzatura aggiunta con successo', 'success', '../../dashboard.php?redirect=attrezzature');
            </script>";
            return;
          }else{
            echo "
            <script>
              flatAlert('Errore nell\'aggiunta dell\'attrezzatura', 'Controlla bene i dati immessi', 'error', '../../dashboard.php?redirect=attrezzature');
            </script>";
            return;
          }
        }
      }
    ?>
  </body>
</html>
