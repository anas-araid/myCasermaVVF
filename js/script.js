function flatAlert(titolo, testo, icona, url, button=false){
  if (button){
    swal({
      title: titolo,
      text: testo,
      icon: icona,
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
    }).then(azione => {
      if (azione){
        location.href = url;
      }else{
        swal.close();
      }
    });
  }else{
    swal({
      title: titolo,
      text: testo,
      icon: icona,
    }).then(azione => {
      if (azione){
        location.href = url;
      }else{
        swal.close();
      }
    });
  } 
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
function privacy(){
  var content = "<div style='text-align:left'><h2>NORMATIVA SULLA PRIVACY</h2>"+
                "<p><strong>Informativa ai sensi dell'art. 13 del Codice della Privacy</strong></p>"+
                "<p><b>Ai sensi dell'articolo 13 del codice della D.Lgs. 196/2003, vi rendiamo le seguenti informazioni.</b></p>"+
                "<p>Noi di <strong><span id='sito'></span></strong> riteniamo che la privacy dei nostri visitatori sia estremamente importante. Questo documento descrive dettagliatamente i tipi di informazioni personali raccolti e registrati dal nostro sito e come essi vengano utilizzati.</p>"+
                "<h3>File di Registrazione (Log Files)</h3>"+
                "<p>Come molti altri siti web, il nostro utilizza file di log. Questi file registrano semplicemente i visitatori del sito - di solito una procedura standard delle aziende di hosting e dei servizi di analisi degli hosting.</p>"+
                "<p>Le informazioni contenute nei file di registro comprendono indirizzi di protocollo Internet (IP), il tipo di browser, Internet Service Provider (ISP), informazioni come data e ora, pagine referral, pagine d'uscita ed entrata o il numero di clic.</p>"+
                "<p>Queste informazioni vengono utilizzate per analizzare le tendenze, amministrare il sito, monitorare il movimento degli utenti sul sito e raccogliere informazioni demografiche. Gli indirizzi IP e le altre informazioni non sono collegate a informazioni personali che possono essere identificate, dunque <strong>tutti i dati sono raccolti in forma assolutamente anonima</strong>."+
                "</p>"+
                "<div id='cookies' style='display: block;'>"+
                "<h3>Questo sito web utilizza i Cookies</h3>"+
                "<p>I cookies sono piccoli file di testo che vengono automaticamente posizionati sul PC del navigatore all’interno del browser. Essi contengono informazioni di base sulla navigazione in Internet e grazie al browser vengono riconosciuti ogni volta che l’utente visita il sito.</p>"+
                "<h3>Cookie Policy</h3>"+
                "Questo sito utilizza cookies, anche di terze parti, per migliorarne l’esperienza di navigazione, consentire a chi naviga di usufruire di eventuali servizi online e monitorare la navigazione nel sito.<p></p>"+
                "<h3>Come disabilitare i Cookies</h3>"+
                "<p>E’ possibile disabilitare i cookies direttamente dal browser utilizzato, accedendo alle impostazioni (preferenze oppure opzioni): questa scelta potrebbe limitare alcune funzionalità di navigazione del sito.</p>"+
                "<h3>Gestione dei Cookies</h3>"+
                "<p>I cookies utilizzati in questo sito possono rientrare nelle categorie descritte di seguito.</p>"+
                "<ul><li><strong>Attività strettamente necessarie al funzionamento"+
                "</strong><br>Questi cookies hanno natura tecnica e permettono al sito di funzionare correttamente. Ad esempio, mantengono l’utente collegato durante la navigazione evitando che il sito richieda di collegarsi più volte per accedere alle pagine successive.</li><li><strong>Attività di salvataggio delle preferenze<br>"+
                "</strong>Questi cookie permettono di ricordare le preferenze selezionate dall’utente durante la navigazione, ad esempio, consentono di impostare la lingua.</li><li><strong>Attività Statistiche e di Misurazione dell’audience (es: Google Analytics)<br>"+
                "</strong>Questi cookie ci aiutano a capire, attraverso dati raccolti in forma anonima e aggregata, come gli utenti interagiscono con i siti internet fornendo informazioni relative alle sezioni visitate, il tempo trascorso sul sito, eventuali malfunzionamenti. Questo aiuta a migliorare la resa dei siti internet.</li><li><strong>Cookie di social media (es: Facebook)<br>"+
                "</strong>Questi cookie di terza parte vengono utilizzati per integrare alcune diffuse funzionalità dei principali social media e fornirle all’interno del sito. In particolare permettono la registrazione e l’autenticazione sul sito tramite facebook e google connect, la condivisione e i commenti di pagine del sito sui social, abilitano le funzionalità del 'mi piace' su Facebook e del '+1' su G+.</li></ul>"+
                "</div>"+
                "<div id='fornitori' style='display: none;'>"+
                "<h3>Fornitori di terze parti</h3>"+
                "<p>I fornitori di terze parti, tra cui Google, utilizzano cookie per pubblicare annunci in base alle precedenti visite di un utente su questo sito.</p>"+
                "<p>L'utilizzo dei cookie per la pubblicità consente a Google e ai suoi partner di pubblicare annunci per gli utenti di questo sito (e su altri siti) in base ai dati statistici raccolti su questo sito e sui siti web dei partner Google.</p>"+
                "<p>Gli utenti possono scegliere di disattivare la pubblicità personalizzata, visitando la pagina <a href='https://www.google.com/settings/ads' target='_blank'>Impostazioni annunci</a>.</p>"+
                "<p>Visitando la pagina www.aboutads.info potrai disattivare i cookies dei fornitori di terze parti.</p>"+
                "</div>"+
                "<div id='partners' style='display: block;'>"+
                "<h3>I nostri partner pubblicitari</h3>"+
                "<p>Alcuni dei nostri partner pubblicitari possono utilizzare i cookies sul nostro sito per raccogliere dati sulla navigazione degli utenti in forma anonima. Tra i nostri partner pubblicitari figurano:"+
                "</p><ul>"+
                "<li id='amazon' style='display: none;'>Amazon</li>"+
                "<li id='ebay' style='display: none;'>Ebay</li>"+
                "<li id='altri_partner' style='display: none;'><span id='partner'></span></li>"+
                "</ul>"+
                "<p>Gli annunci dei fornitori terze parti gestiscono reti pubblicitarie che utilizzano la tecnologia dei cookies nei rispettivi annunci e nei link che appaiono sul nostro sito. Gli annunci vengono così inviati direttamente al tuo browser. Riceveranno automaticamente il tuo indirizzo IP. Altre tecnologie (come i cookie o JavaScript) possono anche essere utilizzati dalle reti pubblicitarie di terze parti del nostro sito per misurare l'efficacia delle loro campagne pubblicitarie e/o personalizzare i contenuti pubblicitari che vedete sul sito.</p><p>"+
                "Il nostro sito non ha accesso o non controlla questi cookie utilizzati da inserzionisti di terze parti."+
                "</p><h3>Norme sulla privacy di terze parti</h3>"+
                "<p>È necessario consultare le rispettive norme sulla privacy di questi server di terze parti per ulteriori informazioni sulle loro pratiche e per istruzioni su come disattivare alcune pratiche."+
                "</p><p>La nostra politica sulla privacy non si applica ai fornitori di terze parti ed ai partner pubblicitari, e non possiamo controllare le attività di tali altri inserzionisti o siti web.</p>"+
                "<p>Se desideri disattivare i cookie, puoi farlo attraverso le tue singole opzioni del browser. Ulteriori informazioni sulla gestione dei cookie con browser web specifico possono essere trovati nei rispettivi siti web dei browser</p>"+
                "</div>"+
                "<h3>Finalità del trattamento</h3>"+
                "<p>I dati possono essere raccolti per una o più delle seguenti finalità:</p>"+
                "<ul>"+
                "<li>fornire l'accesso ad aree riservate del Portale e di Portali/siti collegati con il presente e all'invio di comunicazioni anche di carattere commerciale, notizie, aggiornamenti sulle iniziative di questo sito e delle società da essa controllate e/o collegate e/o Sponsor. </li>"+
                "<li>eventuale cessione a terzi dei suddetti dati, sempre finalizzata alla realizzazione di campagne di email marketing ed all'invio di comunicazioni di carattere commerciale. </li>"+
                "<li>eseguire gli obblighi previsti da leggi o regolamenti;</li>"+
                "<li>gestione contatti;</li>"+
                "</ul>"+
                "<h3>Modalità del trattamento</h3>"+
                "<p>I dati verranno trattati con le seguenti modalità:</p>"+
                "<ul>"+
                "<li>raccolta dati con modalità single-opt, in apposito database;</li>"+
                "<li>registrazione ed elaborazione su supporto cartaceo e/o magnetico;</li>"+
                "<li>organizzazione degli archivi in forma prevalentemente automatizzata, ai sensi del Disciplinare Tecnico in materia di misure minime di sicurezza, Allegato B del Codice della Privacy. </li>"+
                "</ul>"+
                "<h3>Natura obbligatoria</h3>"+
                "<p>Tutti i dati richiesti sono obbligatori.</p>"+
                "<div id='trattamento' style='display: none;'>"+
                "<h3>Soggetti a cui dati potranno essere comunicati i dati personali</h3>"+
                "<p>I dati raccolti potranno essere comunicati a:</p>"+
                "<ul>"+
                "<li>società e imprese per usi di direct mailing o attività analoghe;</li>"+
                "<li>associazioni e fondazioni intenzionate ad acquistare spazi pubblicitari sulle liste o sul sito e/o collegate alla fornitura di un particolare servizio.</li>"+
                "<li>soggetti che debbano avere accesso ai dati, come da norme di legge o di normative secondarie e/o comunitarie.</li>"+
                "</ul>"+
                "</div>"+
                "<h3>Diritti dell'interessato</h3>"+
                "<p>Ai sensi ai sensi dell'art. 7 (Diritto di accesso ai dati personali ed altri diritti) del Codice della Privacy, vi segnaliamo che i vostri diritti in ordine al trattamento dei dati sono:</p>"+
                  "<ul>"+
                    "<li>conoscere, mediante accesso gratuito l'esistenza di trattamenti di dati che possano riguardarvi;</li>"+
                    "<li>essere informati sulla natura e sulle finalità del trattamento</li>"+
                    "<li>ottenere a cura del titolare, senza ritardo:</li>"+
                    "<ul>"+
                      "<li>la conferma dell'esistenza o meno di dati personali che vi riguardano, anche se non ancora registrati, e la comunicazione in forma intellegibile dei medesimi dati e della loro origine, nonché della logica e delle finalità su cui si basa il trattamento; la richiesta può essere rinnovata, salva l'esistenza di giustificati motivi, con intervallo non minore di novanta giorni;"+
                      "</li><li>la cancellazione, la trasformazione in forma anonima o il blocco dei dati trattati in violazione di legge, compresi quelli di cui non è necessaria la conservazione in relazione agli scopi per i quali i dati sono stati raccolti o successivamente trattati;"+
                      "</li><li>l'aggiornamento, la rettifica ovvero, qualora vi abbia interesse, l'integrazione dei dati esistenti;"+
                      "</li><li>opporvi in tutto o in parte per motivi legittimi al trattamento dei dati personali che vi riguardano ancorché pertinenti allo scopo della raccolta;"+
                    "</li></ul>"+
                  "</ul>"+
                "<p>Vi segnaliamo che il titolare del trattamento ad ogni effetto di legge è:</p>"+
                  "<ul>"+
                    "<li><b><span>Anas Araid</span></b></li>"+
                    "</li><li>E-mail: <span>araid.anas99@gmail.com</span></li>"+
                  "</ul>"+
                "Per esercitare i diritti previsti all'art. 7 del Codice della Privacy ovvero per la cancellazione dei vostri dati dall'archivio, è sufficiente contattarci attraverso uno dei canali messi a disposizione."+
                "Tutti i dati sono protetti attraverso l'uso di antivirus, firewall e protezione attraverso password."+
                "<h3>Consenso</h3>"+
                "<p>Usando il nostro sito web, acconsenti alla nostra politica sulla privacy e accetti i suoi termini. Se desideri ulteriori informazioni o hai domande sulla nostra politica sulla privacy non esitare a contattarci.</p></div>";
    var privacyModal = new tingle.modal({
    closeMethods: ['overlay', 'button', 'escape'],
    closeLabel: "Chiudi",
    onOpen: function() {
      privacyModal.setContent(
        content
      );
    },
  });
  privacyModal.open();
}