<?php
  // include libs 
  include 'bot/_layout.php';
  include 'app/dbConnection.php';
  include 'app/models/getData.php';
  include 'app/models/updateData.php';
  include 'bot/controller.php';
  // connections
  $botToken = getApiToken("api.key");
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
    // primo accesso, controllo se l'account ha già fatto l'accesso in passato
    $firemanData = getFiremanData(null, null, $chatID, null, null, null, $db_conn);
    // se $firemanData è vuota allora aggiorno i dati con chatID nuovo
    if (!empty($firemanData)){
      $firemanID = $firemanData['ID'];
      $update = updateChatID($firemanID, null, $db_conn);
    }
    sendMsg($botToken,$chatID, "Benvenuto ".$sendName.", il servizio è ancora in fase di test, per qualsiasi problema contatta @asdf1899");
    $btn = array('text' => "Autenticazione", 'request_contact'=>true);
    $btn = "[".json_encode($btn)."]";
    sendMsg($botToken,$chatID, "Per utilizzare @myCasermaVVF_bot bisogna autenticarsi tramite numero di cellulare", $btn);
  }
  if ($messageObj['contact'] != null){
    // se il contatto non viene inviato da myCasermaVVF allora non è sicro
    // controllo se replay_to_message è impostato
    if (!empty($messageObj['reply_to_message'])){
      // se il messaggio è riferito al bot e la user_id è impostata allora è affidabile
      if($messageObj['reply_to_message']['from']['is_bot'] && isset($messageObj['contact']['user_id']) ){
        $phoneNumber = $messageObj['contact']['phone_number'];
        // remove +39
        $phoneNumber = substr($phoneNumber, 2);
        // extract fireman data from mobile number
        $firemanData = getFiremanData(null, $phoneNumber, null, null, null, null, $db_conn);
        // cerco nel db a chi è associato il numero di telefono
        if($firemanData['ID'] != null){
          sendMsg($botToken,$chatID, "Autenticazione completata");
          updateChatID($firemanData['ID'], $chatID, $db_conn);
          $dati = printMyData($firemanData, $db_conn);
          sendMsg($botToken,$chatID, $dati, null);
          menu($botToken, $chatID, $firemanData);
        }else{
          $btn = array('text' => "Riprova", 'request_contact'=>true);
          $btn = "[".json_encode($btn)."]";
          sendMsg($botToken,$chatID, "Vigile non trovato. Digita /start per tornare all'inizio", $btn);
          exit();
        }
      }else{
        // se non viene dal bot chiedo di premere riprova
        $btn = array('text' => "Riprova", 'request_contact'=>true);
        $btn = "[".json_encode($btn)."]";
        sendMsg($botToken,$chatID, "Contatto non riconosciuto premere su 'Riprova'", $btn);
        exit();
      }
    }else{
      // se non viene dal bot chiedo di premere riprova
      $btn = array('text' => "Riprova", 'request_contact'=>true);
      $btn = "[".json_encode($btn)."]";
      sendMsg($botToken,$chatID, "Contatto non riconosciuto premere su 'Riprova'", $btn);
      exit();
    }
  }


  $firemanData = getFiremanData(null, null, $chatID, null, null, null, $db_conn);
  $FK_CorpoVVF = $firemanData['FK_CorpoVVF'];
  if (!empty($firemanData)){
    switch ($text) {
      case "Sono reperibile":
        // changeReperibilita ritorna true se è andato a buon fine
        $status = changeReperibilita($firemanData, $db_conn);
        $dati = ($status) ? "Reperibilità aggiornata con successo.\n" : "Errore nell'aggiornamento della reperibilità: contattare l'amministratore\n";
        sendMsg($botToken,$chatID, $dati);
        // richiedo $firemanData aggiornato
        $firemanData = getFiremanData(null, null, $chatID, null, null, null, $db_conn); 
        menu($botToken, $chatID, $firemanData);
        break;
      case "Non sono più reperibile":
        // changeReperibilita ritorna true se è andato a buon fine
        $status = changeReperibilita($firemanData, $db_conn);
        $dati = ($status) ? "Reperibilità aggiornata con successo.\n" : "Errore nell'aggiornamento della reperibilità: contattare l'amministratore\n";
        sendMsg($botToken,$chatID, $dati);
        // richiedo $firemanData aggiornato       
        $firemanData = getFiremanData(null, null, $chatID, null, null, null, $db_conn);         
        menu($botToken, $chatID, $firemanData);
        break;
      case "Mostra reperibili":
        $dati = printReperibili($FK_CorpoVVF, $db_conn);
        // se printReperibili() è false, vuol dire che non ci sono reperibili 
        if (!$dati){
          $dati = 'Nessun vigile disponibile';
        }
        sendMsg($botToken,$chatID, $dati);
        menu($botToken, $chatID, $firemanData);
        break;
      case 'La mia squadra':
        $dati = printMostraSquadra($firemanData, $db_conn);
        // se printMostraSquadra() è false, vuol dire che non ci sono squadre associate al vigile         
        if (!$dati){
          $dati = 'Vigile associato a nessuna squadra'."\n \n"."Contatta il responsabile per aggiungerti ad una squadra tramite il gestionale myCasermaVVF";
        }
        sendMsg($botToken,$chatID, $dati);
        menu($botToken, $chatID, $firemanData);
        break;
      case 'Questo weekend':
        $dati = printMostraSquadraWeekend($FK_CorpoVVF, $db_conn);
        // se printMostraSquadraWeekend() è false, vuol dire che non ci sono squadre associate al vigile         
        if (!$dati){
          $dati = 'Nessuna squadra disponibile questo weekend';
        }
        sendMsg($botToken,$chatID, $dati);
        menu($botToken, $chatID, $firemanData);
        break;
      case 'I miei turni':
        // se printTurni() è false, vuoldire che non ci sono turni associati al db
        $dati = printTurni($firemanData, $db_conn);
        if (!$dati){
          $dati = 'Nessun turno disponibile'."\n \n"."Contatta il responsabile per aggiungere i turni tramite il gestionale myCasermaVVF";
        }
        sendMsg($botToken,$chatID, $dati);
        menu($botToken, $chatID, $firemanData);
        break;
      case 'I miei corsi':
        $dati = printCorsi($firemanData, $db_conn);
        if (!$dati){
          $dati = "Nessun corso disponibile \n";
        }
        sendMsg($botToken,$chatID, $dati);
        menu($botToken, $chatID, $firemanData);
        break;
      case 'Webcam':
        webCamMenu($botToken, $chatID);
        break;
      case 'Meteo trentino':
       sendAudio($botToken, $chatID, 'http://m.viaggiareintrentino.it/var/vit/storage/video/meteotrentino-notiziar.mp3');
        break;
      case 'I miei dati':
        $dati = printMyData($firemanData, $db_conn);
        sendMsg($botToken,$chatID, $dati, null);
        menu($botToken, $chatID, $firemanData);
        break;
      case '/menu':
        menu($botToken, $chatID, $firemanData);
        break;
      default:
        // controllo se dentro $text (testo che viene mandato al bot) se contiene /webcam
        // /webcam NomeStrada
        if (strpos($text, 'webcam') != false){
          // getWebcamList --> legge la configurazione in webcam.json 
          // crea il formato del menu con le strade all'interno del file
          $menu = getWebcamList('bot/webcam.json', $text);
          if ($menu != false){
            sendMsg($botToken,$chatID, 'Webcam disponibili', $menu);
          }else{
            sendMsg($botToken,$chatID, 'Webcam non disponibili');
            menu($botToken, $chatID, $firemanData);
          }
        }else if (strpos($text, 'cam') != false){
          // getWebcamUrl --> restituisce l'url della webcam in base alla località
          $url = getWebcamUrl('bot/webcam.json', $text);
          if ($url != false){
            // getFile scarica l'immagine e la salva temporaneamente sul server
            $filename = getFile($url);
            // getFileUrl restituisce l'url dell'immagine temporanea
            $newUrl = getFileUrl($filename);
            // invio la photo all'utente
            sendPhoto($botToken,$chatID, $newUrl);
            // sleep
            // rimuovo l'immagine temporanea della webcam
            removePhoto($filename);
          }else{
            sendMsg($botToken,$chatID, 'Webcam non disponibili');
            menu($botToken, $chatID, $firemanData);
          }
        }
        exit;
        break;
    }
  }
?>
