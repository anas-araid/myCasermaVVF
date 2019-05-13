<?php
  @ob_start();
  session_start();
  include '../dbConnection.php';
  include '../functions.php';
  
  if (isset($_POST['submit']) and isset($_POST['find'])){
    $keyword = text_filter($_POST['find']);
    $find = text_filter($_POST['submit']);
    switch($find){
      case 'vigili':
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