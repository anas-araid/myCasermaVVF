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
  <h2 class="mdl-color-text--grey-800">Turni - squadra <?php echo $squadraByID['Numero'] ?></h2>
  <button class="style-button-red" onclick="newTurno(<?php echo $idSquadra ?>)">AGGIUNGI TURNO</button>
  <button class="style-button-white"  onclick="location.href='?redirect=mostraSquadra&id=<?php echo $idSquadra?>'">INDIETRO</button>
</div>
<div style="overflow:auto">
  <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width:95%;margin:10px">
    <thead>
      <tr style="text-align:left">
        <th class="style-td">Data</th>
        <th class="style-td">Checklist Mezzo</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
        $turni = getTurni(null, $idSquadra, $db_conn);
        for ($i=0; $i < count($turni); $i++){
          $checkingExists = true;
          $id = $turni[$i][0];
          $data = $turni[$i][1];
          $idMezzo = $turni[$i][3];
          $mezzo = getMezzi($idMezzo, null, $db_conn);
          echo '<tr>
              <td class="style-td">'.date('d-m-Y', strtotime($data)).'</td>
              <td class="style-td">'.$mezzo.'</td>
              <td class="style-td"><a onclick="alertDeleteTurno('.$id.', '.$idSquadra.')" style="color:red;cursor:pointer;text-decoration:underline">Elimina</a></td>
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
  var newShift = '';
  function newTurno(id){
    this.newShift =
    '<div class="mdl-card mdl-shadow--8dp" style="border-radius:20px;padding:20px;width:85%;min-height:200px;display:inline-block;margin:20px;text-align:center">'+
    '<h3>Nuovo turno</h3>'+
    '<br>'+
    '<form method="post" action="app/controllers/newTurno.php" enctype="multipart/form-data">' +
    '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">'+
    '<p class="mdl-color-text--grey-800">Data</p>'+
    '<input class="mdl-textfield__input" type="date" id="date" name="date" style="outline:none" required="">'+
    '</div><br>'+
    '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">'+
    '<select class="mdl-textfield__input" id="mezzo" name="mezzo" required="" style="outline:none">'+
    <?php
      $mezzi = getMezzi(null, $_SESSION['ID'], $db_conn);
      $selected = '';
      for ($i=0;$i<count($mezzi);$i++){
        if ($i == 0){
          $selected = 'selected';
        }
        echo "'".'<option value="'.$mezzi[$i][0].'" '.$selected.'>'.$mezzi[$i][1]."</option>'+";
        $selected = '';
      }
     ?>
    '</select>'+
    '</div><br>'+
    '<button class="style-button-red" name="salva" id="salva" type="submit" value="'+id+'">SALVA</button>'+
    '<button class="style-button-red" name="annulla" id="annulla" type="reset" onclick=newTurnoModal.close()>ANNULLA</button>'+
    '</form>';

    newTurnoModal.open();
  }
  var newTurnoModal = new tingle.modal({
        closeMethods: ['overlay', 'button', 'escape'],
        closeLabel: "Chiudi",
        onOpen: function() {
            newTurnoModal.setContent(
                newShift
            );
        },
    });
</script>


