<?php

  function sendMsg($token, $chatID, $msgTxt, $button=null){
    $keyboard = "";
    if($button != null) {
      $keyboard = '&reply_markup={"keyboard":['.$button.'],"resize_keyboard":true}'; //, "one_time_keyboard":true
    }/*else {
      $keyboard = '&reply_markup={"remove_keyboard":true}';
    }*/
    $TelegramUrlSendMessage = "https://api.telegram.org/".$token."/sendMessage?chat_id=".$chatID."&text=".urlencode($msgTxt).$keyboard."&parse_mode=html&disable_web_page_preview=true";
    return file_get_contents($TelegramUrlSendMessage);
  }
  function sendDocuments($chatID, $file){
    $botToken = "bot"."712299362:AAF5hmPddEfZNc0giZMLscjfQiQVi1y4UyE";
    $server = $_SERVER['SERVER_NAME'];
    $dir = "https://$server/php/myCasermaVVF/uploads/".$file;
    $doc = "https://api.telegram.org/".$botToken."/sendDocument?chat_id=".$chatID."&document=".$dir;
    return file_get_contents($doc);
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
    $menu =  '["Mostra reperibili"], ["La mia squadra"], ["Questo weekend"], ["I miei turni"], ["I miei corsi"], ["Calendari"], ["I miei dati"], ["/start"]';
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
    $menu =  '["Mostra reperibili"], ["La mia squadra"], ["Questo weekend"], ["I miei turni"], ["I miei corsi"], ["Calendari"], ["I miei dati"], ["/start"]';
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
  function mostraSquadra($idSquadra, $db_conn){
    if (!empty($idSquadra)){
      $squadra = getSquadre($idSquadra, null, $db_conn);
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
  function printMostraSquadra($firemanData, $db_conn){
    $idSquadra = getSquadraByVigili(null, $firemanData['ID'], $db_conn);
    return mostraSquadra($idSquadra[1], $db_conn);
  }
  /*function isWeekend($date) {
    $weekDay = date('w', strtotime($date));
    return ($weekDay == 0 || $weekDay == 6);
  }*/
  function printMostraSquadraWeekend($FK_CorpoVVF, $db_conn){
     /*if (isWeekend($currentDate)){
      echo 'Weekend: '.$currentDate;
    }else{
      $saturday = strtotime("next Saturday");
      $sunday = strtotime("next Sunday");
    }
    echo 'Domenica '.date('d-m-Y', $sunday);*/
    $currentDate = date('d/m/Y');
    $saturday = strtotime("next Saturday");
    $sunday = strtotime("next Sunday");
    $turni = getTurnoByDate(date('Y/m/d', $saturday), $FK_CorpoVVF, $db_conn);
    print_r($turni);
    if (!empty($turni)){
      $dati = "Questo weekend è disponibile la seguente squadra: \n\n";
      $dati .= mostraSquadra($turni[0][2], $db_conn);
      $dati .="\n\n<b>TURNI:</b> \n";
      for ($i=0;$i<count($turni);$i++){
        $currentShift = $turni[$i];
        $dati .="______________________________________________\n\n";
        $date = date('d-m-Y', strtotime($currentShift[1]));
        $dati .= "<i>Data:</i><b> $date </b>\n";
        $mezzo = getMezzi($currentShift[3], null, $db_conn);
        if (!empty($mezzo)){
          $dati .= "<i>Checklist:</i> <b>$mezzo</b>\n";
        }else{
          $dati .= "<i>Checklist: Nessun Mezzo</i>\n";        
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
  function printTurni($firemanData, $db_conn){
    $numSquadra = getSquadraByVigili(null, $firemanData['ID'], $db_conn)[1];
    $idSquadra = getSquadre($numSquadra, null, $db_conn)['ID'];
    $turni = getTurni(null, $idSquadra, $db_conn);
    if (!empty($turni)){
      $dati ="<b>TURNI:</b> \n";
      for ($i=0;$i<count($turni);$i++){
        $currentShift = $turni[$i];
        $dati .="______________________________________________\n\n";
        $date = date('d-m-Y', strtotime($currentShift[1]));
        $dati .= "<i>Data:</i><b> $date </b>\n";
        $mezzo = getMezzi($currentShift[3], null, $db_conn);
        if (!empty($mezzo)){
          $dati .= "<i>Checklist:</i> <b>$mezzo</b>\n";
        }else{
          $dati .= "<i>Checklist: Nessun Mezzo</i>\n";        
        }
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
  function getApiToken($file){
    return file_get_contents($file);
  }
  function printCorsi($firemanData, $db_conn){
    $corsi = getCorsi(null, $firemanData['ID'], $db_conn);
    if (!empty($corsi)){
      $dati ="<b>I MIEI CORSI:</b> \n";
      for ($i=0; $i < count($corsi); $i++){
        $dati .="______________________________________________\n\n";
        $nomeCorso = $corsi[$i][1];
        $file = $corsi[$i][2];
        $dati .= "<b>".$nomeCorso."</b>\n";
        if (isset($file)){
          $server = $_SERVER['SERVER_NAME'];
          $dir = "https://$server/php/myCasermaVVF/uploads/".$corsi[$i][2];
          $dati .= "File: <a href='$dir'>Apri documento</a> "."\n";
          //sendDocuments($firemanData['Chat_ID'], $file);
        }

      }
      $dati .="______________________________________________\n";
      return $dati;
    }else{
      return false;
    }
  }
?>
