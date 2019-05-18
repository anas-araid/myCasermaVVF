<?php
  if (!isset($_SESSION['search']) or empty($_SESSION['search'])){
    redirect('dashboard.php?redirect=attrezzature');
  }
?>
<div style="text-align:center">
  <h2 class="mdl-color-text--grey-800">Attrezzature</h2>
  <button class="style-button-red" onclick="location.href='dashboard.php?redirect=mezzi'">IDIETRO</button>
</div>
<div>
  <form action="app/controllers/search.php" method="POST" style="text-align:center">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:40%;">
      <input class="mdl-textfield__input" 
              style="border-bottom:1px solid #c5003e;color:grey" 
              type="text" 
              id="find" 
              name="find"
              value="<?php echo $_SESSION['searchKeyword'] ?>"
              required="">
      <label class="mdl-textfield__label" for="find">Cerca</label>
    </div>
    <button id="btn-search" 
            name="submit"
            type="submit" 
            value="attrezzature"
            class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect style-text-red">
      <i class="material-icons style-text-darkRed">search</i>
    </button>
  </form>
</div>
<div style="text-align:center">
  <h5>Risultati relativi alla ricerca <i>"<?php echo $_SESSION['searchKeyword'] ?> "</i></h5>
</div>
<div style="overflow:auto">
  <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width:95%;margin:10px">
    <thead>
      <tr style="text-align:left">
        <th class="style-td">Attrezzature</th>
        <th class="style-td">Quantità</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
        $tools = $_SESSION['search'];
        for ($i=0; $i < count($attr); $i++){
          $checkingExists = true;
          $attr = getAttrezzature($tools[$i][0], null, $db_conn);
          $id = $attr[0][0];
          $nome = $attr[0][1];
          $quantita = $attr[0][2];
          echo '<tr>
              <td class="style-td">'.$nome.'</td>
              <td class="style-td">'.$quantita.'</td>
              <td class="style-td"><a class="style-link" href="dashboard.php?redirect=attrezzature&edit='.$id.'">Modifica</a></td>
              <td class="style-td"><a onclick="alertDeleteAttrezzatura('.$id.')" style="color:red;cursor:pointer;text-decoration:underline">Elimina</a></td>
            </tr>';
        }
       ?>
    </tbody>
  </table>
</div>
<script>
  // #################### EDIT ATTREZZATURA #######################################
  var editContent = '';
  function editTools(data){
    var id = data[0][0];
    var attrezzatura = data[0][1];
    var quantita = data[0][2];
    console.log(data);
    this.editContent =
    '<div class="mdl-card mdl-shadow--8dp" style="border-radius:20px;padding:20px;width:85%;min-height:200px;display:inline-block;margin:20px;text-align:center">'+
    '<h3>Aggiorna l\' attrezzatura</h3>'+
    '<br>'+
    '<form method="post" action="app/controllers/editAttrezzatura.php" enctype="multipart/form-data">' +
    '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">'+
    '<p class="mdl-color-text--grey-900">Attrezzatura</p>'+
    '<input class="mdl-textfield__input" type="text" id="attrezzatura" name="attrezzatura" value="'+attrezzatura+'" style="outline:none" required="">'+
    '</div><br>'+
    '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">'+
    '<p class="mdl-color-text--grey-900">Quantità</p>'+
    '<input class="mdl-textfield__input" type="number" id="quantita" name="quantita" value="'+quantita+'" style="outline:none" required="">'+
    '</div><br>'+
    '<button class="style-button-red" name="salva" id="salva" type="submit" value=' + id +'>SALVA</button>'+
    '<button class="style-button-red" name="annulla" id="annulla" type="reset" onclick=editToolsModal.close()>ANNULLA</button>'+
    '</form>';
    editToolsModal.open();
  }
  var editToolsModal = new tingle.modal({
        closeMethods: ['overlay', 'button', 'escape'],
        closeLabel: "Chiudi",
        onOpen: function() {
          editToolsModal.setContent(
              editContent
            );
        },
        onClose: function() {
            location.href="dashboard.php?redirect=attrezzature";
            console.log('modal closed');
        },
    });
</script>
<div style="text-align:center">
  <?php
    if(!$checkingExists){
      echo "<h5 class='style-text-darkblue'>Nessun attrezzatura</h5>";
    }
    if (isset($_GET['edit'])){
      $editID = text_filter($_GET['edit']);
      $editAttrezzature = getAttrezzature($editID, null, $db_conn);
      if ($editAttrezzature == null){
        redirect('dashboard.php?redirect=attrezzature');
      }
      $data = json_encode($editAttrezzature);
      echo "<script>editTools($data)</script>";
    }
  ?>
</div>