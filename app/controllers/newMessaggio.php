<?php
  @ob_start();
  session_start();
  include '../dbConnection.php';
  include '../functions.php';
  include '../models/getData.php';
  include '../models/addData.php';
  include '../models/updateData.php';
  include '../../bot/controller.php';
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
        if (isset($_POST['invia'])){
          $messaggio = "<b>Messaggio inviato dal gestionale</b> <i>myCaserma</i>: \n\n".text_filter($_POST["messaggio"]);
          $idCaserma = text_filter($_POST['invia']);
          $addMessaggio = sendMessaggio($messaggio, $idCaserma, $db_conn);
          if ($addMessaggio){
            echo "
            <script>
              flatAlert('', 'Messaggio inviato con successo', 'success', '../../dashboard.php?redirect=comunicazioni');
            </script>";
            return;
          }else{
            echo "
            <script>
              flatAlert('Messaggio non inviato', 'Controlla i dati immessi oppure se sono stati inseriti i numeri di cellulare nella sezione \'vigili\'', 'error', '../../dashboard.php?redirect=comunicazioni');
            </script>";
            return;
          }
        }
      }
      function sendMessaggio($messaggio, $idCaserma, $db_conn){
        // $vigili["$i"] = array($ris['ID'], $ris['Nome'], $ris['Cognome'], $ris['Matricola'], $ris['Cellulare'], $ris['Chat_ID'], $ris['FK_Grado'], $ris['FK_CorpoVVF'], $ris['Reperibile'], $ris['Autista']);
        $vigili = getFiremanData(null, null, null, $idCaserma, null, null, $db_conn);
        $api = getApiToken("../../api.key");
        if (!isset($vigili) and isset($api)){
          return false;
        }
        for ($i=0; $i<count($vigili);$i++){
          if ($vigili[$i][5] != null){
            $msg = sendMsg($api, $vigili[$i][5], $messaggio);
            if ($msg == false){
              return false;
            }
          }
        }
        return true;
      }
    ?>
  </body>
</html>
