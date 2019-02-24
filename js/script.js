function flatAlert(titolo, testo, icona, url){
  swal({
    title: titolo,
    text: testo,
    icon: icona,
  }).then(azione => {
    if (azione){
      location.href = url;
    }else{
      location.href = url;
    }
  });
}
function flatAlertClose(titolo, testo, icona){
  swal({
    title: titolo,
    text: testo,
    icon: icona,
  }).then(azione => {
    if (azione){
      window.close();
    }else{
      window.close();
    }
  });
}
function alertDeleteFireman(id){
  swal(
    {
      title: "Vuoi continuare?",
      text: "I dati del vigile verranno eliminati",
      icon: "error",
      buttons: {
        cancel: {
          text: "Annulla",
          visible: true,
        },
        button: {
          text: "Continua",
          visible: true,
        }
      }
    }
  ).then(Elimina => {
    if (Elimina){
      swal(" ", "Eliminato con successo", "success").then(Elimina => {
        location.href='app/delete.php?id='+id;
      });
    }else{
      swal.close();
    }
  });
}
function alertDeleteCertificato(id){
  swal(
    {
      title: "Vuoi continuare?",
      text: "Il certificato verrà eliminato",
      icon: "error",
      buttons: {
        cancel: {
          text: "Annulla",
          visible: true,
        },
        button: {
          text: "Continua",
          visible: true,
        }
      }
    }
  ).then(Elimina => {
    if (Elimina){
      swal.close();
      location.href='app/deleteData.php?data=certificato&id='+id;
    }else{
      swal.close();
    }
  });
}
