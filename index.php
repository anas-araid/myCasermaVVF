<?php
  include 'core/functions.php';
  $botToken = "bot"."712299362:AAF5hmPddEfZNc0giZMLscjfQiQVi1y4UyE";
  $rawInput = file_get_contents("php://input");
  $update = json_decode($rawInput, TRUE);
  print_r($update);
  if(!$update)
  {
    exit;
  }
  //Recuperiamo l'oggetto message dal json
  $MessageObj = $update['message'];
  //Recuperiamo il chatId, che utilizzeremo per rispondere all'utente che ci ha appena invocato
  $chatID = $MessageObj['chat']['id'];
  $sendName = $MessageObj['from']['first_name'];
  $sendSurname = $MessageObj['from']['last_name'];
  echo "Telegram: ".$chatID;
  //Rispondiamo HelloWorld
  $out = sendMsg($botToken,$chatID, "Ciao ".$sendName);


?>
