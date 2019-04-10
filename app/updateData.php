<?php

  function updateChatID($ID, $chatID, $db_conn){
    if (!is_numeric($ID)){
      return;
    }else{
      $sql = "UPDATE t_vigili SET Chat_ID='$chatID' WHERE (ID='$ID')";
      $updateChatID = mysqli_query($db_conn, $sql);
      if ($updateChatID==null){
        echo "Errore nell'aggiornamento del chatID: contattare l'amministratore";
      }
    }
  }
  function updateCertificazione($ID, $filename, $db_conn){
    if (!is_numeric($ID)){
      return;
    }else{
      $set = '';
      if (isset($filename)){
        $set = "SET File='".$filename."'";
      }
      $sql = "UPDATE t_certificazioni $set WHERE (ID='$ID')";
      $updateCertificazione = mysqli_query($db_conn, $sql);
      if ($updateCertificazione==null){
        echo "Errore nell'aggiornamento del corso: contattare l'amministratore";
        return false;
      }
      return true;
    }
    return false;
  }
  function updateFireman($ID, $nome, $cognome, $matricola, $cellulare, $idGrado, $idCorpo, $autista, $reperibile, $db_conn){
    if (!is_numeric($ID)){
      return;
    }else{
      $sql = "UPDATE t_vigili SET Nome='$nome', Cognome='$cognome', Matricola='$matricola', Cellulare='$cellulare', FK_Grado='$idGrado', Autista='$autista', Reperibile='$reperibile'
              WHERE ID='$ID'";
      $updateFireman = mysqli_query($db_conn, $sql);
      if ($updateFireman==null){
        echo "Errore nell'aggiornamento del vigile: contattare l'amministratore";
        return false;
      }
    }
    return true;
  }
  function updateSquadra($ID, $nome, $idCorpo, $db_conn){
    if (!is_numeric($ID)){
      return;
    }else{
      $sql = "UPDATE t_numeroSquadre SET Numero='$nome'
              WHERE ID='$ID'";
      $updateFireman = mysqli_query($db_conn, $sql);
      if ($updateFireman==null){
        echo "Errore nell'aggiornamento della squadra: contattare l'amministratore";
        return false;
      }
    }
    return true;
  }
  function updateReperibilita($ID, $reperibile, $db_conn){
    if (!is_numeric($ID)){
      return;
    }else{
      $sql = "UPDATE t_vigili SET Reperibile='$reperibile'
              WHERE ID='$ID'";
      $updateFireman = mysqli_query($db_conn, $sql);
      if ($updateFireman==null){
        echo "Errore nell'aggiornamento della reperibilità (updateReperibilita() in updateData.php): contattare l'amministratore";
        return false;
      }
    }
    return true;
  }
  function updateCorpo($id, $caserma, $email, $telefono, $db_conn){
    if (!is_numeric($id)){
      return;
    }else{
      $sql = "UPDATE t_caserme SET Descrizione='$caserma', Telefono='$telefono', Email='$email'
              WHERE ID='$id'";
      $updateFireman = mysqli_query($db_conn, $sql);
      if ($updateFireman==null){
        echo "Errore nell'aggiornamento della caserma (updateCorpo() in updateData.php): contattare l'amministratore";
        return false;
      }
    }
    return true;
  }
?>
