<?php
  @ob_start();
  session_start();
  include 'dbConnection.php';
  include 'functions.php';
  include 'getData.php';
  if (isset($_GET['id'])){
    $id = text_filter($_GET['id']);
    if (isset($_GET['data'])){
      $data = text_filter($_GET['data']);
      switch ($data) {
        case 'certificato':
          deleteCertificato($id, $db_conn);
          break;
        default:
          break;
      }
    }
  }

  function deleteCertificato($id, $db_conn){
    $corso = getCorsi($id, null, $db_conn);
    if (isset($corso['File'])){
      unlink('../uploads/'.$corso['File']);
    }
    $sql = "DELETE FROM t_certificazioni WHERE ID='$id'";
    $deleteQuery = mysqli_query($db_conn, $sql);
    if ($deleteQuery == null){
      die("error");
    }
    redirect('../dashboard.php?redirect=certificazioni&id='.$corso['FK_Vigile']);
  }



 ?>
