<?php

function getFiremanData($ID, $phone, $chatId, $db_conn){
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
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error");
    }
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      if ($phone != null){
        $fireman['ID'] = $ris['ID'];
        $fireman['Nome'] = $ris['Nome'];
        $fireman['Cognome'] = $ris['Cognome'];
        $fireman['Matricola'] = $ris['Matricola'];
        $fireman['Cellulare'] = $ris['Cellulare'];
        $fireman['Chat_ID'] = $ris['Chat_ID'];
        $fireman['FK_Grado'] = $ris['FK_Grado'];
        return $fireman;
      }
      if($ID == null){
        $fireman["$i"] = array($ris['ID'], $ris['Cognome']." ".$ris['Nome'], $ris['Matricola'], $ris['Cellulare'], $ris['Chat_ID'], $ris['FK_Grado']);
        $i++;
      }else{
        $fireman['ID'] = $ris['ID'];
        $fireman['Nome'] = $ris['Nome'];
        $fireman['Cognome'] = $ris['Cognome'];
        $fireman['Matricola'] = $ris['Matricola'];
        $fireman['Cellulare'] = $ris['Cellulare'];
        $fireman['Chat_ID'] = $ris['Chat_ID'];
        $fireman['FK_Grado'] = $ris['FK_Grado'];
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
  function getMezzi($ID, $db_conn){
    if ($ID == null){
      $sql = "SELECT * FROM t_mezzi";
      $mezzi = array();
    }else{
      $sql = "SELECT * FROM t_mezzi WHERE (ID='$ID')";
      $mezzi = '';
    }
    $risultato = mysqli_query($db_conn, $sql);
    if ($risultato == false){
      die("error getMezzi");
    }
    $i=0;
    while($ris = mysqli_fetch_array ($risultato, MYSQLI_ASSOC)){
      if($ID == null){
        $mezzi["$i"] = array($ris['ID'], $ris['Descrizione']);
        $i++;
      }else{
        $mezzi = $ris['Descrizione'];
      }
    }
    return $mezzi;
  }
?>
