<?php
  include 'core/functions.php';
  $botToken = "bot"."712299362:AAF5hmPddEfZNc0giZMLscjfQiQVi1y4UyE";
  $rawInput = file_get_contents("php://input");
  $update = json_decode($rawInput, TRUE);
  if(!$update)
  {
    exit;
  }
  //Recuperiamo l'oggetto message dal json
  $messageObj = $update['message'];
  //Recuperiamo il chatId, che utilizzeremo per rispondere all'utente che ci ha appena invocato
  $chatID = $messageObj['chat']['id'];
  $sendName = $messageObj['from']['first_name'];
  $sendSurname = $messageObj['from']['last_name'];

  logger($messageObj);
  $text = $messageObj['text'];
  if ($text == '/start'){
    sendMsg($botToken,$chatID, "Benvenuto ".$sendName." se hai qualche problema con il servizio, contatta @asdf1899");
    $buttonsCaserme = '["Btn 1" , "Btn 2"],["Test"],["Inviami"]';
    sendMsg($botToken,$chatID, "Seleziona la tua caserma", $buttonsCaserme);
  }

?>
