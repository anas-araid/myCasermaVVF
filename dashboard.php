<?php
  @ob_start();
  session_start();
?>
<html>
  <head>
    <?php
      include "app/views/_header.html";
      try{
        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        // error_reporting per togliere il notice quando non trova
        //error_reporting(0);
        // inclusione del file per la connessione al database
        include "app/dbConnection.php";
        include "app/functions.php";
        include "app/models/getData.php";
        if (!$error_message) {
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
            $_SESSION['_dashboardLayout'] = 'app/views/_home.php';
          }
          if (isset($_GET['redirect'])){
            $redirect = text_filter($_GET['redirect']);
            switch ($redirect) {
              case 'vigili':
                $_SESSION['_dashboardLayout'] = 'app/views/_vigili.php';
                break;
              case 'mezzi':
                $_SESSION['_dashboardLayout'] = 'app/views/_mezzi.php';
                break;
              case 'squadre':
                $_SESSION['_dashboardLayout'] = 'app/views/_squadre.php';
                break;
              case 'mostraSquadra':
                $_SESSION['_dashboardLayout'] = 'app/views/_mostraSquadra.php';
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
              case 'attrezzature':
                $_SESSION['_dashboardLayout'] = 'app/views/_attrezzature.php';
                break;
              case 'certificazioni':
                  $_SESSION['_dashboardLayout'] = 'app/views/_certificazioni.php';
                  break;
              case 'impostazioni':
                $_SESSION['_dashboardLayout'] = 'app/views/_impostazioni.php';
                break;
              default:
                $_SESSION['_dashboardLayout'] = 'app/views/_home.php';
                break;
            }
          }
        }
      }catch(Exception $e){
      }
    ?>
  </head>
  <body style="margin:0">
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header tingle-content-wrapper">
      <header class="mdl-layout__header mdl-color--white">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title style-text-red" style="font-weight:100">my</span><span class="mdl-layout-title style-text-red" style="font-weight:500">Caserma</span><span class="mdl-layout-title style-text-red" style="font-weight:600">VVF</span>
          <div class="mdl-layout-spacer"></div>
          <button id="nav-menu"
                  class="mdl-button mdl-js-button mdl-button--icon">
            <i class="material-icons style-text-red">settings</i>
          </button>
          <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
              for="nav-menu"
              style="border-radius:20px">
            <li class="mdl-menu__item" onclick="location.href='index.php#home'">Home</li>
            <li class="mdl-menu__item" onclick="location.href='?redirect=impostazioni'">Impostazioni</li>
            <li class="mdl-menu__item" onclick="help()">Aiuto</li>
            <li class="mdl-menu__item" onclick="location.href='app/logout.php'">Esci</li>
          </ul>
        </div>
      </header>
      <div class="mdl-layout__drawer style-bg-darkblue" style="border:none">
        <p class="mdl-layout-title mdl-color-text--white"><?php echo $caserma['Descrizione'] ?></p>
        <nav class="mdl-navigation">
          <a class="mdl-navigation__link mdl-color-text--white style-nav-dashboard" href="index.php#home">Home</a>
          <a class="mdl-navigation__link mdl-color-text--white style-nav-dashboard" href="?redirect=impostazioni">Impostazioni</a>
          <a class="mdl-navigation__link mdl-color-text--white style-nav-dashboard" href="#" onclick="help()">Aiuto</a>
          <a class="mdl-navigation__link mdl-color-text--white style-nav-dashboard" href="app/logout.php">Esci</a>
          <hr style="width:80%">
          <a class="mdl-navigation__link mdl-color-text--white style-nav-dashboard" href="?redirect=vigili">Vigili</a>
          <a class="mdl-navigation__link mdl-color-text--white style-nav-dashboard" href="?redirect=mezzi">Mezzi</a>
          <a class="mdl-navigation__link mdl-color-text--white style-nav-dashboard" href="?redirect=squadre">Squadre</a>
          <a class="mdl-navigation__link mdl-color-text--white style-nav-dashboard" href="?redirect=attrezzature">Attrezzature</a>
          <a class="mdl-navigation__link mdl-color-text--white style-nav-dashboard" href="?redirect=comunicazioni">Comunicazioni</a>
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
        <script>
          function help(){
            swal({
              title: "Aiuto",
              icon: "info",
              buttons: {
                cancel: "Indietro",
                privacy: {
                  text: "Privacy",
                  value: "privacy",
                },
                defeat: {
                  text: "Termini",
                  value: "terms",
                }
              }
            }).then((value) => {
              switch (value) {
                case "privacy":
                  privacy()
                  break;
                case "terms":
                  terms();
                  break;
                default:
              };
          });
        }
        </script>
      </main>
    </div>
  </body>
</html>
