<?php

  function sendMsg($token, $chatID, $msgTxt, $button=null){
    $keyboard = "";
    if($button != null) {
      $keyboard = '&reply_markup={"keyboard":['.$button.'],"resize_keyboard":true}'; //, "one_time_keyboard":true
    }/*else {
      $keyboard = '&reply_markup={"remove_keyboard":true}';
    }*/
    $sendMsg = "https://api.telegram.org/".$token."/sendMessage?chat_id=".$chatID."&text=".urlencode($msgTxt).$keyboard."&parse_mode=html&disable_web_page_preview=true";
    return file_get_contents($sendMsg);
  }
  function sendPhoto($botToken, $chatID, $url){
    $sendPhoto = "https://api.telegram.org/".$botToken."/sendPhoto?chat_id=".$chatID."&photo=".$url;
    return file_get_contents($sendPhoto);
  }
  function sendAudio($botToken, $chatID, $url){
    $sendAudio = "https://api.telegram.org/".$botToken."/sendAudio?chat_id=".$chatID."&audio=".$url;
    return file_get_contents($sendAudio);
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
    $menu =  '["Mostra_reperibili"],["La_mia_squadra"],["Questo_weekend"],["I_miei_turni"],["I_miei_corsi"],["Webcam"],["Meteo_trentino"],["I_miei_dati"],["/start"]';
    $stato = '';
    if (!$firemanData['Reperibile']){
      $menu = '["Sono_reperibile"],'.$menu;
      $stato = 'non sono reperibile';
    }else{
      $menu = '["Non_sono_più_reperibile"],'.$menu;
      $stato = 'sono reperibile';
    }
    sendMsg($botToken,$chatID, 'Funzionalità non ancora disponibile', $menu);
  }

  function menu ($botToken, $chatID, $firemanData){
    $menu =  '["Mostra_reperibili"],["La_mia_squadra"],["Questo_weekend"],["I_miei_turni"],["I_miei_corsi"],["Webcam"],["Meteo_trentino"],["I_miei_dati"],["/start"]';
    $stato = '';
    if (!$firemanData['Reperibile']){
      $menu = '["Sono_reperibile"],'.$menu;
      $stato = 'non sono reperibile';
    }else{
      $menu = '["Non_sono_più_reperibile"],'.$menu;
      $stato = 'sono reperibile';
    }
    sendMsg($botToken, $chatID, 'STATO: '.$stato, $menu);
  }
  function webCamMenu($botToken, $chatID){
    $menu =  '["/webcam_SS47"],["/webcam_SS12"],["/webcam_SS43"],["/webcam_SP235"],["/webcam_SS240"],["/webcam_SP79"],["/menu"],["/start"]';
    sendMsg($botToken,$chatID, 'Webcam disponibili solo nel territorio Trentino');
    sendMsg($botToken,$chatID, 'Seleziona il tratto stradale', $menu);
  }
  function menuParser($array){
    $menu = '';
    for ($i=0;$i<count($array);$i++){
      $menu .= '["/cam_'.$array[$i].'"],';
    }
    $menu .= '["Webcam","/menu"]';
    return $menu;
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
        $dati.="__________________________\n\n";
        $vigile = getFiremanData($listaIdVigili[$i], null, null, null, null, null, $db_conn);
        $autista = ($vigile['Autista'] == 1) ? "autista" : "" ;
        $grado = getGrado($vigile['FK_Grado'], $db_conn);
        $dati .= "<i>".$grado.' '.$autista.': </i><b>'.$vigile['Nome'].' '.$vigile['Cognome'].'</b>'."\n";
        // se nel db il vigile ha impostato il num cell allora lo mostra
        if (isset($vigile['Cellulare'])){
          $dati .= '<i>Cell:</i> '.$vigile['Cellulare']."\n";
        }
      }
      $dati.="__________________________\n\n";
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
  /*if (isWeekend($currentDate)){
      echo 'Weekend: '.$currentDate;
    }else{
      $saturday = strtotime("next Saturday");
      $sunday = strtotime("next Sunday");
    }
    echo 'Domenica '.date('d-m-Y', $sunday);*/
  function printMostraSquadraWeekend($FK_CorpoVVF, $db_conn, $botToken, $chatID){
    $dati = false;
    $currentDate = date('d/m/Y');
    $weekend = array(strtotime("next Saturday"), strtotime("next Sunday"));
    for ($j=0;$j<count($weekend);$j++){
      // restituisce i turni riferiti al prossimo weekend
      $turni = getTurnoByDate(date('Y-m-d', $weekend[$j]), $FK_CorpoVVF, $db_conn);
      if (!empty($turni)){
        if ($j==0){
          $dati .= "Questo weekend è disponibile la seguente squadra: \n\n";
          $dati .= mostraSquadra($turni[0][2], $db_conn);
          $dati .="\n\n<b>TURNI:</b> \n";
        }
        for ($i=0;$i<count($turni);$i++){
          $currentShift = $turni[$i];
          $dati .="__________________________\n\n";
          $date = date('d-m-Y', strtotime($currentShift[1]));
          $dati .= "<i>Data:</i><b> $date </b>\n";
          $mezzo = getMezzi($currentShift[3], null, $db_conn);
          if (!empty($mezzo)){
            $dati .= "<i>Checklist:</i> <b>$mezzo</b>\n";
          }else{
            $dati .= "<i>Checklist: Nessun Mezzo</i>\n";
          }
        }
        $dati.="__________________________\n\n";
      }
    }
    return $dati;
  }
  function printReperibili($FK_CorpoVVF, $db_conn){
    $reperibili = getReperibili($FK_CorpoVVF, true, $db_conn);
    if (!empty($reperibili)){
      $dati = "<b>VIGILI DISPONIBILI:</b> \n";
      for ($i=0;$i<count($reperibili);$i++){
        $dati.="__________________________\n\n";
        $fireman = getFiremanData($reperibili[$i][0], null, null, null, null, null, $db_conn);
        $autista = ($fireman['Autista'] == 1) ? "autista" : "" ;
        $grado = getGrado($fireman['FK_Grado'], $db_conn);
        $dati .= '<i>'.$grado.' '.$autista.': </i><b>'.$fireman['Nome'].' '.$fireman['Cognome']."</b> \n";
        $dati .= '<i>Cell:</i> '.$fireman['Cellulare']."\n";
      }
      $dati.="__________________________\n\n";
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
        $dati .="__________________________\n\n";
        $date = date('d-m-Y', strtotime($currentShift[1]));
        $dati .= "<i>Data:</i><b> $date </b>\n";
        $mezzo = getMezzi($currentShift[3], null, $db_conn);
        if (!empty($mezzo)){
          $dati .= "<i>Checklist:</i> <b>$mezzo</b>\n";
        }else{
          $dati .= "<i>Checklist: Nessun Mezzo</i>\n";
        }
      }
      $dati.="__________________________\n\n";
    }else{
      $dati = false;
    }
    return $dati;
  }
  function changeReperibilita($firemanData, $db_conn){
    $firemanID = $firemanData['ID'];
    $currentReperibilita = $firemanData['Reperibile'];
    if ($currentReperibilita == 0){
      $newReperibilita = 1;
    }else{
      $newReperibilita = 0;
    }
    return updateReperibilita($firemanID, $newReperibilita, $db_conn);
  }
  function getApiToken($file){
    return file_get_contents($file);
  }
  function getWebcamJson($file){
    return file_get_contents($file);
  }
  function getWebcamUrlByLocation($json, $location){
    foreach ($json as $road){
      for ($i=0;$i<count($road);$i++){
        if ($road[$i]['nome'] == $location){
          return $road[$i]['url'];
        }
      }
    }
    return false;
  }
  function printCorsi($firemanData, $db_conn){
    $corsi = getCorsi(null, $firemanData['ID'], $db_conn);
    if (!empty($corsi)){
      $dati ="<b>I MIEI CORSI:</b> \n";
      for ($i=0; $i < count($corsi); $i++){
        $dati .="__________________________\n\n";
        $nomeCorso = $corsi[$i][1];
        $file = $corsi[$i][2];
        $dati .= "<b>".$nomeCorso."</b>\n";
        if (isset($file)){
          $server = $_SERVER['SERVER_NAME'];
          $pdfName = str_replace(' ', '_', $nomeCorso).'_'.$firemanData['Nome'].'_'.$firemanData['Cognome'];
          $fileEncrypt = encrypt_decrypt('encrypt', $file);
          if ($fileEncrypt == '' or $fileEncrypt == null or !isset($fileEncrypt)){
            $fileEncrypt = $file;
          }
          $dir = "https://$server/app/controllers/downloadFile.php?file=$fileEncrypt&name=$pdfName";
          //$dir = "https://$server/uploads/".$corsi[$i][2];
          $dati .= "File: <a href='$dir'>Scarica documento</a> "."\n";
          //sendDocuments($firemanData['Chat_ID'], $file);
        }
      }
      $dati .="__________________________\n";
      return $dati;
    }else{
      return false;
    }
  }
  function getWebCamList($configFile, $text){
    $json = getWebcamJson($configFile);
    if ($json != false){
      $webcamData = json_decode($json, true);
      // $strada è il NomeStrada dopo /webcam tipo SS47 ecc.
      $strada = substr($text, strpos($text, "_") + 1);
      // $stradaSelezionata --> [0] => Array ([nome]=>'Pergine', [url]=>'http..')
      $stradaSelezionata = $webcamData[$strada];
      if ($stradaSelezionata != null){
        // $località è un array con all'interno tutte le località relative a $stradaSelezionata
        $localita = array();
        for ($i=0;$i<count($stradaSelezionata);$i++){
          $localita[$i] = $stradaSelezionata[$i]['nome'];
        }
        // menuParser sistema i dati in modo da essere letto dall'api di telegram
        $menu = menuParser($localita);
        return $menu;
      }
    }
    return false;
  }
  function getWebcamUrl($configFile, $text){
    // legge il file di configurazione delle webcam
    $json = getWebcamJson($configFile);
    if ($json != false){
      $webcamData = json_decode($json, true);
      $localita = substr($text, strpos($text, "_") + 1);
      // restituisce l'immagine della webcam relativa alla localita
      $url = getWebcamUrlByLocation($webcamData, $localita);
      if ($url != false){
        return $url;
      }
    }
    return false;
  }
  function getFile($url, $botToken, $chatID){
    // il nome del file è il timestamp_nomeFileUrl
    $name = time().'_'.basename($url);
    $file = 'uploads/temp/'.$name;
    // file_get_contents restituisce il contenuto del file nell'url
    // file_put_contents salva il file nella directory
    $save = file_put_contents($file, file_get_contents($url));
    if ($save == false){
      return false;
    }else{
      return $file;
    }
  }
  function getFileUrl($dir){
    // $server contiene il nome del dominio
    $server = $_SERVER['SERVER_NAME'];
    // url temporaneo su xampp
    $url = "https://$server/".$dir;
    return $url;
  }
  function removeFile($fileDir){
    if (file_exists($fileDir)) {
      unlink($fileDir);
    }
  }
?>
