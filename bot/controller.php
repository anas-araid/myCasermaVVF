<?php
  function sendMsg($token, $chatID, $msgTxt, $button=null){
    $keyboard = "";
    if($button != null) {
      $keyboard = '&reply_markup={"keyboard":['.$button.'],"resize_keyboard":true}'; //, "one_time_keyboard":true
    }else {
      $keyboard = '&reply_markup={"remove_keyboard":true}';
    }
    $TelegramUrlSendMessage = "https://api.telegram.org/".$token."/sendMessage?chat_id=".$chatID."&text=".urlencode($msgTxt).$keyboard;
    return file_get_contents($TelegramUrlSendMessage);
  }
  function logger($MessageObj){
    $chatID = $MessageObj['chat']['id'];
    $senderName = $MessageObj['from']['first_name'];
    $senderSurname = $MessageObj['from']['last_name'];
    $senderUsername = $MessageObj['from']['username'];
    $date =  date("d-m-Y H:i:s", $timestamp);
    $line = "Connessione: ".$date."--".$chatID."-@".$senderUsername."-".$senderName." ".$senderSurname.'-';

    $filename = "log.txt";
    $filedir = "../$filename";
    if (!file_exists($filedir)){
      $log = fopen($filedir, "w");
    }else{
      $log = fopen($filedir, "a+");
    }
    fwrite($log, '$line');
    fclose($log);
  }
  function tempFunction($botToken, $chatID){
    $menu =  '["Sono reperibile"], ["Mostra squadra"], ["Mostra turni"], ["Calendari"], ["Corsi"], ["Webcam"], ["I miei dati"], ["/start"]';
    sendMsg($botToken,$chatID, 'Funzionalità non ancora disponibile', $menu);
  }
  function menu ($botToken, $chatID){
    $menu =  '["Sono reperibile"], ["Mostra squadra"], ["Mostra turni"], ["Calendari"], ["Corsi"], ["Webcam"], ["I miei dati"], ["/start"]';
    sendMsg($botToken, $chatID, 'Menu iniziale:', $menu);
  }
  function printMyData($firemanData, $db_conn){
    $grado = getGrado($firemanData['FK_Grado'], $db_conn);
    $autista = ($firemanData['Autista'] == 0) ? "No" : "Si" ;
    $dati = "Nome: ".$firemanData['Nome']."\nCognome: ".$firemanData['Cognome']."\nMatricola: ".$firemanData['Matricola']."\nGrado: ".$grado."\nAutista: ".$autista;
    return $dati;
  }
  function printMostraSquadra($firemanData, $db_conn){
    $idSquadra = getSquadraByVigili(null, $firemanData['ID'], $db_conn);
    $squadra = getSquadre($idSquadra, null, $db_conn);
    $listaIdVigili = getVigiliBySquadra(null, $idSquadra, $db_conn);
    $listaVigili = array();
    for ($i=0;$i<count($listaIdVigili);$i++){
      $vigile = getFiremanData($listaIdVigili, null, null, null, null, null, $db_conn);
      $autista = ($vigile['Autista'] == 0) ? "No" : "Si" ;
      $grado = getGrado($vigile['FK_Grado'], $db_conn);
      $listaVigili[$i] = $vigile['Nome'].' '.$vigile['Cognome'].' '.$grado.' Autista: '.$autista;
    }
    return;
  }
?>
