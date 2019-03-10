<div style="text-align:center">
  <button class="style-button-red" onclick="newMezzo()">AGGIUNGI MEZZO</button>
</div>
<div style="overflow:auto">
  <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width:95%;margin:10px">
    <thead>
      <tr style="text-align:left">
        <th class="style-td">Mezzo</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
        $mezzi = getMezzi(null, $_SESSION['ID'], $db_conn);
        for ($i=0; $i < count($mezzi); $i++){
          $checkingExists = true;
          $id = $mezzi[$i][0];
          $mezzo = $mezzi[$i][1];
          echo '<tr>
              <td class="style-td">'.$mezzo.'</td>
              <td class="style-td"><a onclick="alertDeleteMezzo('.$id.')" style="color:red;cursor:pointer;text-decoration:underline">Elimina</a></td>
            </tr>';
        }
       ?>
    </tbody>
  </table>
</div>
<div style="text-align:center">
  <?php
  if(!$checkingExists){
    echo "<h5 class='style-text-darkblue'>Nessun mezzo</h5>";
  }
  ?>
</div>
<script>
  var mezzo = '';
  function newMezzo(){
    this.mezzo =
    '<div class="mdl-card mdl-shadow--8dp" style="border-radius:20px;padding:20px;width:85%;min-height:200px;display:inline-block;margin:20px;text-align:center">'+
    '<h3>Aggiungi un mezzo</h3>'+
    '<br>'+
    '<form method="post" action="app/controllers/newMezzo.php" enctype="multipart/form-data">' +
    '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">'+
    '<p class="mdl-color-text--grey-900">Mezzo</p>'+
    '<input class="mdl-textfield__input" type="text" id="mezzo" name="mezzo" style="outline:none" required="">'+
    '</div><br>'+
    '<button class="style-button-red" name="salva" id="salva" type="submit">SALVA</button>'+
    '<button class="style-button-red" name="annulla" id="annulla" type="reset" onclick=newMezzoModal.close()>ANNULLA</button>';
    newMezzoModal.open();
  }
  var newMezzoModal = new tingle.modal({
        closeMethods: ['overlay', 'button', 'escape'],
        closeLabel: "Chiudi",
        cssClass: ['custom-class-1', 'custom-class-2'],
        onOpen: function() {
            newMezzoModal.setContent(
              mezzo
            );
        },
        onClose: function() {
            console.log('modal closed');
        },
        beforeClose: function() {
            return true; // close the modal
            return false; // nothing happens
        }
    });
</script>
