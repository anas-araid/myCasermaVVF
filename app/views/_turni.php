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
  <h2 class="mdl-color-text--grey-800">Turni</h2>
  <button class="style-button-red" onclick="">AGGIUNGI TURNO</button>
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
              <td class="style-td">'.$data.'</td>
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

