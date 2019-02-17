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

?>