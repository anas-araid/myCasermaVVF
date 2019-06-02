<div style="text-align:center">
  <?php
    if (isset($_GET['id'])){
      $idFireman = text_filter($_GET['id']);
      $fireman = getFiremanData($idFireman, null, null, null, null, null, $db_conn);
      if (empty($fireman)){
        redirect('?redirect=vigili');
      }else if ($fireman['FK_CorpoVVF'] != $_SESSION['ID']){
        redirect('?redirect=vigili');
      }
    }else{
      redirect('?redirect=vigili');
    }
   ?>
  <h3>Tutti i corsi di <?php echo $fireman['Nome'].' '.$fireman['Cognome'] ?></h3>
  <button class="style-button-red" onclick="newCertificato(<?php echo $fireman['ID'] ?>)">AGGIUNGI CERTIFICATO</button>
  <?php
    if (isset($_GET['ref'])){
      $ref = $_GET['ref'];
      if ($ref == 'mostraSquadra'){
        if (isset($_GET['refID'])){
          $idSquadra=$_GET['refID'];
          $squadraByID = getSquadre($idSquadra, null, $db_conn);
          if (empty($idSquadra)){
            redirect('?redirect=squadre');
          }else if (empty($squadraByID)){
            redirect('?redirect=squadre');
          }else if($squadraByID['FK_CorpoVVF'] != $_SESSION['ID']){
            redirect('?redirect=squadre');
          }
          echo '<button class="style-button-white" onclick="location.href='."'?redirect=mostraSquadra&id=$idSquadra'".'">INDIETRO</button>';
        }else{
          echo '<button class="style-button-white" onclick="location.href='."'?redirect=squadre'".'">INDIETRO</button>';
        }
      }else{
        echo '<button class="style-button-white" onclick="location.href='."'?redirect=vigili'".'">INDIETRO</button>';
      }
    }

   ?>

</div>
<div style="overflow:auto">
  <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width:95%;margin:10px;overflow:auto">
    <thead>
      <tr style="text-align:left">
        <th class="style-td">ID</th>
        <th class="style-td">Corso</th>
        <th class="style-td">Dimensioni file</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
        $checkingExists = false;
        $corsi = getCorsi(null, $fireman['ID'], $db_conn);
        for ($i=0; $i < count($corsi); $i++){
          $checkingExists = true;
          $id = $corsi[$i][0];
          $corso = $corsi[$i][1];
          $file = $corsi[$i][2];
          $filename = ($file=='') ? 'Nessun file caricato' : round(filesize('uploads/'.$file) / 1024 / 1024, 1).' MB'; // round 1024 mega restituisce la dimensione del file
          $show='';
          $pdfName = str_replace(' ', '_', $corso);;
          if ($file == ''){
            $show = '<td class="style-td"></td>';
          }else{
            $show = '<td class="style-td"><a onclick="downloadFile('."'$file', "."'$pdfName'".')" style="cursor:pointer;text-decoration:underline">Scarica</a></td>';
          }
          echo '<tr>
              <td class="style-td">'.$id.'</td>
              <td class="style-td">'.$corso.'</td>
              <td class="style-td">'.$filename.'</td>
              '.$show.'
              <td class="style-td"><a onclick="alertDeleteCertificato('.$id.')" style="color:red;cursor:pointer;text-decoration:underline">Elimina</a></td>
            </tr>';
        }
        ?>
    </tbody>
  </table>
</div>
<div style="text-align:center">
  <?php
  if(!$checkingExists){
    echo "<h5 class='style-text-darkblue'>Nessun certificato</h5>";
  }
  ?>
</div>
</div>

<script>
  function downloadFile(file, corso){
    window.open('app/controllers/downloadfile.php?file='+file+'&name='+corso, '_blank');
  }

  var newCorso = '';
  function newCertificato(id){
    this.newCorso =
    '<div class="mdl-card mdl-shadow--8dp" style="border-radius:20px;padding:20px;width:85%;min-height:200px;display:inline-block;margin:20px;text-align:center">'+
    '<h3>Nuovo certificato</h3>'+
    '<br>'+
    '<form method="post" action="app/controllers/newCertificato.php" enctype="multipart/form-data">' +
    '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">'+
    '<p class="mdl-color-text--grey-800">Corso</p>'+
    '<input class="mdl-textfield__input" type="text" id="corso" name="corso" style="outline:none" required="">'+
    '</div><br>'+
    '<input hidden name="documento" id="documento" type="file" accept="application/pdf"></input>'+
    '<input type="button" class="style-button-white" style="width:50%;" name="documento" value="CARICA DOCUMENTO" onclick="document.getElementById('+"'documento'"+').click();"></input>'+
    '<p>* dimensione massima 20mb</p>'+
    '<br>'+
    '<button class="style-button-red" name="salva" id="salva" type="submit" value="'+id+'">SALVA</button>'+
    '<button class="style-button-red" name="annulla" id="annulla" type="reset" onclick=newCertificatoModal.close()>ANNULLA</button>'+
    '</form>';

    newCertificatoModal.open();
  }
  var newCertificatoModal = new tingle.modal({
        closeMethods: ['overlay', 'button', 'escape'],
        closeLabel: "Chiudi",
        cssClass: ['custom-class-1', 'custom-class-2'],
        onOpen: function() {
            newCertificatoModal.setContent(
              newCorso
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
