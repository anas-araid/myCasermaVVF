<div style="text-align:center">
  <button class="style-button-red"  onclick="addFirefighters()">AGGIUNGI VIGILI</button>
  <button class="style-button-red"  onclick="location.href='?redirect=turni'">MOSTRA TURNI</button>
  <button class="style-button-white"  onclick="location.href='?redirect=squadre'">INDIETRO</button>
</div>
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
              <td class="style-td"><a class="style-link" href="dashboard.php?redirect=certificazioni&id='.$id.'&ref='."squadra".'">Certificazioni</a></td>
              <td class="style-td"><a class="style-link" onclick="" style="color:red">Rimuovi</a></td>
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
  if (isset($_GET['edit'])){
    $editID = text_filter($_GET['edit']);
    $editSquad = getSquadre($editID, null, $db_conn);
    $data = json_encode($editSquad);
    echo "<script>editSquadra($data)</script>";
  }
  ?>
</div>

<script>
  // #################### AGGIUNTA DEI VIGILI AL MODAL #######################################
  var newVigile = '';
  <?php
  $allFireFighters = getFiremanData(null,null, null, $_SESSION['ID'], $db_conn)[0];
  $squadFirefighters = getVigiliBySquadra(null, $idSquadra, $db_conn);
  $allFireFighters = array_diff($allFireFighters, $squadFirefighters);
  $allFireFighters = json_encode($allFireFighters);
  echo "console.log($allFireFighters)";
  ?>
  function addFirefighters(){
    this.newVigile =
    '<div class="mdl-card mdl-shadow--8dp" style="border-radius:20px;padding:20px;width:85%;min-height:200px;display:inline-block;margin:20px;text-align:center">'+
    '<h3>Aggiungi vigili</h3>'+
    '<br>'+
    '<form method="post" action="app/controllers/addVigiliToSquadra.php" enctype="multipart/form-data">' +
    ''+
    '<button class="style-button-red" name="salva" id="salva" type="submit">SALVA</button>'+
    '<button class="style-button-red" name="annulla" id="annulla" type="reset" onclick=newFirefighterModal.close()>ANNULLA</button>'+
    '</form>';
    newFirefighterModal.open();
  }
  var newFirefighterModal = new tingle.modal({
        closeMethods: ['overlay', 'button', 'escape'],
        closeLabel: "Chiudi",
        cssClass: ['custom-class-1', 'custom-class-2'],
        onOpen: function() {
            newFirefighterModal.setContent(
              newVigile
            );
        },
        onClose: function() {
            location.href="";
            console.log('modal closed');
        },
        beforeClose: function() {
            return true; // close the modal
            return false; // nothing happens
        }
    });
</script>
