<?php
  // include libs 
  include 'bot/_layout.php';
  include 'app/dbConnection.php';
  include 'app/getData.php';
  include 'app/updateData.php';
  include 'bot/controller.php';
  // connections
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

  //logger($messageObj);
  $text = $messageObj['text'];

  if ($text == '/start'){
    $firemanData = getFiremanData(null, null, null, $chatID, null, null, null, $db_conn);
    if (!empty($firemanData)){
      $firemanID = $firemanData['ID'];
      updateChatID($firemanID, null, $db_conn);
    }
    sendMsg($botToken,$chatID, "Benvenuto ".$sendName.", il servizio è ancora in fase di test, per qualsiasi problema contatta @asdf1899");
    $btn = array('text' => "Autenticazione", 'request_contact'=>true);
    $btn = "[".json_encode($btn)."]";
    sendMsg($botToken,$chatID, "Per utilizzare @myCasermaVVF_bot bisogna autenticarsi tramite numero di cellulare", $btn);
  }
  if ($messageObj['contact'] != null){
    $phoneNumber = $messageObj['contact']['phone_number'];
    // remove +39
    $phoneNumber = substr($phoneNumber, 2);
    // extract fireman data from mobile number
    $firemanData = getFiremanData(null, $phoneNumber, null, null, null, null, null, $db_conn);
    if($firemanData['ID'] != null){
      sendMsg($botToken,$chatID, "Autenticazione completata");
      updateChatID($firemanData['ID'], $chatID, $db_conn);
      $vigile = getGrado($firemanData['FK_Grado'], $db_conn).": ".$firemanData['Nome']." ".$firemanData['Cognome']."\n";
      $menu =  '["Sono reperibile"], ["Mostra squadra"], ["Mostra turni"], ["Calendari"], ["Corsi"], ["Webcam"], ["I miei dati"], ["/start"]';
      sendMsg($botToken,$chatID, $vigile, $menu);
    }else{
      $btn = array('text' => "Riprova", 'request_contact'=>true);
      $btn = "[".json_encode($btn)."]";
      sendMsg($botToken,$chatID, "Vigile non trovato. Digita /start per tornare all'inizio", $btn);
      exit();
    }
  }

  $firemanData = getFiremanData(null, null, $chatID, null, null, null, $db_conn);

  if (!empty($firemanData)){
    switch ($text) {
      case 'Mostra squadra':
        $dati = printMostraSquadra($firemanData, $db_conn);
        tempFunction($botToken, $chatID);
        break;
      case 'Mostra turni':
        tempFunction($botToken, $chatID);
        break;
      case 'Calendari':
        tempFunction($botToken, $chatID);
        break;
      case 'Corsi':
        tempFunction($botToken, $chatID);
        break;
      case 'Webcam':
        tempFunction($botToken, $chatID);
        break;
      case 'I miei dati':
        $dati = printMyData($firemanData, $db_conn);
        sendMsg($botToken,$chatID, $dati, null);
        menu($botToken, $chatID);
        break;
      default:
        exit;
        break;
    }
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
