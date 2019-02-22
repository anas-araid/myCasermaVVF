<div style="overflow:auto">
  <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width:95%;margin:10px">
    <thead>
      <div style="text-align:center">
        <button class="style-button-red" type="submit">AGGIUNGI VIGILE</button>
      </div>
      <tr style="text-align:left">
        <th class="style-td">Cognome</th>
        <th class="style-td">Nome</th>
        <th class="style-td">Cellulare</th>
        <th class="style-td">Grado</th>
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
    echo "<h5 class='style-gradient-text'>Nessun vigile</h5>";
  }
  ?>
</div>
