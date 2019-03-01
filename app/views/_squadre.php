<div style="overflow:auto">
  <script>
    function openSquadra(id){
      location.href ="?redirect=certificazioni&id=" + id;
    }

  </script>
  <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width:95%;margin:10px">
    <thead>
      <div style="text-align:center">
        <button class="style-button-red"  onclick="newSquadra()">AGGIUNGI SQUADRA</button>
      </div>
      <tr style="text-align:left">
        <th class="style-td">Squadra</th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
        $nSquadre = getSquadre(null, $_SESSION['ID'], $db_conn);
        for ($i=0; $i < count($nSquadre); $i++){
          $checkingExists = true;
          $id = $nSquadre[$i][0];
          $squadra = $nSquadre[$i][1];
          echo '<tr>
              <td class="style-td">Squadra '.$squadra.'</td>
              <td class="style-td"><a class="style-link" onclick="openSquadra('.$id.')">Mostra</a></td>
              <td class="style-td"><a class="style-link" href="dashboard.php?redirect=vigili&edit='.$id.'">Modifica nome</a></td>
              <td class="style-td"><a class="style-link" onclick="alertDeleteSquadra('.$id.')" style="color:red">Elimina</a></td>
            </tr>';
        }
       ?>
    </tbody>
  </table>
</div>
