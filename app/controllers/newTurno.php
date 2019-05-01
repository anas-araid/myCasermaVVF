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
          $idSquadra = text_filter($_POST['salva']);
          $date = text_filter($_POST["date"]);
          $idMezzo = text_filter($_POST["mezzo"]);
          $addTurno = addTurno($date, $idSquadra, $idMezzo, $db_conn);
          if ($addTurno){
            echo "
            <script>
              flatAlert('', 'Turno aggiunto con successo', 'success', '../../dashboard.php?redirect=turni&id=".$idSquadra."');
            </script>";
            return;
          }else{
            echo "
            <script>
              flatAlert('Errore nell\'aggiunta del turno', 'Controlla bene i dati immessi', 'error', '../../dashboard.php?redirect=turni&id=".$idSquadra."');
            </script>";
            return;
          }
        }
      }
    ?>
  </body>
</html>
