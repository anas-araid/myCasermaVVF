<?php
  @ob_start();
  session_start();
?>
<html>
  <head>
     <?php
      include 'app/_header.html';
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
        }
      }catch(Exception $e){
      }
     ?>
  </head>
  <body style="margin:0">
    <div class="mdl-layout mdl-js-layout">
      <header class="mdl-layout__header mdl-layout--fixed-header mdl-layout__header--transparent">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title style-text-red" style="font-weight:100">my</span><span class="mdl-layout-title style-text-red" style="font-weight:500">Caserma</span><span class="mdl-layout-title style-text-red" style="font-weight:600">VVF</span>
          <div class="mdl-layout-spacer"></div>
          <nav class="mdl-navigation">
            <a class="mdl-navigation__link style-text-red" href="#home">Home</a>
            <?php
              if (isset($_SESSION['ID'])){
                echo '<a class="mdl-navigation__link style-text-red" href="login.php">Entra</a>';
              }else{
                echo '<a class="mdl-navigation__link style-text-red" href="login.php">Accedi</a>';
              }
             ?>
            <a class="mdl-navigation__link style-text-red" href="config.php">Configura</a>
            <a class="mdl-navigation__link style-text-red" href="#scopri">Scopri di più</a>
          </nav>
        </div>
      </header>
      <div class="mdl-layout__drawer">
        <p class="mdl-layout-title style-text-darkred">myCasermaVVF</p>
        <nav class="mdl-navigation">
          <a class="mdl-navigation__link style-text-red" href="#home">Home</a>
          <?php
            if (isset($_SESSION['ID'])){
              echo '<a class="mdl-navigation__link style-text-red" href="login.php">Entra</a>';
            }else{
              echo '<a class="mdl-navigation__link style-text-red" href="login.php">Accedi</a>';
            }
           ?>
          <a class="mdl-navigation__link style-text-red" href="config.php">Configura</a>
          <a class="mdl-navigation__link style-text-red" href="#scopri">Scopri di più</a>
        </nav>
      </div>
      <main class="mdl-layout__content">
        <div id="particles-js" width="100%" height="100%" style="width:100%;height:100%">
        </div>
        <section id="home">
          <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--7-col" style="text-align:center">
              <br><br><br><br>
              <h2 class="style-text-red">La tua <b>caserma</b> a portata di mano...</h2>
              <br><br>
              <button class="style-button-red" onclick="location.href='login.php'">INIZIA SUBITO!</button>
              <button class="style-button-white" onclick="location.href='#scopri'">SCOPRI DI PIÙ</button>
            </div>
            <div class="mdl-cell mdl-cell--5-col mdl-cell--hide-phone" style="background:url('img/abstract.svg');background-repeat:no-repeat;background-size:contain;">
              <img src="img/screen.png" class="style-bounce" style="width:90%"></img>
            </div>
          </div>
          <div class="style-arrow animated bounce">
            <i class="material-icons style-arrow-icon">keyboard_arrow_down</i>
          </div>
        </section>
        <br><br>
        <section id="section-2">
          <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--5-col mdl-cell--hide-phone">
              <img src="img/server.png" class="style-bounce" style="width:90%"></img>
            </div>
            <div class="mdl-cell mdl-cell--7-col" style="text-align:center" >
              <h3 class="style-text-red">Consulta e gestisci le attività in caserma in modo facile e <i>veloce.</i></h3>
              <h5 class="style-text-darkGrey" style="text-align:left;padding:30px">
                Una volta configurato il sistema da un tuo responsabile, non ti serve installare nulla,
                basta avere solo un account <b>telegram</b> ed utilizzare subito il bot!
              </h5>
              <h5>Non hai Telegram? Scaricalo da <a href="https://telegram.org" target="_blank">qua</a></h5>
              <p>oppure</p>
              <button class="style-button-red" onclick="window.open('https://t.me/myCasermaVVF_bot', '_blank')">APRI IL BOT</button>
            </div>
          </div>
        </section>
        <br><br>
        <section id="scopri" style="text-align:center;background-color:#ecf5fe;">
          <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--2-col"></div>
            <div class="mdl-cell mdl-cell--8-col" style="text-align:left">
              <h4 class="style-text-darkred">Telegram ti avvisa:</h4>
              <ul class="mdl-list">
                <li class="mdl-list__item">
                  <span class="mdl-list__item-primary-content">
                    <i class="material-icons mdl-list__item-icon">calendar_today</i>
                    Dei turni festivi
                  </span>
                </li>
                <li class="mdl-list__item">
                  <span class="mdl-list__item-primary-content">
                    <i class="material-icons mdl-list__item-icon">chat</i>
                    Delle comunicazioni di servizio
                  </span>
                </li>
                <li class="mdl-list__item">
                  <span class="mdl-list__item-primary-content">
                    <i class="material-icons mdl-list__item-icon">access_time</i>
                    Delle scadenze dei corsi
                  </span>
                </li>
              </ul>
              <h4 class="style-text-darkred">Inoltre di aiuta a gestire:</h4>
              <ul class="mdl-list">
                <li class="mdl-list__item">
                  <span class="mdl-list__item-primary-content">
                    <i class="material-icons mdl-list__item-icon">directions_car</i>
                    La checklist dei mezzi
                  </span>
                </li>
                <li class="mdl-list__item">
                  <span class="mdl-list__item-primary-content">
                    <i class="material-icons mdl-list__item-icon">date_range</i>
                    La distribuzione dei calendari
                  </span>
                </li>
                <li class="mdl-list__item">
                  <span class="mdl-list__item-primary-content">
                    <i class="material-icons mdl-list__item-icon">videocam</i>
                    E visualizzare le webcam del territorio
                  </span>
                </li>
              </ul>
            </div>
            <div class="mdl-cell mdl-cell--2-col"></div>
          </div>
        </section>
        <section id="section-4">
          <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--5-col mdl-cell--hide-phone">
              <img src="img/config.png" style="width:90%"></img>
            </div>
            <div class="mdl-cell mdl-cell--7-col" style="text-align:center" >
              <h3 class="style-text-red">Il tuo corpo di appartenenza non è abilitato alla piattaforma? </h3>
              <h5 class="style-text-darkGrey" style="text-align:left;padding:30px">
                Se sei il responsabile, configura subito il sistema!
              </h5>
              <button class="style-button-red" onclick="location.href='config.php'">CONFIGURAZIONE</button>
            </div>
          </div>
        </section>
        <div id="footer" style="margin:0;bottom:0;background-color:#c0392b;height:max-content;padding:20px">
          <h6 style="color:white">Anas Araid &copy 2019 myCasermaVVF. <i>Creato dai soccorritori per i soccorritori.</i></h6>
        </div>
      </main>
    </div>
  </body>
</html>
