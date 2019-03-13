<?php

function getFiremanData($ID, $phone, $chatId, $idCaserma, $reperibile, $db_conn){
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
        $fireman['Reperibile'] = $ris['Reperibile'];
        $fireman['FK_Grado'] = $ris['FK_Grado'];
        $fireman['FK_CorpoVVF'] = $ris['FK_CorpoVVF'];
        return $fireman;
      }
      if ($phone != null){
        $fireman['ID'] = $ris['ID'];
        $fireman['Nome'] = $ris['Nome'];
        $fireman['Cognome'] = $ris['Cognome'];
        $fireman['Matricola'] = $ris['Matricola'];
        $fireman['Cellulare'] = $ris['Cellulare'];
        $fireman['Chat_ID'] = $ris['Chat_ID'];
        $fireman['Reperibile'] = $ris['Reperibile'];
        $fireman['FK_Grado'] = $ris['FK_Grado'];
        $fireman['FK_CorpoVVF'] = $ris['FK_CorpoVVF'];
        return $fireman;
      }
      if($ID == null){
        $fireman["$i"] = array($ris['ID'], $ris['Nome'], $ris['Cognome'], $ris['Matricola'], $ris['Cellulare'], $ris['Chat_ID'], $ris['FK_Grado'], $ris['FK_CorpoVVF'], $ris['Reperibile']);
        $i++;
      }else{
        $fireman['ID'] = $ris['ID'];
        $fireman['Nome'] = $ris['Nome'];
        $fireman['Cognome'] = $ris['Cognome'];
        $fireman['Matricola'] = $ris['Matricola'];
        $fireman['Cellulare'] = $ris['Cellulare'];
        $fireman['Chat_ID'] = $ris['Chat_ID'];
        $fireman['Reperibile'] = $ris['Reperibile'];
        $fireman['FK_Grado'] = $ris['FK_Grado'];
        $fireman['FK_CorpoVVF'] = $ris['FK_CorpoVVF'];
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
?>
