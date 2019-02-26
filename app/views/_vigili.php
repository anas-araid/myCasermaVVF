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
              <td class="style-td"><a href="dashboard.php?redirect=vigili&edit='.$id.'" style="cursor:pointer;text-decoration:underline">Modifica</a></td>
              <td class="style-td"><a onclick="alertDeleteFireman('.$id.')" style="color:red;cursor:pointer;text-decoration:underline">Elimina</a></td>
            </tr>';
        }
       ?>
    </tbody>
  </table>
</div>
<script>
  var editVigile = '';
  function editFireman(data){
    //alert(data['ID']);
    var id = data['ID'];
    var nome = data['Nome'];
    var cognome = data['Cognome'];
    var cellulare = data['Cellulare'];
    var matricola = data['Matricola'];
    var grado = data['FK_Grado'];
    this.editVigile =
    '<div class="mdl-card mdl-shadow--8dp" style="border-radius:20px;padding:20px;width:85%;min-height:200px;display:inline-block;margin:20px;text-align:center">'+
    '<h3>Nuovo vigile</h3>'+
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
    '<select class="mdl-textfield__input" id="grado" name="grado" required="" style="outline:none">'+
    <?php
      $gradi = getGrado(null, $db_conn);
      $selected = '';
      for ($i=0;$i<count($gradi);$i++){
        if ($i == 0){
          $selected = 'selected';
        }
        echo "'".'<option value="'.$gradi[$i][0].'" '.$selected.'>'.$gradi[$i][1]."</option>'+";
        $selected = '';
      }
     ?>
    '</select>'+
    '</div><br>'+
    '<button class="style-button-red" name="salva" id="salva" type="submit">SALVA</button>'+
    '<button class="style-button-red" name="annulla" id="annulla" type="reset" onclick=editFiremanModal.close()>ANNULLA</button>';
    editFiremanModal.open();
  }
  var editFiremanModal = new tingle.modal({
        closeMethods: ['overlay', 'button', 'escape'],
        closeLabel: "Chiudi",
        cssClass: ['custom-class-1', 'custom-class-2'],
        onOpen: function() {
            editFiremanModal.setContent(
              editVigile
            );
        },
        onClose: function() {
            location.href="dashboard.php?redirect=vigili";
            console.log('modal closed');
        },
        beforeClose: function() {
            return true; // close the modal
            return false; // nothing happens
        }
    });
</script>


<div style="text-align:center">
  <?php
  if(!$checkingExists){
    echo "<h5 class='style-text-darkblue'>Nessun vigile</h5>";
  }
  if (isset($_GET['edit'])){
    $editID = text_filter($_GET['edit']);
    $editFireman = getFiremanData($editID, null, null, null, $db_conn);
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
        if ($i == 0){
          $selected = 'selected';
        }
        echo "'".'<option value="'.$gradi[$i][0].'" '.$selected.'>'.$gradi[$i][1]."</option>'+";
        $selected = '';
      }
     ?>
    '</select>'+
    '</div><br>'+
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
