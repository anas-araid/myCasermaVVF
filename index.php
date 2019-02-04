<?php
  include 'core/dbConnection.php';
  include 'core/getData.php';
  include 'core/functions.php';
  $botToken = "bot"."712299362:AAF5hmPddEfZNc0giZMLscjfQiQVi1y4UyE";
  $rawInput = file_get_contents("php://input");
  $update = json_decode($rawInput, TRUE);
  $test = getFiremanData(null, '3485588835', $db_conn);
  print_r($test);
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

  //logger($messageObj);
  $text = $messageObj['text'];
  if ($messageObj['contact'] != null){
    $phoneNumber = $messageObj['contact']['phone_number'];
    $phoneNumber = substr($phoneNumber, 2);
    $firemanData = getFiremanData(null, $phoneNumber, $db_conn);
    if($firemanData['ID'] != null){
      sendMsg($botToken,$chatID, "Ciao ".$firemanData['Nome']." ".$firemanData['Cognome']);
    }else{
      $btn = array('text' => "Riprova", 'request_contact'=>true);
      sendMsg($botToken,$chatID, "Vigile non trovato.", $btn);
      exit();
    }
  }
  
  switch ($text) {
    case '/start':
      sendMsg($botToken,$chatID, "Benvenuto ".$sendName.", se hai qualche problema con il servizio, contatta @asdf1899");
      $btn = array('text' => "Autenticazione", 'request_contact'=>true);
      sendMsg($botToken,$chatID, "Per utilizzare @myCasermaVVF bisogna autenticarsi tramite numero di cellulare", "[".json_encode($btn)."]");
      break;
    /*case strpos($text, "/caserma"):
      $corpoVVF = str_replace('/caserma ', '', $text);
      $corpoVVF = getCaserma(null, $corpoVVF, $db_conn);
      sendMsg($botToken,$chatID, "Ora inserisci la password del corpo ".$corpoVVF['Descrizione']);
      break;*/
    default:
      exit;
      break;
  }

  //$buttonsCaserme = '["Btn 1" , "Btn 2"],["Test"],["Inviami"]';
  /*$buttonCaserme = getCaserma(null, null, $db_conn);


  //$btn= '["'.$buttonCaserme[0][1].'"]';
  $btn = '';
  for ($i=0;$i< count($buttonCaserme); $i++){
    $btn .= '[" /caserma '.$buttonCaserme[$i][1].'"]';
  }
  sendMsg($botToken,$chatID, "Seleziona corpo di appartenenza:", $btn);*/

?>
