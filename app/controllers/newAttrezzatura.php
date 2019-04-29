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
          $mezzo = text_filter($_POST["attrezzatura"]);
          $addMezzo = addAttrezzatura($mezzo, $_SESSION['ID'], $db_conn);
          if ($addMezzo){
            echo "
            <script>
              flatAlert('', 'Mezzo aggiunto con successo', 'success', '../../dashboard.php?redirect=mezzi');
            </script>";
            return;
          }else{
            echo "
            <script>
              flatAlert('Errore nell\'aggiunta del mezzo', 'Controlla bene i dati immessi', 'error', '../../dashboard.php?redirect=mezzo');
            </script>";
            return;
          }
        }
      }
    ?>
  </body>
</html>
