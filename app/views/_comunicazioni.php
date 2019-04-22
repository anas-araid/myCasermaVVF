<div style="text-align:center">
  <h2 class="mdl-color-text--grey-800">Comunicazioni</h2>
  <br>
  <form action="app/controllers/" method="POST" style="text-align:center">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <textarea class="mdl-textfield__input" row="3" id="messaggio" name="messaggio" required="" maxlength="40"></textarea>
      <label class="mdl-textfield__label" for="messaggio">Invia un messaggio a tutti i vigili</label>
    </div>
    <br>
    <div>
      <button class="style-button-red" 
              type="submit"
              value="<?php echo $caserma['ID'] ?>"
              name="invia">
        INVIA
      </button><br>
      <button class="style-button-white" onclick="location.href='?redirect=home'" type="reset">INDIETRO</button>
    </div>
    </div>
  </form>
</div>