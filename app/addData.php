<?php
  function addCaserma($caserma, $email, $telefono, $password, $db_conn){
    $sql = "INSERT INTO t_caserme (Descrizione, Telefono, Email, Password) VALUES ('$caserma', '$telefono', '$email', '$password')";
    try {
      $addCaserma = mysqli_query($db_conn, $sql);
    } catch (Exception $e) {
      return false;
    }
    return true;
  }
?>
