<?php
  @ob_start();
  session_start();
  include '../dbConnection.php';
  include '../functions.php';
  include '../getData.php';
  include '../addData.php';
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
          $firemanID = $_POST['salva'];
          $corso = text_filter($_POST["corso"]);
          $documento = $_FILES["documento"];
          $filename='';
          if (isset($documento)){
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
              $lastID = $userCorsi[count($userCorsi) -1][0];
              $lastID++;
            }else{
              $lastID = 1;
            }
            $filename = $firemanID.'_'.$lastID.'.pdf';
            $dir = "../../uploads/".$filename ;
            if (!move_uploaded_file($documento["tmp_name"], $dir)){
              echo "
                  <script>
                    flatAlert('Certificato', 'Impossibile caricare il documento', 'error', '../../dashboard.php');
                  </script>";
              return;
            }
          }else{
            $filename = null;
          }
          $addCorso = addCorso($corso, $filename, $firemanID, $db_conn);
          if ($addCorso){
           echo "
           <script>
             flatAlert('', 'Certificato aggiunto con successo', 'success', '../../dashboard.php');
           </script>";
           return;
          }else{
            echo "
            <script>
              flatAlert('Errore nell\'aggiunta del certificato', 'Controlla bene i dati immessi', 'error', '../../dashboard.php');
            </script>";
            return;
          }
        }
      }
    ?>
  </body>
</html>
