<?php
  @ob_start();
  session_start();
?>
<html>
  <head>
    <?php
      include "app/_header.html";
      try{
        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        // error_reporting per togliere il notice quando non trova
        //error_reporting(0);
        // inclusione del file per la connessione al database
        include "app/dbConnection.php";
        include "app/functions.php";
        include "app/getData.php";
        if ($_SESSION['ID'] != null){
          $caserma = getCaserma($_SESSION['ID'], null, $db_conn);
          // se l'id non esiste allora fa il logout
          if ($caserma['ID'] == null){
            redirect('app/logout.php');
            return;
          }
        }else{
          redirect('app/logout.php');
          return;
        }
        if (!$_SESSION['_dashboardLayout']){
          $_SESSION = array();
          $_SESSION['_dashboardLayout'] = 'app/views/_home.php';
        }
        if (isset($_GET['redirect'])){
          $redirect = $_GET['redirect'];
          switch ($redirect) {
            case 'vigili':
              $_SESSION['_dashboardLayout'] = 'app/views/_vigili.php';
              break;
            case 'mezzi':
              $_SESSION['_dashboardLayout'] = 'app/views/_mezzi.php';
              break;
            case 'turni':
              $_SESSION['_dashboardLayout'] = 'app/views/_turni.php';
              break;
            case 'corsi':
              $_SESSION['_dashboardLayout'] = 'app/views/_corsi.php';
              break;
            case 'comunicazioni':
              $_SESSION['_dashboardLayout'] = 'app/views/_comunicazioni.php';
              break;
            case 'calendari':
              $_SESSION['_dashboardLayout'] = 'app/views/_calendari.php';
              break;
            default:
              $_SESSION['_dashboardLayout'] = 'app/views/_home.php';
              break;
          }
        }
      }catch(Exception $e){
      }
    ?>
  </head>
  <body style="margin:0">
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
      <header class="mdl-layout__header mdl-color--white">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title style-text-red" style="font-weight:100">my</span><span class="mdl-layout-title style-text-red" style="font-weight:500">Caserma</span><span class="mdl-layout-title style-text-red" style="font-weight:600">VVF</span>
          <div class="mdl-layout-spacer"></div>
          <nav class="mdl-navigation mdl-cell--hide-phone">
            <a class="mdl-navigation__link style-text-red" href="index.php#home">Home</a>
            <a class="mdl-navigation__link style-text-red" href="">Aiuto</a>
            <a class="mdl-navigation__link style-text-red" href="app/logout.php">Esci</a>
          </nav>
        </div>
      </header>
      <div class="mdl-layout__drawer style-bg-darkblue" style="border:none">
        <p class="mdl-layout-title mdl-color-text--white"><?php echo $caserma['Descrizione'] ?></p>
        <nav class="mdl-navigation">
          <a class="mdl-navigation__link mdl-color-text--white style-nav-dashboard" href="index.php#home">Home</a>
          <a class="mdl-navigation__link mdl-color-text--white style-nav-dashboard" href="">Aiuto</a>
          <a class="mdl-navigation__link mdl-color-text--white style-nav-dashboard" href="app/logout.php">Esci</a>
          <hr style="width:80%">
          <a class="mdl-navigation__link mdl-color-text--white style-nav-dashboard" href="?redirect=vigili">Vigili</a>
          <a class="mdl-navigation__link mdl-color-text--white style-nav-dashboard" href="?redirect=mezzi">Mezzi</a>
          <a class="mdl-navigation__link mdl-color-text--white style-nav-dashboard" href="?redirect=turni">Turni</a>
          <a class="mdl-navigation__link mdl-color-text--white style-nav-dashboard" href="?redirect=corsi">Corsi</a>
          <a class="mdl-navigation__link mdl-color-text--white style-nav-dashboard" href="?redirect=comunicazioni">Comunicazioni</a>
          <a class="mdl-navigation__link mdl-color-text--white style-nav-dashboard" href="?redirect=calendari">Calendari</a>
        </nav>
      </div>
      <main class="mdl-layout__content">
        <?php
          // variabile $error_message situata in dbConnection.php
          if ($error_message) {
            echo "
              <script>
                window.onload = function(){
                  flatAlert('Accesso', 'Impossibile connettersi al database', 'error', 'index.php');
                }
              </script>";
          }
          // integra il file salvato nella session
          include $_SESSION['_dashboardLayout'];
        ?>

      </main>
    </div>
  </body>
</html>
