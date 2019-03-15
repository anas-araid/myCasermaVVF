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
        case 'vigile':
          deleteFireman($id, $db_conn);
          break;
        case 'mezzo':
          deleteMezzo($id, $db_conn);
          break;
        case 'squadra':
          deleteSquadra($id, $db_conn);
          break;
        default:
          break;
      }
    }
  }
  else if (isset($_GET['idVigile']) && isset($_GET['idSquadra'])){
    $idVigile = text_filter($_GET['idVigile']);
    $idSquadra = text_filter($_GET['idSquadra']);
    if (isset($_GET['data'])){
      $data = text_filter($_GET['data']);
      switch ($data) {
        case 'vigileFromSquadra':
          removeVigileFromSquadra($idVigile, $idSquadra, $db_conn);
          break;
        default:
          break;
      }
    }
  }

  function removeVigileFromSquadra($idVigile, $idSquadra, $db_conn){
    $sql = "DELETE FROM t_squadre WHERE FK_NumeroSquadra='$idSquadra' AND FK_Vigile='$idVigile' ";
    $deleteQuery = mysqli_query($db_conn, $sql);
    if ($deleteQuery == null){
      die("error");
    }
    redirect('../dashboard.php?redirect=mostraSquadra&id='.$idSquadra);
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
  function deleteFireman($id, $db_conn){
    $sql = "DELETE FROM t_vigili WHERE ID='$id'";
    $deleteQuery = mysqli_query($db_conn, $sql);
    if ($deleteQuery == null){
      die("Errore nella cancellazione del vigile: contattare l'amministratore");
    }
    redirect('../dashboard.php?redirect=vigili');
  }
  function deleteMezzo($id, $db_conn){
    $sql = "DELETE FROM t_mezzi WHERE ID='$id'";
    $deleteQuery = mysqli_query($db_conn, $sql);
    if ($deleteQuery == null){
      die("Errore nella cancellazione del mezzo: contattare l'amministratore");
    }
    redirect('../dashboard.php?redirect=mezzi');
  }
  function deleteSquadra($id, $db_conn){
    $sql = "DELETE FROM t_numeroSquadre WHERE ID='$id'";
    $deleteQuery = mysqli_query($db_conn, $sql);
    if ($deleteQuery == null){
      die("Errore nella cancellazione della squadra: contattare l'amministratore");
    }
    redirect('../dashboard.php?redirect=squadre');
  }

 ?>
