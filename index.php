<?php
  @ob_start();
  session_start();
?>
<html>
  <head>
     <?php
      include 'app/views/_header.html';
      try{
        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        // error_reporting per togliere il notice quando non trova
        //error_reporting(0);
        // inclusione del file per la connessione al database
        include "app/dbConnection.php";
        include "app/functions.php";
        include "app/getData.php";
        $logged = false;
        if ($_SESSION['ID'] != null){
          $caserma = getCaserma($_SESSION['ID'], null, $db_conn);
          // se l'id non esiste allora fa il logout
          if ($caserma['ID'] == null){
            header('location:app/logout.php');
          }else {
            $logged = true;
          }
        }
      }catch(Exception $e){
      }
     ?>
  </head>
  <body style="margin:0">
    <div class="mdl-layout mdl-js-layout tingle-content-wrapper">
      <header class="mdl-layout__header mdl-layout--fixed-header mdl-layout__header--transparent">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title style-text-red" style="font-weight:100">my</span><span class="mdl-layout-title style-text-red" style="font-weight:500">Caserma</span><span class="mdl-layout-title style-text-red" style="font-weight:600">VVF</span>
          <div class="mdl-layout-spacer"></div>
          <nav class="mdl-navigation">
            <a class="mdl-navigation__link style-text-red" href="#home">Home</a>
            <?php
              if ($logged){
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
            if ($logged){
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
              <?php
                if($logged){
                  echo '<button class="style-button-red" onclick="location.href='."'login.php'".'">ENTRA</button>';
                }else {
                  echo '<button class="style-button-red" onclick="location.href='."'login.php'".'">INIZIA SUBITO!</button>';
                }
               ?>
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
              <img src="img/desktop.png" class="style-bounce" style="width:90%"></img>
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
              <h4 class="style-text-darkred">myCasermaVVF ti aiuta a gestire:</h4>
              <ul class="mdl-list">
                <li class="mdl-list__item">
                  <span class="mdl-list__item-primary-content">
                    <i class="material-icons mdl-list__item-icon">group</i>
                    Tutto il personale
                  </span>
                </li>
                <li class="mdl-list__item">
                  <span class="mdl-list__item-primary-content">
                    <i class="material-icons mdl-list__item-icon">build</i>
                    Le attrezzature
                  </span>
                </li>
                <li class="mdl-list__item">
                  <span class="mdl-list__item-primary-content">
                    <i class="material-icons mdl-list__item-icon">calendar_today</i>
                    Le squadre e i turni 
                  </span>
                </li>
                <li class="mdl-list__item">
                  <span class="mdl-list__item-primary-content">
                    <i class="material-icons mdl-list__item-icon">chat</i>
                    Le comunicazioni di servizio 
                  </span>
                </li>
              </ul>
              <h4 class="style-text-darkred">Inoltre grazie a Telegram:</h4>
              <ul class="mdl-list">
                <li class="mdl-list__item">
                  <span class="mdl-list__item-primary-content">
                   <i class="material-icons mdl-list__item-icon">notification_important</i>
                    Visualizzare la reperibilità dei vigili 
                  </span>
                </li>
                <li class="mdl-list__item">
                  <span class="mdl-list__item-primary-content">
                    <i class="material-icons mdl-list__item-icon">chrome_reader_mode</i>
                    Consultare la propria squadra e i propri turni
                  </span>
                </li>
                <li class="mdl-list__item">
                  <span class="mdl-list__item-primary-content">
                    <i class="material-icons mdl-list__item-icon">whatshot</i>
                    Visualizzare la squadra disponibile durante il weekend
                  </span>
                </li>
                <li class="mdl-list__item">
                  <span class="mdl-list__item-primary-content">
                    <i class="material-icons mdl-list__item-icon">assignment_turned_in</i>
                    Visualizzare i propri corsi 
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
        <footer class="mdl-mini-footer" style="background-color:#c0392b">
          <div class="mdl-mini-footer__left-section">
          <ul class="mdl-mini-footer__link-list mdl-color-text--white">
              <li><a href="#" onclick="privacy()">Privacy Policy</a></li>
              <li><a href="#" onclick="terms()">Termini e condizioni</a></li>
            </ul> 
          </div>
          <div class="mdl-mini-footer__right-section">
           <div class="mdl-logo">&copy 2019 myCasermaVVF Anas Araid <br> <i>Dai soccorritori per i soccorritori</i></div>           
          </div>
        </footer>
        <script>
          // notifica cookie
          new Noty({
            layout: 'bottomRight',
            closeWith: ['click', 'button'],
            text: 'Questo sito si avvale di cookie necessari al funzionamento illustrato nella privacy policy. Chiudendo questo banner, scorrendo questa pagina, cliccando su un link o proseguendo la navigazione in altra maniera, acconsenti all’uso dei cookie.'
          }).show();
        </script>
        <!-- <div id="footer" style="margin:0;bottom:0;background-color:#c0392b;height:max-content;padding:20px">
          <h6 style="color:white">Anas Araid &copy 2019 myCasermaVVF. 
            <i>Creato dai soccorritori per i soccorritori.</i>
            <a href="#" onclick="privacy()">Privacy Policy</a>
          </h6>
        </div>--<
      </main>
    </div>
  </body>
</html>
