<div style="text-align:center">
  <h2 class="mdl-color-text--grey-800">Vigili</h2>
  <button class="style-button-red"  onclick="newFireman()">AGGIUNGI VIGILE</button>
</div>
<div style="overflow:auto">
  <script>
    function openCertificazioni(id){
      location.href ="?redirect=certificazioni&ref=vigili&id=" + id;
    }

  </script>
  <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width:95%;margin:10px">
    <thead>
      <tr style="text-align:left">
        <th class="style-td">Cognome</th>
        <th class="style-td">Nome</th>
        <th class="style-td">Cellulare</th>
        <th class="style-td">Grado</th>
        <th class="style-td">Autista</th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
        $vigili = getFiremanData(null, null, null, $_SESSION['ID'], null, null, $db_conn);
        for ($i=0; $i < count($vigili); $i++){
          $checkingExists = true;
          $id = $vigili[$i][0];
          $nome = $vigili[$i][1];
          $cognome = $vigili[$i][2];
          $cellulare = $vigili[$i][4];
          $autista = $vigili[$i][9];
          $autista = ($autista == 0) ? 'No' : "Si";
          $grado = getGrado($vigili[$i][6], $db_conn);
          echo '<tr>
              <td class="style-td">'.$cognome.'</td>
              <td class="style-td">'.$nome.'</td>
              <td class="style-td">'.$cellulare.'</td>
              <td class="style-td">'.$grado.'</td>
              <td class="style-td">'.$autista.'</td>
              <td class="style-td"><a class="style-link" onclick="openCertificazioni('.$id.')">Certificazioni</a></td>
              <td class="style-td"><a class="style-link" href="dashboard.php?redirect=vigili&edit='.$id.'">Modifica</a></td>
              <td class="style-td"><a class="style-link" onclick="alertDeleteFireman('.$id.')" style="color:red;">Elimina</a></td>
            </tr>';
        }
       ?>
    </tbody>
  </table>
</div>
<script>
  // #################### EDIT VIGILE #######################################
  var editVigile = '';
  var newGrado = '';
  var isAutista = '';
  function editFireman(data){
    var id = data['ID'];
    var nome = data['Nome'];
    var cognome = data['Cognome'];
    var cellulare = data['Cellulare'];
    var matricola = data['Matricola'];
    var grado = data['FK_Grado'];
    this.newGrado = data['FK_Grado'];
    this.isAutista = data['Autista'];
    this.editVigile =
    '<div class="mdl-card mdl-shadow--8dp" style="border-radius:20px;padding:20px;width:85%;min-height:200px;display:inline-block;margin:20px;text-align:center">'+
    '<h3>Aggiorna vigile</h3>'+
    '<br>'+
    '<form method="post" action="app/controllers/editVigile.php" enctype="multipart/form-data">' +
    '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">'+
    '<p class="mdl-color-text--grey-900">Nome</p>'+
    '<input class="mdl-textfield__input" type="text" id="nome" name="nome" value="'+nome+'" style="outline:none" required="">'+
    '</div><br>'+
    '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">'+
    '<p class="mdl-color-text--grey-900">Cognome</p>'+
    '<input class="mdl-textfield__input" type="text" id="cognome" name="cognome" value="'+cognome+'" style="outline:none" required="">'+
    '</div><br>'+
    '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">'+
    '<p class="mdl-color-text--grey-900">Cellulare</p>'+
    '<input class="mdl-textfield__input" type="number" id="cellulare" name="cellulare" value="'+cellulare+'" style="outline:none" required="">'+
    '</div><br>'+
    '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">'+
    '<p class="mdl-color-text--grey-900">Matricola</p>'+
    '<input class="mdl-textfield__input" type="text" id="matricola" name="matricola" value="'+matricola+'" style="outline:none">'+
    '</div><br>'+
    '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">'+
    '<p class="mdl-color-text--grey-900">Grado</p>'+
    '<select class="mdl-textfield__input" id="grado" name="grado" required="" style="outline:none">'+
    <?php
      $gradi = getGrado(null, $db_conn);
      //$selected = '';
      for ($i=0;$i<count($gradi);$i++){
        /*if ($i == count($gradi) - 1){
          $selected = 'selected';
        }*/
        echo "'".'<option id="grado_'.$gradi[$i][0].'" value="'.$gradi[$i][0].'">'.$gradi[$i][1]."</option>'+";
        $selected = '';
      }
     ?>
    '</select>'+
    '</div><br>'+
    '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">'+
    '<p class="mdl-color-text--grey-900">Autista</p>'+
    '<select class="mdl-textfield__input" id="autista" name="autista" required="" style="outline:none">'+
      '<option id="autista_si" value="1">SI</option>' +
      '<option id="autista_no" value="0">NO</option>' +
    '</select>'+
    '</div><br>'+
    '<button class="style-button-red" name="salva" id="salva" type="submit" value=' + id +'>SALVA</button>'+
    '<button class="style-button-red" name="annulla" id="annulla" type="reset" onclick=editFiremanModal.close()>ANNULLA</button>'+
    '</form>';
    editFiremanModal.open();
  }
  var editFiremanModal = new tingle.modal({
        closeMethods: ['overlay', 'button', 'escape'],
        closeLabel: "Chiudi",
        onOpen: function() {
            editFiremanModal.setContent(
              editVigile
            );
            // seleziono se il vigile è autista o no
            setAutista = document.getElementById('autista').options;
            if (isAutista == 1){
              setAutista.autista_si.selected = true;
            }else{
              setAutista.autista_no.selected = true;
            }
            // newGrado contiene l'ID del grado del vigile selezionato
            var setGrado = document.getElementById('grado').options;
            // attiva il select sull'option in base al grado del vigile
            switch(newGrado){
              case '1':
                setGrado.grado_1.selected = true;
                break;
              case '2':
                setGrado.grado_2.selected = true;
                break;
              case '3':
                setGrado.grado_3.selected = true;
                break;
              case '4':
                setGrado.grado_4.selected = true;
                break;
              case '5':
                setGrado.grado_5.selected = true;
                break;
              case '6':
                setGrado.grado_6.selected = true;
                break;
              case '7':
                setGrado.grado_7.selected = true;
                break;
            }
        },
        onClose: function() {
            location.href="dashboard.php?redirect=vigili";
            console.log('modal closed');
        },
    });
</script>


<div style="text-align:center">
  <?php
  if(!$checkingExists){
    echo "<h5 class='style-text-darkblue'>Nessun vigile</h5>";
  }
  if (isset($_GET['edit'])){
    $editID = text_filter($_GET['edit']);
    $editFireman = getFiremanData($editID, null, null, null, null, null, $db_conn);
    if ($editFireman == null){
      redirect('dashboard.php?redirect=vigili');
    }
    $data = json_encode($editFireman);
    echo "<script>editFireman($data)</script>";
  }
  ?>
</div>

<!-- ##################################################################################-->
<!-- NUOVO VIGILE-->

<script>
  var newVigile = '';
  function newFireman(){
    this.newVigile =
    '<div class="mdl-card mdl-shadow--8dp" style="border-radius:20px;padding:20px;width:85%;min-height:200px;display:inline-block;margin:20px;text-align:center">'+
    '<h3>Nuovo vigile</h3>'+
    '<br>'+
    '<form method="post" action="app/controllers/newVigile.php" enctype="multipart/form-data">' +
    '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">'+
    '<p class="mdl-color-text--grey-900">Nome</p>'+
    '<input class="mdl-textfield__input" type="text" id="nome" name="nome" style="outline:none" required="">'+
    '</div><br>'+
    '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">'+
    '<p class="mdl-color-text--grey-900">Cognome</p>'+
    '<input class="mdl-textfield__input" type="text" id="cognome" name="cognome" style="outline:none" required="">'+
    '</div><br>'+
    '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">'+
    '<p class="mdl-color-text--grey-900">Cellulare</p>'+
    '<input class="mdl-textfield__input" type="number" id="cellulare" name="cellulare" style="outline:none" required="">'+
    '</div><br>'+
    '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">'+
    '<p class="mdl-color-text--grey-900">Matricola</p>'+
    '<input class="mdl-textfield__input" type="text" id="matricola" name="matricola" style="outline:none">'+
    '</div><br>'+
    '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">'+
    '<select class="mdl-textfield__input" id="grado" name="grado" required="" style="outline:none">'+
    <?php
      $gradi = getGrado(null, $db_conn);
      $selected = '';
      for ($i=0;$i<count($gradi);$i++){
        if ($i == count($gradi) -1){
          $selected = 'selected';
        }
        echo "'".'<option value="'.$gradi[$i][0].'" '.$selected.'>'.$gradi[$i][1]."</option>'+";
        $selected = '';
      }
     ?>
    '</select>'+
    '</div><br>'+
    '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">'+
    '<p class="mdl-color-text--grey-900">Autista</p>'+
    '<select class="mdl-textfield__input" id="autista" name="autista" required="" style="outline:none">'+
      '<option value="1">SI</option>' +
      '<option value="0" selected>NO</option>' +
    '</select>'+
    '</div><br>'+
    '<button class="style-button-red" name="salva" id="salva" type="submit">SALVA</button>'+
    '<button class="style-button-red" name="annulla" id="annulla" type="reset" onclick=newFiremanModal.close()>ANNULLA</button>'+
    '</form>';
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
