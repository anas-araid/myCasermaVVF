<div style="text-align:center">
  <h2 class="mdl-color-text--grey-800">Squadre</h2>
  <button class="style-button-red"  onclick="newSquadra()">AGGIUNGI SQUADRA</button>
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
              <td class="style-td">'.$squadra.'</td>
              <td class="style-td"><a class="style-link" onclick="openSquadra('.$id.')">Mostra</a></td>
              <td class="style-td"><a class="style-link" href="dashboard.php?redirect=squadre&edit='.$id.'">Modifica nome</a></td>
              <td class="style-td"><a class="style-link" onclick="alertDeleteSquadra('.$id.')" style="color:red">Elimina</a></td>
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
    '<button class="style-button-red" name="annulla" id="annulla" type="reset" onclick=editSquadModal.close()>ANNULLA</button>'+
    '</form>';
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
    echo "<h5 class='style-text-darkblue'>Nessuna squadra</h5>";
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
    '<button class="style-button-red" name="annulla" id="annulla" type="reset" onclick=newSquadModal.close()>ANNULLA</button>'+
    '</form>';
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
