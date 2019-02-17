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
        <div class="mdl-grid">
          <div class="mdl-cell mdl-cell--7-col">
            <br><br><br><br>
            <h2 class="style-text-red">La tua <b>caserma</b> a portata di mano...</h2>
            <br><br>
            <button class="style-button-red">PROVALA SUBITO!</button>
            <button class="style-button-white">SCOPRI DI PIÙ</button>
          </div>
          <div class="mdl-cell mdl-cell--5-col mdl-cell--hide-phone" style="background:url('img/abstract.svg');background-repeat:no-repeat;background-size:contain;">
            <img src="img/screen.png" class="style-bounce" style="width:90%"></img>
          </div>
        </div>
        <div class="style-arrow animated bounce">
          <i class="material-icons style-arrow-icon">keyboard_arrow_down</i>
        </div>
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
