<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width:95%;margin:10px">
  <thead>
    <div style="text-align:center">
      <?php
        if (isset($_GET['id'])){
          $idFireman = text_filter($_GET['id']);
          $fireman = getFiremanData($idFireman, null, null, null, $db_conn);
        }else{
          redirect('?redirect=vigili');
        }
       ?>
      <h3>Tutti i corsi di <?php echo $fireman['Nome'].' '.$fireman['Cognome'] ?></h3>
      <button class="style-button-red">AGGIUNGI CERTIFICATO</button>
      <button class="style-button-white" onclick="location.href='?redirect=vigili'">INDIETRO</button>
    </div>
    <tr style="text-align:left">
      <th class="style-td">ID</th>
      <th class="style-td">Corso</th>
      <th class="style-td">File</th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php
      $checkingExists = false;
      $corsi = getCorsi(null, $db_conn);
      for ($i=0; $i < count($corsi); $i++){
        $checkingExists = true;
        $id = $corsi[$i][0];
        $corso = $corsi[$i][1];
        $file = $corsi[$i][2];
        echo '<tr>
            <td class="style-td">'.$id.'</td>
            <td class="style-td">'.$corso.'</td>
            <td class="style-td">'.$file.'</td>
            <td class="style-td"><a href="">Mostra</a></td>
            <td class="style-td"><a href="">Modifica</a></td>
            <td class="style-td"><a href="#" onclick="('.$id.')" style="color:red">Elimina</a></td>
          </tr>';
      }
      ?>
  </tbody>
</table>
<div style="text-align:center">
  <?php
  if(!$checkingExists){
    echo "<h5 class='style-text-darkblue'>Nessun certificato</h5>";
  }
  ?>
</div>
</div>
