<?php
  function addCaserma($caserma, $email, $telefono, $password, $db_conn){
    $sql = "INSERT INTO t_caserme (Descrizione, Telefono, Email, Password) VALUES ('$caserma', '$telefono', '$email', '$password')";
    try {
      $addCaserma = mysqli_query($db_conn, $sql);
      if (!$addCaserma){
        return false;
      }
    } catch (Exception $e) {
      return false;
    }
    return true;
  }
  function addCorso($corso, $documento, $FK_Vigile, $db_conn){
    $sql = "INSERT INTO t_certificazioni (Corso, File, FK_Vigile) VALUES ('$corso', '$documento', '$FK_Vigile')";
    try {
      $addCorso = mysqli_query($db_conn, $sql);
      if (!$addCorso){
        return false;
      }
    } catch (Exception $e) {
      return false;
    }
    return true;
  }
  function addFireman($nome, $cognome, $cellulare, $matricola, $idGrado, $idCorpo, $autista, $reperibile, $db_conn){
    $sql = "INSERT INTO t_vigili (Nome, Cognome, Matricola, Cellulare, Chat_ID, FK_Grado, FK_CorpoVVF, Autista, Reperibile)
            VALUES ('$nome', '$cognome', '$matricola', '$cellulare', null, '$idGrado', '$idCorpo', '$autista', '$reperibile')";
    try {
      $addVigile = mysqli_query($db_conn, $sql);
      if (!$addVigile){
        return false;
      }
    } catch (Exception $e) {
      return false;
    }
    return true;
  }
  function addMezzo($mezzo, $idCorpo, $db_conn){
    $sql = "INSERT INTO t_mezzi (Descrizione, FK_CorpoVVF)
            VALUES ('$mezzo', '$idCorpo')";
    try {
      $addMezzo = mysqli_query($db_conn, $sql);
      if (!$addMezzo){
        return false;
      }
    } catch (Exception $e) {
      return false;
    }
    return true;
  }
  function addSquadra($nome, $idCorpo, $db_conn){
    $sql = "INSERT INTO t_numeroSquadre (Numero, FK_CorpoVVF)
            VALUES ('$nome', '$idCorpo')";
    try {
      $addSquadra = mysqli_query($db_conn, $sql);
      if (!$addSquadra){
        return false;
      }
    } catch (Exception $e) {
      return false;
    }
    return true;
  }
  function addVigiliToSquadra($idVigile, $idSquadra, $db_conn){
    $sql = "INSERT INTO t_squadre (FK_NumeroSquadra, FK_Vigile)
            VALUES ('$idSquadra', '$idVigile')";
    try {
      $addToSquadra = mysqli_query($db_conn, $sql);
      if (!$addToSquadra){
        return false;
      }
    } catch (Exception $e) {
      return false;
    }
    return true;
  }
  function addTurno($date, $idSquadra, $idMezzo, $db_conn){
    $sql = "INSERT INTO t_turnifestivi (dataTurno, FK_NumeroSquadra, FK_Checklist)
            VALUES ('$date', '$idSquadra', '$idMezzo')";
    try {
      $addTurni = mysqli_query($db_conn, $sql);
      if (!$addTurni){
        return false;
      }
    } catch (Exception $e) {
      return false;
    }
    return true;
  }
?>
