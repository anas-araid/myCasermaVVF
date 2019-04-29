<div style="text-align:center">
  <h2 class="mdl-color-text--grey-800">Attrezzature</h2>
  <button class="style-button-red" onclick="newAttrezzatura()">NUOVO</button>
</div>
<div style="overflow:auto">
  <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width:95%;margin:10px">
    <thead>
      <tr style="text-align:left">
        <th class="style-td">Attrezzature</th>
        <th class="style-td">Quantità</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
        $attr = getAttrezzature(null, $_SESSION['ID'], $db_conn);
        for ($i=0; $i < count($attr); $i++){
          $checkingExists = true;
          $id = $attr[$i][0];
          $nome = $attr[$i][1];
          $quantita = $attr[$i][2];
          echo '<tr>
              <td class="style-td">'.$nome.'</td>
              <td class="style-td">'.$quantita.'</td>
              <td class="style-td"><a onclick="alertDeleteAttrezzatura('.$id.')" style="color:red;cursor:pointer;text-decoration:underline">Elimina</a></td>
            </tr>';
        }
       ?>
    </tbody>
  </table>
</div>
<div style="text-align:center">
  <?php
  if(!$checkingExists){
    echo "<h5 class='style-text-darkblue'>Nessun attrezzatura</h5>";
  }
  ?>
</div>
<script>
  var attrezzatura = '';
  function newAttrezzatura(){
    this.attrezzatura =
    '<div class="mdl-card mdl-shadow--8dp" style="border-radius:20px;padding:20px;width:85%;min-height:200px;display:inline-block;margin:20px;text-align:center">'+
    '<h3>Aggiungi un attrezzatura</h3>'+
    '<br>'+
    '<form method="post" action="app/controllers/newAttrezzatura.php" enctype="multipart/form-data">' +
    '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">'+
    '<p class="mdl-color-text--grey-900">Attrezzatura</p>'+
    '<input class="mdl-textfield__input" type="text" id="attrezzatura" name="attrezzatura" style="outline:none" required="">'+
    '</div><br>'+
    '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">'+
    '<p class="mdl-color-text--grey-900">Quantita</p>'+
    '<input class="mdl-textfield__input" type="number" id="quantita" name="quantita" style="outline:none" required="">'+
    '</div><br>'+
    '<button class="style-button-red" name="salva" id="salva" type="submit">SALVA</button>'+
    '<button class="style-button-red" name="annulla" id="annulla" type="reset" onclick=newAttrezzaturaModal.close()>ANNULLA</button>';
    newAttrezzaturaModal.open();
  }
  var newAttrezzaturaModal = new tingle.modal({
        closeMethods: ['overlay', 'button', 'escape'],
        closeLabel: "Chiudi",
        onOpen: function() {
            newAttrezzaturaModal.setContent(
                attrezzatura
            );
        },
        onClose: function() {
            console.log('modal closed');
        }
    });
</script>
