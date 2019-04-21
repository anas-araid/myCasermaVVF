<div style="text-align:center">
  <h2 class="mdl-color-text--grey-800">Comunicazioni</h2>
  <br>
  <form action="app/controllers/" method="POST" style="text-align:center">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <input class="mdl-textfield__input" type="text" id="messaggio" name="messaggio" required="">
      <label class="mdl-textfield__label" for="caserma">Invia un messaggio a tutti i vigili</label>
    </div>
    <br>
    <div>
      <button class="style-button-red" 
              name="invia"
              onclick="flatAlert('Vuoi continuare?', 'Tutti i vigili riceveranno il messaggio', 'warning', 'submit', true)" >INVIA</button><br>
      <button class="style-button-white" onclick="location.href='?redirect=home'" type="reset">INDIETRO</button>
    </div>
    </div>
  </form>
</div>