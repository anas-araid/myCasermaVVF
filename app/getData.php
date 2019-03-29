<?php

function getFiremanData($ID, $phone, $chatId, $idCaserma, $reperibile, $autista, $db_conn){
    $fireman = array();
    if ($ID == null){
      $sql = "SELECT * FROM t_vigili";
    }else{
      $sql = "SELECT * FROM t_vigili WHERE (ID='$ID')";
    }
    if ($phone != null){
      $sql = "SELECT * FROM t_vigili WHERE (Cellulare='$phone')";
    }
    if ($chatId != null){
      $sql = "SELECT * FROM t_vigili WHERE (Chat_ID='$chatId')";
    }
    if ($reperibile != null){
      $sql = "SELECT * FROM t_vigili WHERE (Reperibile='$reperibile')";
    }
    if ($autista != null){
      $sql = "SELECT * FROM t_vigili WHERE (Autista='$autista')";
    }
    if ($idCaserma != null){
      $sql = "SELECT * FROM t_vigili WHERE (FK_CorpoVVF='$idCaserma')";
    }
    $sql .= ' ORDER BY Cognome';
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      if ($chatId != null){
        $fireman['ID'] = $ris['ID'];
        $fireman['Nome'] = $ris['Nome'];
        $fireman['Cognome'] = $ris['Cognome'];
        $fireman['Matricola'] = $ris['Matricola'];
        $fireman['Cellulare'] = $ris['Cellulare'];
        $fireman['Chat_ID'] = $ris['Chat_ID'];
        $fireman['FK_Grado'] = $ris['FK_Grado'];
        $fireman['FK_CorpoVVF'] = $ris['FK_CorpoVVF'];
        $fireman['Reperibile'] = $ris['Reperibile'];
        $fireman['Autista'] = $ris['Autista'];
        return $fireman;
      }
      if ($phone != null){
        $fireman['ID'] = $ris['ID'];
        $fireman['Nome'] = $ris['Nome'];
        $fireman['Cognome'] = $ris['Cognome'];
        $fireman['Matricola'] = $ris['Matricola'];
        $fireman['Cellulare'] = $ris['Cellulare'];
        $fireman['Chat_ID'] = $ris['Chat_ID'];
        $fireman['FK_Grado'] = $ris['FK_Grado'];
        $fireman['FK_CorpoVVF'] = $ris['FK_CorpoVVF'];
        $fireman['Reperibile'] = $ris['Reperibile'];
        $fireman['Autista'] = $ris['Autista'];
        return $fireman;
      }
      if($ID == null){
        $fireman["$i"] = array($ris['ID'], $ris['Nome'], $ris['Cognome'], $ris['Matricola'], $ris['Cellulare'], $ris['Chat_ID'], $ris['FK_Grado'], $ris['FK_CorpoVVF'], $ris['Reperibile'], $ris['Autista']);
        $i++;
      }else{
        $fireman['ID'] = $ris['ID'];
        $fireman['Nome'] = $ris['Nome'];
        $fireman['Cognome'] = $ris['Cognome'];
        $fireman['Matricola'] = $ris['Matricola'];
        $fireman['Cellulare'] = $ris['Cellulare'];
        $fireman['Chat_ID'] = $ris['Chat_ID'];
        $fireman['FK_Grado'] = $ris['FK_Grado'];
        $fireman['FK_CorpoVVF'] = $ris['FK_CorpoVVF'];
        $fireman['Reperibile'] = $ris['Reperibile'];
        $fireman['Autista'] = $ris['Autista'];
        return $fireman;
      }
    }
    return $fireman;
  }

  function getGrado($ID, $db_conn){
    if ($ID == null){
      $sql = "SELECT * FROM t_gradi";
      $grado = array();
    }else{
      $sql = "SELECT * FROM t_gradi WHERE (ID=$ID)";
      $grado = '';
    }
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      if($ID == null){
        $grado["$i"] = array($ris['ID'], $ris['Grado']);
        $i++;
      }else{
        $grado = $ris['Grado'];
      }
    }
    return $grado;
  }
  function getCaserma($ID, $Descrizione, $db_conn){
    if ($ID == null){
      $sql = "SELECT * FROM t_caserme";
      $caserme = array();
    }else{
      $sql = "SELECT * FROM t_caserme WHERE (ID='$ID')";
      $caserme = '';
    }
    if ($Descrizione != null){
      $sql = "SELECT * FROM t_caserme WHERE (Descrizione='$Descrizione')";
      $caserme = '';
    }
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      if ($Descrizione != null){
        $caserme['ID'] = $ris['ID'];
        $caserme['Descrizione'] = $ris['Descrizione'];
        $caserme['Password'] = $ris['Password'];
        return $caserme;
      }
      if($ID == null){
        $caserme["$i"] = array($ris['ID'], $ris['Descrizione'], $ris['Password']);
        $i++;
      }else{
        $caserme['ID'] = $ris['ID'];
        $caserme['Descrizione'] = $ris['Descrizione'];
        $caserme['Password'] = $ris['Password'];
      }
    }
    return $caserme;
  }
  function getMezzi($ID, $FK_CorpoVVF, $db_conn){
    if ($ID == null){
      $sql = "SELECT * FROM t_mezzi ORDER BY Descrizione";
      $mezzi = array();
    }else{
      $sql = "SELECT * FROM t_mezzi WHERE (ID='$ID')";
      $mezzi = '';
    }
    if ($FK_CorpoVVF != null){
      $sql = "SELECT * FROM t_mezzi WHERE (FK_CorpoVVF='$FK_CorpoVVF') ORDER BY Descrizione";
      $mezzi = array();
    }
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error getMezzi");
    }
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      if ($FK_CorpoVVF != null){
        $mezzi["$i"] = array($ris['ID'], $ris['Descrizione']);
        $i++;
      }else if($ID == null){
        $mezzi["$i"] = array($ris['ID'], $ris['Descrizione']);
        $i++;
      }else{
        $mezzi = $ris['Descrizione'];
      }
    }
    return $mezzi;
  }
  function checkPassword($id, $password, $db_conn){
    $selectQuery = "SELECT * FROM t_caserme WHERE ID='$id' AND Password='$password'";
    $select = mysqli_query($db_conn, $selectQuery);
    if ($select==null){
      die('error');
        //throw new exception ("Impossibile aggiornare l'utente");
    }
    while($ris = mysqli_fetch_array ($select, MYSQLI_ASSOC)){
      //$_SESSION['include'] = ' ';
      $caserma = getCaserma($id, null, $db_conn);
    }
    return $caserma;
  }
  function getCorsi($ID, $FK_Vigile, $db_conn){
    $sql = '';
    if ($ID == null){
      $sql = "SELECT * FROM t_certificazioni";
      $corso = array();
    }else{
      $sql = "SELECT * FROM t_certificazioni WHERE (ID='$ID')";
      $corso = '';
    }
    if ($FK_Vigile != null){
      $sql = "SELECT * FROM t_certificazioni WHERE (FK_Vigile='$FK_Vigile')";
      $corso = array();
    }
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error getCorsi");
    }
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      if ($FK_Vigile != null){
        $corso["$i"] = array($ris['ID'], $ris['Corso'], $ris['File']);
        $i++;
      }
      else if($ID == null){
        $corso["$i"] = array($ris['ID'], $ris['Corso'], $ris['File']);
        $i++;
      }
      else{
        $corso['ID'] = $ris['ID'];
        $corso['Corso'] = $ris['Corso'];
        $corso['File'] = $ris['File'];
        $corso['FK_Vigile'] = $ris['FK_Vigile'];
      }
    }
    return $corso;
  }
  function getSquadraByVigili($ID, $FK_Vigile, $db_conn){
    if ($ID == null){
      $sql = "SELECT * FROM t_squadre";
      $squadra = array();
    }else{
      $sql = "SELECT * FROM t_squadre WHERE (ID='$ID')";
      $squadra = '';
    }
    if ($FK_Vigile != null){
      $sql = "SELECT * FROM t_squadre WHERE (FK_Vigile='$FK_Vigile')";
      $squadra = array();
    }
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error getSquadraByVigili");
    }
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      if ($FK_Vigile != null){
        $squadra = array($ris['ID'], $ris['FK_NumeroSquadra'], $ris['FK_Vigile']);
      }
      else if($ID == null){
        $squadra = array($ris['ID'], $ris['FK_NumeroSquadra'], $ris['FK_Vigile']);
      }
      else{
        $squadra['ID'] = $ris['ID'];
        $squadra['Corso'] = $ris['FK_NumeroSquadra'];
        $squadra['FK_Vigile'] = $ris['FK_Vigile'];
      }
    }
    return $squadra;
  }
  function getSquadre($ID, $FK_CorpoVVF, $db_conn){
    if ($ID == null){
      $sql = "SELECT * FROM t_numeroSquadre";
      $nSquadre = array();
    }else{
      $sql = "SELECT * FROM t_numeroSquadre WHERE (ID='$ID')";
      $nSquadre = '';
    }
    if ($FK_CorpoVVF != null){
      $sql = "SELECT * FROM t_numeroSquadre WHERE (FK_CorpoVVF='$FK_CorpoVVF')";
      $nSquadre = array();
    }
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error getSquadre");
    }
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      if ($FK_CorpoVVF != null){
        $nSquadre["$i"] = array($ris['ID'], $ris['Numero'], $ris['FK_CorpoVVF']);
        $i++;
      }
      else if($ID == null){
        $nSquadre["$i"] = array($ris['ID'], $ris['Numero'], $ris['FK_CorpoVVF']);
        $i++;
      }
      else{
        $nSquadre['ID'] = $ris['ID'];
        $nSquadre['Numero'] = $ris['Numero'];
        $nSquadre['FK_CorpoVVF'] = $ris['FK_CorpoVVF'];
      }
    }
    return $nSquadre;
  }
  function getVigiliBySquadra($ID, $FK_NumeroSquadra, $db_conn){
    if ($ID == null){
      $sql = "SELECT * FROM t_squadre";
      $squadra = array();
    }else{
      $sql = "SELECT * FROM t_squadre WHERE (ID='$ID')";
      $squadra = '';
    }
    if ($FK_NumeroSquadra != null){
      $sql = "SELECT * FROM t_squadre WHERE (FK_NumeroSquadra='$FK_NumeroSquadra')";
      $squadra = array();
    }
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error getVigiliBySquadra");
    }
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      if ($FK_NumeroSquadra != null){
        $squadra["$i"] = $ris['FK_Vigile'];
        $i++;
      }else if($ID == null){
        $squadra["$i"] = $ris['FK_Vigile'];
        $i++;
      }
    }
    return $squadra;
  }
  function getTurni($ID, $idSquadra, $db_conn){
    if ($ID == null){
      $sql = "SELECT * FROM t_turnifestivi ORDER BY dataTurno DESC";
      $turni = array();
    }else{
      $sql = "SELECT * FROM t_turnifestivi WHERE (ID='$ID')";
      $turni = '';
    }
    if ($idSquadra != null){
      $sql = "SELECT * FROM t_turnifestivi WHERE (FK_NumeroSquadra='$idSquadra') ORDER BY dataTurno DESC";
      $turni = array();
    }
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error getTurni");
    }
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      if ($idSquadra != null){
        $turni["$i"] = array($ris['ID'], $ris['dataTurno'], $ris['FK_NumeroSquadra'], $ris['FK_Checklist']);
        $i++;
      }else if($ID == null){
        $turni["$i"] = array($ris['ID'], $ris['dataTurno'], $ris['FK_NumeroSquadra'], $ris['FK_Checklist']);
        $i++;
      }else{
        $turni = array($ris['ID'], $ris['dataTurno'], $ris['FK_NumeroSquadra'], $ris['FK_Checklist']);
      }
    }
    return $turni;
  }
  function getReperibili($FK_CorpoVVF, $reperibile, $db_conn){
    $sql = "SELECT ID FROM t_vigili WHERE (Reperibile='$reperibile') AND (FK_CorpoVVF='$FK_CorpoVVF')";
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error getReperibili");
    }
    $i=0;
    $reperibili = array();
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      $reperibili[$i] = array($ris['ID']);
      $i++;
    }
    return $reperibili;
  }
?>
