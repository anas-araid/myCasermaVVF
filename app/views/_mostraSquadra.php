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
<div style="text-align:center">
  <h2 class="mdl-color-text--grey-800">Squadra <?php echo $squadraByID['Numero'] ?></h2>
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
  <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width:95%;margin:10px">
    <thead>
      <tr style="text-align:left">
        <th class="style-td">Grado</th>
        <th class="style-td">Cognome</th>
        <th class="style-td">Nome</th>
        <th class="style-td">Cellulare</th>
        <th class="style-td">Autista</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
        $listaVigili = getVigiliBySquadra(null, $idSquadra, $db_conn);
        for ($i=0; $i < count($listaVigili); $i++){
          $checkingExists = true;
          $vigili = getFiremanData($listaVigili[$i], null, null, null, null, null, $db_conn);
          $id = $vigili['ID'];
          $nome = $vigili['Nome'];
          $cognome = $vigili['Cognome'];
          $cellulare = $vigili['Cellulare'];
          $grado = getGrado($vigili['FK_Grado'], $db_conn);
          $autista = $vigili['Autista'];
          $autista = ($autista == 0) ? 'No' : "Si";
          echo '<tr>
              <td class="style-td">'.$grado.'</td>
              <td class="style-td">'.$cognome.'</td>
              <td class="style-td">'.$nome.'</td>
              <td class="style-td">'.$cellulare.'</td>
              <td class="style-td">'.$autista.'</td>
              <td class="style-td"><a class="style-link" href="dashboard.php?redirect=certificazioni&id='.$id.'&ref='."mostraSquadra".'&refID='.$idSquadra.'">Certificazioni</a></td>
              <td class="style-td"><a class="style-link" onclick="alertRemoveFiremanFromSquad('.$id.', '.$idSquadra.')" style="color:red">Rimuovi</a></td>
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
  // id, nome, cognome, matricola, cellulare, chatID, Grado, corpo, reperibile, autista
  $allFireFighters = getFiremanData(null,null, null, $_SESSION['ID'], null, null, $db_conn);
  // inserisco gli id di tutti i vigili all'interno di $allID
  $allID = array();
  foreach ($allFireFighters as $vigile) {
    array_push($allID, $vigile[0]);
  }
  // restituisce un array con gli id dei vigili della squadra con id $idSquadra
  $squadFirefighters = getVigiliBySquadra(null, $idSquadra, $db_conn);
  // elimino dall'array $allFireFighters i vigili già inseriti nella squadra quindi nell'array $squadFirefighters
  $allFireFighters = array_diff($allID, $squadFirefighters);
  // riordino l'index (1, 2, 3 ecc.) dell'array $allFireFighters
  $allFireFighters = array_values($allFireFighters);
  ?>
  function addFirefighters(){
    this.newVigile =
    '<div class="mdl-card mdl-shadow--8dp" style="border-radius:20px;padding:20px;width:85%;min-height:200px;display:inline-block;margin:20px;text-align:center">'+
    '<h3>Aggiungi vigili</h3>'+
    '<br>'+
    '<form method="post" action="app/controllers/" enctype="multipart/form-data">' +
    '<div class="mdl-grid" style="width:90%">'+
    <?php
      $rows = count($allFireFighters) / 2;
      if(!is_int($rows)){
        $rows = (int)$rows + 1;
      }
      $index = 0;
      for ($i=0; $i < $rows;$i++){
        for($j=0;$j < 2; $j++){
          if ($index < count($allFireFighters)){
            // $fireman --> id, nome, cognome, matricola, cellulare, chatID, Grado, corpo, reperibile, autista
            // getFiremanData --> id, phone, chatID, idCaserma, reperibile, autista
            $fireman = getFiremanData($allFireFighters[$index] ,null, null, null, null, null, $db_conn);
            echo '
            '."'".'<div class="mdl-cell mdl-cell--middle mdl-cell--6-col" style="text-align:left">'."'+".'
              '."'".'<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="idVigile_'.$fireman['ID'].'">'."'+".'
                '."'".'<input type="checkbox" id="idVigile_'.$fireman['ID'].'" class="mdl-checkbox__input" name="vigile_'.$fireman["ID"].'" value="'.$fireman['ID'].'">'."'+".'
                '."'".'<span class="mdl-checkbox__label">'.$fireman["Nome"].' '.$fireman["Cognome"].'</span>'."'+".'
              '."'".'</label>'."'+".'
              '."'".'</div>'."'+";
          }else{
            echo "'<br>'+";
          }
          $index++;
        }
        echo "'<br>'+";
      }
     ?>
     '</div>'+
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
