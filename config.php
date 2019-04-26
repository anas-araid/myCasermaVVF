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
        include "app/getData.php";
        if ($_SESSION['ID'] != null){
          $caserma = getCaserma($_SESSION['ID'], null, $db_conn);
          // se l'id non esiste allora fa il logout
          if ($caserma['ID'] == null){
            header('location:app/logout.php');
          }else{
            header('location:dashboard.php');
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
            <a class="mdl-navigation__link style-text-red" href="index.php">Home</a>
            <a class="mdl-navigation__link style-text-red" href="login.php">Accedi</a>
            <a class="mdl-navigation__link style-text-red" href="">Configura</a>
            <a class="mdl-navigation__link style-text-red" href="index.php#scopri">Scopri di più</a>
          </nav>
        </div>
      </header>
      <div class="mdl-layout__drawer">
        <p class="mdl-layout-title style-text-darkred">myCasermaVVF</p>
        <nav class="mdl-navigation">
          <a class="mdl-navigation__link style-text-red" href="index.php">Home</a>
          <a class="mdl-navigation__link style-text-red" href="login.php">Accedi</a>
          <a class="mdl-navigation__link style-text-red" href="">Configura</a>
          <a class="mdl-navigation__link style-text-red" href="index.php#scopri">Scopri di più</a>
        </nav>
      </div>
      <main class="mdl-layout__content">
        <div id="particles-js" width="100%" height="100%" style="width:100%;height:100%">
        </div>
        <div class="mdl-grid">
          <div class="mdl-cell mdl-cell--7-col" style="text-align:center">
            <h2 class="style-text-red">Configurazione</h2>
            <form action="app/addCaserma.php" method="POST" style="text-align:center">
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="caserma" name="caserma" required="">
                <label class="mdl-textfield__label" for="caserma">Corpo di appartenenza</label>
              </div>
              <br>
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="email" id="email" name="email">
                <label class="mdl-textfield__label" for="email">Email</label>
              </div>
              <br>
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="number" id="telefono" name="telefono">
                <label class="mdl-textfield__label" for="telefono">Telefono</label>
              </div>
              <br>
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="password" id="password" name="password" required="">
                <label class="mdl-textfield__label" for="password">Password</label>
              </div>
              <br>
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="password" id="confermaPassword" name="confermaPassword" required="">
                <label class="mdl-textfield__label" for="confermaPassword">Conferma password</label>
              </div>
              <p>Il tuo corpo VVF è già stato configurato? <a href="login.php" style="cursor:pointer">Clicca qui</a></p>
              <p>
                <i>Continuando con la registrazione dichiari di aver letto <br> 
                  <a href="#" onclick="privacy()" style="cursor:pointer">l'informativa sul trattamento dei dati</a> e <a href="#" onclick="terms()" style="cursor:pointer">i termini e condizioni d'utilizzo</a>
                </i>
              </p>
              <div>
                <button class="style-button-red" type="submit" name="conferma">CONTINUA</button><br>
                <button class="style-button-white" onclick="location.href='index.php'" type="reset">INDIETRO</button>
              </div>
            </form>
          </div>
          <div class="mdl-cell mdl-cell--5-col mdl-cell--hide-phone" style="background:url('img/abstract.svg');background-repeat:no-repeat;background-size:contain;">
            <img src="img/screen.png" class="style-bounce" style="width:90%"></img>
          </div>
        </div>
        <script>
           var password          = document.getElementById("password");
           var conferma_password = document.getElementById("confermaPassword");
           //var registrati        = document.getElementById("signup");
           function validaPassword() {
             if (password.value != conferma_password.value){
               conferma_password.setCustomValidity("Le password non corrispondono o la lunghezza è insufficiente");
             }else{
               conferma_password.setCustomValidity("");
             }
           }
           password.onchange         = validaPassword;
           conferma_password.onkeyup = validaPassword;
        </script>
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
        ?>
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
      </main>
    </div>
  </body>
</html>
