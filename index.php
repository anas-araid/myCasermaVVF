<html>
  <head>
     <?php
      include 'app/_header.html';
     ?>
  </head>
  <body style="margin:0">
    <div class="mdl-layout mdl-js-layout">
      <header class="mdl-layout__header mdl-layout--fixed-header mdl-layout__header--transparent">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title style-text-red" style="font-weight:100">my</span><span class="mdl-layout-title style-text-red" style="font-weight:500">Caserma</span><span class="mdl-layout-title style-text-red" style="font-weight:600">VVF</span>
          <div class="mdl-layout-spacer"></div>
          <nav class="mdl-navigation">
            <a class="mdl-navigation__link style-text-red" href="#">Home</a>
            <a class="mdl-navigation__link style-text-red">Accedi</a>
            <a class="mdl-navigation__link style-text-red">Scopri di più</a>
          </nav>
        </div>
      </header>
      <div class="mdl-layout__drawer">
        <p class="mdl-layout-title style-text-darkred">myCasermaVVF</p>
        <nav class="mdl-navigation">
          <a class="mdl-navigation__link style-text-red" href="#">Home</a>
          <a class="mdl-navigation__link style-text-red">Accedi</a>
          <a class="mdl-navigation__link style-text-red">Scopri di più</a>
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
              <button class="style-button-red">INIZIA SUBITO!</button>
              <button class="style-button-white">SCOPRI DI PIÙ</button>
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
            </div>
          </div>
        </section>
        <br><br>
        <section id="section-3" style="text-align:center;background-color:#ecf5fe;">
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
              <button class="style-button-red">CONFIGURAZIONE</button>
            </div>
          </div>
        </section>

      </main>
    </div>
  </body>
</html>


<!--

<body style="text-align:center;">
 <h2>myCasermaVVF in costruzione</h2>
 <div class="animated bounce" style="text-align:center;width:100%">
   <img style="height:50%" src="img/progress.png"/>
 </div>
</body>


-->
