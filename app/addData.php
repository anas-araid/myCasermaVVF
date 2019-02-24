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
  function addFireman($nome, $cognome, $cellulare, $matricola, $idGrado, $idCorpo, $db_conn){
    $sql = "INSERT INTO t_vigili (Nome, Cognome, Matricola, Cellulare, Chat_ID, FK_Grado, FK_CorpoVVF)
            VALUES ('$nome', '$cognome', '$matricola', '$cellulare', null, '$idGrado', '$idCorpo')";
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
?>
