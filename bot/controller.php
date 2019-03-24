<?php
  function sendMsg($token, $chatID, $msgTxt, $button=null){
    $keyboard = "";
    if($button != null) {
      $keyboard = '&reply_markup={"keyboard":['.$button.'],"resize_keyboard":true}'; //, "one_time_keyboard":true
    }else {
      $keyboard = '&reply_markup={"remove_keyboard":true}';
    }
    $TelegramUrlSendMessage = "https://api.telegram.org/".$token."/sendMessage?chat_id=".$chatID."&text=".urlencode($msgTxt).$keyboard."&parse_mode=html";
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
  function tempFunction($botToken, $chatID, $firemanData){
    $menu =  '["Mostra reperibili"], ["Mostra squadra"], ["Mostra turni"], ["I miei corsi"], ["Calendari"], ["I miei dati"], ["/start"]';
    if (!$firemanData['Reperibile']){
      $menu = '["Sono reperibile"], '.$menu;
      $stato = 'non sono reperibile';
    }else{
      $menu = '["Non sono più reperibile"], '.$menu;
      $stato = 'sono reperibile';
    }
    sendMsg($botToken,$chatID, 'Funzionalità non ancora disponibile', $menu);
  }
  function menu ($botToken, $chatID, $firemanData){
    $menu =  '["Mostra reperibili"], ["Mostra squadra"], ["Mostra turni"], ["I miei corsi"], ["Calendari"], ["I miei dati"], ["/start"]';
    $stato = '';
    if (!$firemanData['Reperibile']){
      $menu = '["Sono reperibile"], '.$menu;
      $stato = 'non sono reperibile';
    }else{
      $menu = '["Non sono più reperibile"], '.$menu;
      $stato = 'sono reperibile';
    }
    sendMsg($botToken, $chatID, 'STATO: '.$stato, $menu);
  }
  function printMyData($firemanData, $db_conn){
    $grado = getGrado($firemanData['FK_Grado'], $db_conn);
    $autista = ($firemanData['Autista']) ? "Si" : "No" ;
    $reperibile = ($firemanData['Reperibile']) ? "Si" : "No" ;;
    $dati = "Nome: ".$firemanData['Nome']."\nCognome: ".$firemanData['Cognome']."\nMatricola: ".$firemanData['Matricola']."\nGrado: ".$grado."\nAutista: ".$autista."\nReperibile: ".$reperibile;
    return $dati;
  }
  function printMostraSquadra($firemanData, $db_conn){
    $idSquadra = getSquadraByVigili(null, $firemanData['ID'], $db_conn);
    if (!empty($idSquadra)){
      $squadra = getSquadre($idSquadra[1], null, $db_conn);
      $listaIdVigili = getVigiliBySquadra(null, $squadra['ID'], $db_conn);
      $dati = '<b>SQUADRA: '.$squadra['Numero']."</b>\n";
      for ($i=0;$i<count($listaIdVigili);$i++){
        $dati.="______________________________________________\n\n";
        $vigile = getFiremanData($listaIdVigili[$i], null, null, null, null, null, $db_conn);
        $autista = ($vigile['Autista'] == 1) ? "autista" : "" ;
        $grado = getGrado($vigile['FK_Grado'], $db_conn);
        $dati .= "<i>".$grado.' '.$autista.': </i><b>'.$vigile['Nome'].' '.$vigile['Cognome'].'</b>'."\n";
        // se nel db il vigile ha impostato il num cell allora lo mostra
        if (isset($vigile['Cellulare'])){
          $dati .= '<i>Cell:</i> '.$vigile['Cellulare']."\n";
        }
      }
      $dati.="______________________________________________\n\n";
    }else{
      $dati = false;
    }
    return $dati;
  }
  function printReperibili($FK_CorpoVVF, $db_conn){
    $reperibili = getReperibili($FK_CorpoVVF, true, $db_conn);
    if (!empty($reperibili)){
      $dati = "<b>VIGILI DISPONIBILI:</b> \n";
      for ($i=0;$i<count($reperibili);$i++){
        $dati.="______________________________________________\n\n";
        $fireman = getFiremanData($reperibili[$i][0], null, null, null, null, null, $db_conn);
        $autista = ($fireman['Autista'] == 1) ? "autista" : "" ;
        $grado = getGrado($fireman['FK_Grado'], $db_conn);
        $dati .= '<i>'.$grado.' '.$autista.': </i><b>'.$fireman['Nome'].' '.$fireman['Cognome']."</b> \n";
        $dati .= '<i>Cell:</i> '.$fireman['Cellulare']."\n";
      }
      $dati.="______________________________________________\n\n";
    }else{
      $dati = false;
    }
    return $dati;
  }
  function changeReperibilita($firemanData, $db_conn){
    $firemanID = $firemanData['ID'];
    $currentReperibilita = $firemanData['Reperibile'];
    $newReperibilita = !$currentReperibilita;
    return updateReperibilita($firemanID, $newReperibilita, $db_conn);
  }
?>
