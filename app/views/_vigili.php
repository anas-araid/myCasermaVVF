<div style="overflow:auto">
  <script>
    function openCertificazioni(id){
      location.href ="?redirect=certificazioni&id=" + id;
    }

  </script>
  <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width:95%;margin:10px">
    <thead>
      <div style="text-align:center">
        <button class="style-button-red"  onclick="newFireman()">AGGIUNGI VIGILE</button>
      </div>
      <tr style="text-align:left">
        <th class="style-td">Cognome</th>
        <th class="style-td">Nome</th>
        <th class="style-td">Cellulare</th>
        <th class="style-td">Grado</th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
        $vigili = getFiremanData(null, null, null, $_SESSION['ID'], $db_conn);
        for ($i=0; $i < count($vigili); $i++){
          $checkingExists = true;
          $id = $vigili[$i][0];
          $nome = $vigili[$i][1];
          $cognome = $vigili[$i][2];
          $cellulare = $vigili[$i][4];
          $grado = getGrado($vigili[$i][6], $db_conn);
          echo '<tr>
              <td class="style-td">'.$cognome.'</td>
              <td class="style-td">'.$nome.'</td>
              <td class="style-td">'.$cellulare.'</td>
              <td class="style-td">'.$grado.'</td>
              <td class="style-td"><a onclick="openCertificazioni('.$id.')" style="cursor:pointer;text-decoration:underline">Certificazioni</a></td>
              <td class="style-td"><a href="">Modifica</a></td>
              <td class="style-td"><a href="#" onclick="alertDeleteFireman('.$id.')" style="color:red">Elimina</a></td>
            </tr>';
        }
       ?>
    </tbody>
  </table>
</div>
<div style="text-align:center">
  <?php
  if(!$checkingExists){
    echo "<h5 class='style-text-darkblue'>Nessun vigile</h5>";
  }
  ?>
</div>
<script>
  var newVigile = '';
  function newFireman(){
    this.newVigile =
    '<div class="mdl-card mdl-shadow--8dp" style="border-radius:20px;padding:20px;width:85%;min-height:200px;display:inline-block;margin:20px;text-align:center">'+
    '<h3>Nuovo certificato</h3>'+
    '<br>'+
    '<form method="post" action="app/controllers/newCertificato.php" enctype="multipart/form-data">' +
    '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">'+
    '<p class="mdl-color-text--grey-800">Corso</p>'+
    '<input class="mdl-textfield__input" type="text" id="corso" name="corso" style="outline:none" required="">'+
    '</div><br>'+
    '<input hidden name="documento" id="documento" type="file" accept="application/pdf"></input>'+
    '<input type="button" class="style-button-white" style="width:50%;" name="documento" value="CARICA DOCUMENTO" onclick="document.getElementById('+"'documento'"+').click();"></input>'+
    '<p>* dimensione massima 20mb</p>'+
    '<br>'+
    '<button class="style-button-red" name="salva" id="salva" type="submit">SALVA</button>'+
    '<button class="style-button-red" name="annulla" id="annulla" type="reset" onclick=newFiremanModal.close()>ANNULLA</button>';

    newFiremanModal.open();
  }
  var newFiremanModal = new tingle.modal({
        closeMethods: ['overlay', 'button', 'escape'],
        closeLabel: "Chiudi",
        cssClass: ['custom-class-1', 'custom-class-2'],
        onOpen: function() {
            newFiremanModal.setContent(
              newVigile
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
