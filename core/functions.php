<?php

  function sendMsg($token, $chatID, $msgTxt){
    $TelegramUrlSendMessage = "https://api.telegram.org/".$token."/sendMessage?chat_id=".$chatID."&text=".urlencode($msgTxt);
    return file_get_contents($TelegramUrlSendMessage);
  }
 ?>
