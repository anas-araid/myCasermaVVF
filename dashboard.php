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
            header('location:app/logout.php');
          }
        }else{
          header('location:app/logout.php');
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
          <a class="mdl-navigation__link mdl-color-text--white style-nav-dashboard" href="">Aiuto</a>
          <a class="mdl-navigation__link mdl-color-text--white style-nav-dashboard" href="app/logout.php">Esci</a>
          <hr style="width:80%">
          <a class="mdl-navigation__link mdl-color-text--white style-nav-dashboard" href="">Vigili</a>
          <a class="mdl-navigation__link mdl-color-text--white style-nav-dashboard" href="">Mezzi</a>
          <a class="mdl-navigation__link mdl-color-text--white style-nav-dashboard" href="">Turni</a>
          <a class="mdl-navigation__link mdl-color-text--white style-nav-dashboard" href="">Corsi</a>
          <a class="mdl-navigation__link mdl-color-text--white style-nav-dashboard" href="">Comunicazioni</a>
          <a class="mdl-navigation__link mdl-color-text--white style-nav-dashboard" href="">Calendari</a>
        </nav>
      </div>
      <main class="mdl-layout__content">




      </main>
    </div>
  </body>
</html>
