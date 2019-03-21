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
        swal.close();
        location.href='app/deleteData.php?data=vigile&id='+id;
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
function alertDeleteMezzo(id){
  swal(
    {
      title: "Vuoi continuare?",
      text: "Il mezzo verrà eliminato",
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
      location.href='app/deleteData.php?data=mezzo&id='+id;
    }else{
      swal.close();
    }
  });
}
function alertDeleteSquadra(id){
  swal(
    {
      title: "Vuoi continuare?",
      text: "La squadra verrà eliminata",
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
      location.href='app/deleteData.php?data=squadra&id='+id;
    }else{
      swal.close();
    }
  });
}
function alertDeleteTurno(id){
  swal(
    {
      title: "Vuoi continuare?",
      text: "Il turno verrà eliminata",
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
      location.href='app/deleteData.php?data=turno&id='+id;
    }else{
      swal.close();
    }
  });
}
function alertRemoveFiremanFromSquad(idVigile, idSquadra){
  swal(
    {
      title: "Vuoi continuare?",
      text: "Il vigile sara' rimosso dalla squadra",
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
      location.href='app/deleteData.php?data=vigileFromSquadra&idVigile='+idVigile + '&idSquadra='+ idSquadra;
    }else{
      swal.close();
    }
  });
}