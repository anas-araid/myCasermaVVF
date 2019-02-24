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
  function updateCorso($ID, $filename, $db_conn){
    if (!is_numeric($ID)){
      return;
    }else{
      $set = '';
      if (isset($filename)){
        $set = "SET File='".$filename."'";
      }
      $sql = "UPDATE t_certificazioni $set WHERE (ID='$ID')";
      $updateChatID = mysqli_query($db_conn, $sql);
      if ($updateChatID==null){
        echo "Errore nell'aggiornamento del corso: contattare l'amministratore";
        return false;
      }
      return true;
    }
    return false;
  }

?>
