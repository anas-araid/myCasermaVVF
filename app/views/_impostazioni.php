<div style="text-align:center">
  <h2 class="mdl-color-text--grey-800">Impostazioni</h2>
  <br>
  <form action="app/controllers/editCaserma.php" method="POST" style="text-align:center">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <input class="mdl-textfield__input" type="text" id="caserma" name="caserma" value="<?php echo $caserma['Descrizione'] ?>" required="">
      <label class="mdl-textfield__label" for="caserma">Corpo di appartenenza</label>
    </div>
    <br>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <input class="mdl-textfield__input" type="email" id="email" name="email" value="<?php echo $caserma['Email'] ?>">
      <label class="mdl-textfield__label" for="email">Email</label>
    </div>
    <br>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <input class="mdl-textfield__input" type="number" id="telefono" name="telefono" value="<?php echo $caserma['Telefono'] ?>">
      <label class="mdl-textfield__label" for="telefono">Telefono</label>
    </div>
    <br>
    <div>
      <button class="style-button-red" type="submit" name="aggiorna" value="<?php echo $caserma['ID']?>">AGGIORNA</button><br>
      <button class="style-button-white" onclick="location.href='?redirect=home'" type="reset">INDIETRO</button>
    </div>
    <br><br><br>
    <div>
      <button class="style-button-red" 
              onclick="flatAlert('Vuoi continuare?', 'Tutti i dati relativi alla tua caserma verranno cancellati', 'error', 'app/models/deleteData.php?data=caserma&id=<?php echo $caserma['ID'] ?>', true)" 
              type="reset" 
              name="delete" 
              style="background:red;color:white">
              CANCELLA L'ACCOUNT
      </button><br>
    </div>
  </form>
</div>