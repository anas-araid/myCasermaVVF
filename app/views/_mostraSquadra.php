<div style="overflow:auto">
  <script>
    function openSquadra(id){
      location.href ="?redirect=mostraSquadra&id=" + id;
    }
  </script>
  <?php
    if (isset($_GET['id'])){
      $idSquadra = text_filter($_GET['id']);
      $squadraByID = getSquadre($idSquadra, null, $db_conn);
      if (empty($idSquadra)){
        redirect('?redirect=squadre');
      }else if (empty($squadraByID)){
        redirect('?redirect=squadre');
      }else if($squadraByID['FK_CorpoVVF'] != $_SESSION['ID']){
        redirect('?redirect=squadre');
      }
    }
    else{
      redirect('?redirect=squadre');
    }


   ?>
  <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width:95%;margin:10px">
    <thead>
      <div style="text-align:center">
        <button class="style-button-red"  onclick="addFirefighters()">AGGIUNGI VIGILI</button>
        <button class="style-button-white"  onclick="location.href='?redirect=squadre'">INDIETRO</button>
      </div>
      <tr style="text-align:left">
        <th class="style-td">Grado</th>
        <th class="style-td">Cognome</th>
        <th class="style-td">Nome</th>
        <th class="style-td">Cellulare</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
        $listaVigili = getVigiliBySquadra(null, $idSquadra, $db_conn);
        for ($i=0; $i < count($listaVigili); $i++){
          $checkingExists = true;
          $vigili = getFiremanData($listaVigili[$i], null, null, null, $db_conn);
          $id = $vigili['ID'];
          $nome = $vigili['Nome'];
          $cognome = $vigili['Cognome'];
          $cellulare = $vigili['Cellulare'];
          $grado = getGrado($vigili['FK_Grado'], $db_conn);
          echo '<tr>
              <td class="style-td">'.$grado.'</td>
              <td class="style-td">'.$cognome.'</td>
              <td class="style-td">'.$nome.'</td>
              <td class="style-td">'.$cellulare.'</td>
              <td class="style-td"><a class="style-link" href="dashboard.php?redirect=certificazioni&id='.$id.'">Certificazioni</a></td>
              <td class="style-td"><a class="style-link" onclick="" style="color:red">Rimuovi</a></td>
            </tr>';
        }
       ?>
    </tbody>
  </table>
</div>
<script>
  // #################### EDIT SQUADRA #######################################
  var editSquad = '';
  function editSquadra(data){
    var id = data['ID'];
    var nomeSquadra = data['Numero'];
    this.editSquad =
    '<div class="mdl-card mdl-shadow--8dp" style="border-radius:20px;padding:20px;width:85%;min-height:200px;display:inline-block;margin:20px;text-align:center">'+
    '<h3>Modifica squadra</h3>'+
    '<br>'+
    '<form method="post" action="app/controllers/editSquadra.php" enctype="multipart/form-data">' +
    '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">'+
    '<p class="mdl-color-text--grey-900">Nome</p>'+
    '<input class="mdl-textfield__input" type="text" id="nome" name="nome" value="'+nomeSquadra+'" style="outline:none" required="">'+
    '</div><br>'+
    '<button class="style-button-red" name="salva" id="salva" type="submit" value=' + id +'>SALVA</button>'+
    '<button class="style-button-red" name="annulla" id="annulla" type="reset" onclick=editSquadModal.close()>ANNULLA</button>';
    editSquadModal.open();
  }
  var editSquadModal = new tingle.modal({
        closeMethods: ['overlay', 'button', 'escape'],
        closeLabel: "Chiudi",
        cssClass: ['custom-class-1', 'custom-class-2'],
        onOpen: function() {
            editSquadModal.setContent(
              editSquad
            );
        },
        onClose: function() {
            location.href="dashboard.php?redirect=squadre";
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
    $editSquad = getSquadre($editID, null, $db_conn);
    $data = json_encode($editSquad);
    echo "<script>editSquadra($data)</script>";
  }
  ?>
</div>

<script>
  // #################### NUOVA SQUADRA #######################################
  var newSquad = '';
  function newSquadra(){
    this.newSquad =
    '<div class="mdl-card mdl-shadow--8dp" style="border-radius:20px;padding:20px;width:85%;min-height:200px;display:inline-block;margin:20px;text-align:center">'+
    '<h3>Nuova squadra</h3>'+
    '<br>'+
    '<form method="post" action="app/controllers/newSquadra.php" enctype="multipart/form-data">' +
    '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">'+
    '<p class="mdl-color-text--grey-900">Nome</p>'+
    '<input class="mdl-textfield__input" type="text" id="nome" name="nome" style="outline:none" required="">'+
    '</div><br>'+
    '<button class="style-button-red" name="salva" id="salva" type="submit">SALVA</button>'+
    '<button class="style-button-red" name="annulla" id="annulla" type="reset" onclick=newSquadModal.close()>ANNULLA</button>';
    newSquadModal.open();
  }
  var newSquadModal = new tingle.modal({
        closeMethods: ['overlay', 'button', 'escape'],
        closeLabel: "Chiudi",
        cssClass: ['custom-class-1', 'custom-class-2'],
        onOpen: function() {
            newSquadModal.setContent(
              newSquad
            );
        },
        onClose: function() {
            location.href="dashboard.php?redirect=squadre";
            console.log('modal closed');
        },
        beforeClose: function() {
            return true; // close the modal
            return false; // nothing happens
        }
    });
</script>
