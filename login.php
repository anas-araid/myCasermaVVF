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
          }else{
            header('location:dashboard.php');
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
            <a class="mdl-navigation__link style-text-red" href="index.php#home">Home</a>
            <a class="mdl-navigation__link style-text-red" href="">Accedi</a>
            <a class="mdl-navigation__link style-text-red" href="config.php">Configura</a>
            <a class="mdl-navigation__link style-text-red" href="index.php#scopri">Scopri di più</a>
          </nav>
        </div>
      </header>
      <div class="mdl-layout__drawer">
        <p class="mdl-layout-title style-text-darkred">myCasermaVVF</p>
        <nav class="mdl-navigation">
          <a class="mdl-navigation__link style-text-red" href="index.php#home">Home</a>
          <a class="mdl-navigation__link style-text-red" href="">Accedi</a>
          <a class="mdl-navigation__link style-text-red" href="config.php">Configura</a>
          <a class="mdl-navigation__link style-text-red" href="index.php#scopri">Scopri di più</a>
        </nav>
      </div>
      <main class="mdl-layout__content">
        <div id="particles-js" width="100%" height="100%" style="width:100%;height:100%">
        </div>
        <div class="mdl-grid">
          <div class="mdl-cell mdl-cell--7-col" style="text-align:center">
            <h2 class="style-text-red">Accedi</h2>
            <form action="" method="POST" style="text-align:center">
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <!-- Inserisco nel select tutte le caserme dal db -->
                <select class="mdl-textfield__input" id="caserma" name="caserma" required="" style="outline:none">
                  <?php
                    // $caserme contiene un array con le info degli operatori
                    $caserme = getCaserma(null, null, $db_conn);
                    print_r($caserme);
                    for ($i=0; $i < count($caserme); $i++){
                      echo "<option value='".$caserme[$i][0]."'>".$caserme[$i][1]."</option>";
                    }
                  ?>
                </select>
                <label class="mdl-textfield__label" for="caserma">Caserma</label>
              </div>
              <br>
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="password" id="password" name="password" required="">
                <label class="mdl-textfield__label" for="password">Password</label>
              </div>
              <p>Non c'è il tuo corpo VVF? <a href="config.php" style="cursor:pointer">Clicca qui</a></p>
              <div>
                <button class="style-button-red" type="submit">ENTRA</button><br>
                <button class="style-button-white" onclick="location.href='index.php'" type="reset">INDIETRO</button>
              </div>
            </form>

          </div>
          <div class="mdl-cell mdl-cell--5-col mdl-cell--hide-phone" style="background:url('img/abstract.svg');background-repeat:no-repeat;background-size:contain;">
            <img src="img/screen.png" class="style-bounce" style="width:90%"></img>
          </div>
        </div>
      </main>
    </div>
  </body>
</html>
<?php
  if(isset($_POST['password'])){
    // text_filter dell'input
    $id = text_filter($_POST["caserma"]);
    // md5 della password
    $password = text_filter_encrypt($_POST["password"]);
    // controlla la password
    $caserma = checkPassword($id, $password, $db_conn);
    if (empty($caserma)){
      echo "
      <script>
      flatAlert('Password errata', '', 'error', 'login.php');
      </script>";
    }else{
      $_SESSION['ID'] = $caserma['ID'];
      $_SESSION['Corpo'] = $caserma['Descrizione'];
      echo "
      <script>
      flatAlert('Accesso eseguito con successo', '', 'success', 'app/log.php');
      </script>";
    }
  }

 ?>
