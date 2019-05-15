<?php
  @ob_start();
  session_start();
  include '../dbConnection.php';
  include '../functions.php';
  include '../models/getData.php';
  
  if (isset($_POST['submit']) and isset($_POST['find'])){
    $keyword = text_filter($_POST['find']);
    $type = text_filter($_POST['submit']);
    switch($type){
      case 'vigili':
        $firemenID = getFiremanByKeyword($keyword, $_SESSION['ID'], $db_conn);
        print_r($firemenID);
        break;
      case 'mezzi':
        break;
      case 'attrezzature':
        break;
      default:
        break;
    }
  }
?>