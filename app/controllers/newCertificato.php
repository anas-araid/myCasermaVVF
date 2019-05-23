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
          $firemanID = $_POST['salva'];
          $corso = text_filter($_POST["corso"]);
          $documento = $_FILES["documento"];
          $filename=null;
          $addCorso = addCorso($corso, $filename, $firemanID, $db_conn);
          if ($addCorso){

          }else{
            echo "
            <script>
              flatAlert('Errore nell\'aggiunta del certificato', 'Controlla bene i dati immessi', 'error', '../../dashboard.php?redirect=certificazioni&id=$firemanID');
            </script>";
            return;
          }
          if ($documento["size"] > 0){
            // dimensione massima 20mb
            if ($documento["size"] > 20000000){
              echo "
                  <script>
                    flatAlert('Certificato', 'Documento troppo grande; la dimensione massima consentita e\' di 20mb', 'error', '../../dashboard.php');
                  </script>";
              return;
            }

            $userCorsi = getCorsi(null, $firemanID, $db_conn);
            if (!empty($userCorsi)){
              //$lastID = mysqli_insert_id($db_conn);
              $lastID = $userCorsi[count($userCorsi) -1][0];
              //$lastID++;
            }else{
              $lastID = 1;
            }
            $idCorpo = $_SESSION['ID'];
            $filename = $idCorpo.'_'.$firemanID.'_'.$lastID.'.pdf';
            $dir = "../../uploads/".$filename ;
            if (!move_uploaded_file($documento["tmp_name"], $dir)){
              echo "
                  <script>
                    flatAlert('Certificato', 'Impossibile caricare il documento', 'error', '../../dashboard.php?redirect=certificazioni&id=$firemanID');
                  </script>";
              return;
            }
            updateCertificazione($lastID, $filename, $db_conn);
          }else{
            $filename = null;
          }
          echo "
          <script>
            flatAlert('', 'Certificato aggiunto con successo', 'success', '../../dashboard.php?redirect=certificazioni&id=$firemanID');
          </script>";
        }
      }
    ?>
  </body>
</html>
