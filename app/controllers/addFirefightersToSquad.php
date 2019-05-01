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
          $arrayVigili = array();
          // id, nome, cognome, matricola, cellulare, chatID, Grado, corpo, reperibile, autista
          $allFireman = getFiremanData(null,null, null, $_SESSION['ID'], null, null, $db_conn);
          $nVigili = count($allFireman);
          $j=0;
           // inserisco nell'array $arrayVigili gli id dei vigili selezionati nelle checkbox della form
          for ($i=0;$i<$nVigili;$i++){
            if (isset($_POST['vigile_'.$allFireman[$i][0]])){
              $arrayVigili[$j] =  text_filter($_POST['vigile_'.$allFireman[$i][0]]);
              $j++;
            }
          }
          //print_r($arrayVigili);
          $idSquadra = text_filter($_POST['salva']);
          $addToSquadra = false;  
          for ($j=0;$j<count($arrayVigili);$j++){
            $addToSquadra = addVigiliToSquadra($arrayVigili[$j], $idSquadra, $db_conn);
          }
          if ($addToSquadra){
            echo "
            <script>
              flatAlert('', 'Aggiunta effettuata con successo', 'success', '../../dashboard.php?redirect=mostraSquadra&id=$idSquadra');
            </script>";
            return;
          }else{
            echo "
            <script>
              flatAlert('Errore nell\'aggiunta nella squadra', 'Controlla bene i dati immessi', 'error', '../../dashboard.php?redirect=mostraSquadra&id=$idSquadra');
            </script>";
            return;
          }
        }
      }
    ?>
  </body>
</html>
