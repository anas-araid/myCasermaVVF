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
function alertDeleteTurno(id, idSquadra){
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
      location.href='app/deleteData.php?data=turno&idSquadra='+idSquadra+'&id='+id;
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

function terms(){
  var content = 
                "<div style='text-align:left'>"+
                "<h2>CONDIZIONI GENERALI D'USO</h2>"+
                "<p><b>Art. 1 - Oggetto</b></p>"+
                "<p>1. Le presenti condizioni generali d'uso rappresentano l'accesso e l'uso del sito myCasermaVVF (d'ora in avanti il 'titolare'), sono attività regolate dalle presenti condizioni generali d'uso.</p>"+
                "<p>2. Il presente sito è di proprietà di Anas Araid.</p>"+
                "<p>3. L'accesso al sito e il suo uso, così come l'acquisto di prodotti in esso presentati, presuppone la lettura, la conoscenza e l'accettazione di queste condizioni generali d'uso.</p>"+
                "<p><b>Art. 2 - Modifiche alle condizioni d'uso</b></p>"+
                "<p>1. Il titolare potrà modificare o semplicemente aggiornare, in tutto o in parte, queste condizioni generali d'uso. Le modifiche e gli aggiornamenti delle condizioni generali d'uso saranno notificati agli utenti nella Home page non appena adottati e saranno vincolanti non appena pubblicati sul sito web in questa stessa sezione. L'accesso e l'utilizzo del sito presuppongono l'accettazione da parte dell'utente delle presenti condizioni d'uso.</p>"+
                "<p><b>Art. 3 - Proprietà intellettuale</b></p>"+
                "<p>1. I contenuti presenti sul sito, quali, a titolo esemplificativo, le opere, le immagini, le fotografie, i dialoghi, le musiche, i suoni ed i video, i documenti, i disegni, le figure, i loghi ed ogni altro materiale, in qualsiasi formato, pubblicato sul sito medesimo, compresi i menu, le pagine web, la grafica, i colori, gli schemi, gli strumenti, i caratteri ed il design del sito, i diagrammi, il layouts, i metodi, i processi, le funzioni ed il software che fanno parte del sito, sono protetti dal diritto d'autore e da ogni altro diritto di proprietà intellettuale del titolare o di eventuali terzi dallo stesso contrattualizzati. È vietata la riproduzione, in tutto o in parte, in qualsiasi forma, del sito e dei suoi contenuti, senza il consenso espresso in forma scritta del titolare.</p>"+
                "<p>2. L'utente è autorizzato unicamente a visualizzare il sito ed i suoi contenuti fruendo dei relativi servizi ivi disponibili. L'utente è, inoltre, autorizzato a compiere tutti quegli altri atti di riproduzione temporanei, privi di rilievo economico proprio, che sono considerati transitori o accessori, parte integrante ed essenziale della stessa visualizzazione e fruizione del Sito e dei suoi contenuti e tutte le altre operazioni di navigazione sul Sito che siano eseguite solo per un uso legittimo del medesimo.</p>"+
                "<p>3. L'utente non è in alcun modo autorizzato ad eseguire alcuna riproduzione, su qualsiasi supporto, in tutto o in parte del sito e dei suoi contenuti. Qualsiasi atto di riproduzione dovrà essere, di volta in volta, autorizzato da myCasermaVVF o, all'occorrenza, dagli autori delle singole opere contenute nel sito. Tali operazioni di riproduzione dovranno essere comunque eseguite per scopi leciti e nel rispetto del diritto d'autore e degli altri diritti di proprietà intellettuale e degli autori delle singole opere contenute nel sito.</p>"+
                "<p><b>Art. 4 - Utilizzo del sito e responsabilità dell'utente</b></p>"+
                "<p>1. L'accesso e l'uso del sito, la visualizzazione delle pagine web, compresa la comunicazione con il titolare, la possibilità di scaricare informazioni sui prodotti e l'acquisto degli stessi sul sito web, costituiscono attività condotte dall'utente esclusivamente per usi personali estranei a qualsiasi attività commerciale, imprenditoriale e professionale.</p>"+
                "<p>2. L'utente è personalmente responsabile per l'uso del sito e dei relativi contenuti. Il titolare infatti non potrà essere considerato responsabile dell'uso non conforme alle norme di legge vigenti, del sito web e dei contenuti da parte di ciascuno dei propri utenti, salva la responsabilità per dolo e colpa grave. In particolare, l'utente sarà l'unico ed il solo unico responsabile per la comunicazione di informazioni e di dati non corretti, falsi o relativi a terzi soggetti, senza che questi abbiano espresso il loro consenso, nonché in considerazione di un uso non corretto degli stessi.</p>"+
                "<p>3. Ogni materiale scaricato o altrimenti ottenuto attraverso l'uso del servizio è a scelta e a rischio dell'utente, pertanto ogni responsabilità per eventuali danni a sistemi di computer o perdite di dati risultanti dalle operazioni di scarico ricade sull'utente e non potrà essere imputata al titolare.</p>"+
                "<p>4. Il titolare declina ogni responsabilità per eventuali danni derivanti dall'inaccessibilità ai servizi presenti sul sito o da eventuali danni causati da virus, file danneggiati, errori, omissioni, interruzioni del servizio, cancellazioni dei contenuti, problemi connessi alla rete, ai provider o a collegamenti telefonici e/o telematici, ad accessi non autorizzati, ad alterazioni di dati, al mancato e/o difettoso funzionamento delle apparecchiature elettroniche dell'utente stesso.</p>"+
                "<p>5. L'utente è responsabile della custodia e del corretto utilizzo delle proprie informazioni personali, ivi comprese le credenziali che consentono di accedere ai servizi riservati, nonché di ogni conseguenza dannosa o pregiudizio che dovesse derivare a carico di myCasermaVVF ovvero di terzi a seguito del non corretto utilizzo, dello smarrimento, sottrazione di tali informazioni.</p>"+
                "<p>6. Il Titolare ha provveduto ad adottare ogni ragionevole accorgimento per evitare che siano pubblicati sul sito contenuti ed immagini che possano essere ritenuti lesivi del decoro, dei diritti umani e della dignità delle persone, in tutte le possibili forme ed espressioni. In ogni caso, qualora i suddetti contenuti siano ritenuti lesivi della sensibilità religiosa o etica o del decoro, l'utente interessato è pregato di comunicare tale condizione al titolare, il quale tuttavia avverte che ogni eventuale accesso ai contenuti considerati lesivi o offensivi avviene da parte dell'utente a proprio insindacabile giudizio ed a sua esclusiva e personale responsabilità.</p>"+
                "<p>7. Il Titolare ha inoltre adottato ogni utile precauzione affinché tutte le informazioni presenti sul sito siano corrette, complete ed aggiornate, tuttavia lo stesso non assume nei confronti degli utenti alcuna responsabilità circa l'accuratezza e la completezza dei contenuti pubblicati sul sito, salvo quanto diversamente previsto dalla legge. Qualora un utente riscontrasse errori o mancati aggiornamenti delle informazioni presenti sul sito è pregato di comunicarlo al titolare utilizzando la casella email: araid.anas99@gmail.com.</p>"+
                "<p><b>Art. 5 - Account personale</b></p>"+
                "<p>1. L'utente avrà la possibilità di registrarsi al sito per usufruire dei prodotti e/o servizi dello stesso. L'utente avrà a disposizione un'area del sito esclusivamente dedicata allo stesso denominata 'configurazione' attraverso cui, potrà accedere e potrà verificare di volta in volta lo stato dei servizi di cui hai fatto richiesta.</p>"+
                "<p>2. Registrandosi al sito, l'utente dovrà fornire un indirizzo e-mail o un username (di seguito la 'id') e una password di accesso strettamente personali. Sia l' id che la password non potranno essere utilizzate da due o più postazioni contemporaneamente e l'utente non potrà cederle o trasferirle a terzi, se non sotto la sua piena ed esclusiva responsabilità. Al riguardo, si ricorda che l'utente sarà ritenuto responsabile nei confronti del titolare e qualsiasi terzo per ogni e qualsiasi azione, transazione e/o fatto avvenuto e/o eseguito mediante l'utilizzo dell'id e/o della password inserita.</p>"+
                "<p>3. L'utente è obbligato a preservare la riservatezza e segretezza della sua id e della sua password ed è tenuto ad informare prontamente il sito di qualsiasi eventuale loro uso non autorizzato o del loro smarrimento, a mezzo email o raccomandata A/R affinché la stessa possa sospendere l'erogazione dei propri servizi con riferimento all'account.</p>"+
                "<p>4. Qualora accada che, sia intervenuto un accesso non autorizzato all'account dell'utente e/o lo stesso abbia smarrito la sua ID e/o la sua Password per più di tre volte, il sito si riserva la facoltà di rimuovere l'account dell'utente senza che questi abbia nulla a pretendere nei confronti del titolare.</p>"+
                "<p>5. Il titolare non potrà essere ritenuto in alcun modo responsabile, direttamente o indirettamente, in qualsiasi forma o sulla base di qualsivoglia regime di responsabilità, per lesioni o danni di qualsiasi genere risultanti da, o correlati a, il mancato rispetto da parte dell'utente delle disposizioni di cui al presente articolo.</p>"+
                "<p>6. Il titolare sarà libero di inibire l'accesso di un utente alla propria area clienti e/o di interrompere l'operatività dell'id e/o della password dello stesso, qualora ritenga che sia intervenuta una sostanziale violazione delle presenti condizioni generali d' uso ed in particolare di quanto dopo previsto, ovvero qualora l'utente compia un uso illecito o scorretto dei servizi del sito.</p>"+
                "<p>7. L'utente sarà inoltre tenuto a non effettuare ne' a consentire o permettere a terzi i seguenti comportamenti (non esaustivi e in continuo aggiornamento):</p>"+
                "<p>•	il caricamento o la creazione all'interno dell'area cliente di qualsiasi dato o contenuto che sia in violazione di qualsivoglia legge, regolamento o diritto di terzi (ivi compresi, tra gli altri, segreti commerciali o dati personali di terzi);</p>"+
                "<p>•	l'utilizzazione dei servizi della società per scopi diversi dal mero accesso agli stessi nelle modalità in cui sono forniti dalla stessa;</p>"+
                "<p>•	effettuare azioni di qualunque genere e/o natura volte ad aggirare, disattivare ovvero interferire in qualsiasi modo con gli applicativi correlati alla sicurezza dei servizi della sito o altri applicativi che prevengano, limitino ovvero restringano l'utilizzo ovvero la copia di qualsiasi materiale presente sullo stesso;</p>"+
                "<p>•	utilizzazione dei servizi del sito per qualsivoglia scopo illecito o in violazione di qualsiasi normativa applicabile;</p>"+
                "<p>•	interferisca o danneggi i servizi e i sistemi della sito ovvero al loro relativo godimento da parte di qualsivoglia utente, con qualsiasi mezzo, compreso mediante il caricamento di files o comunque disseminando virus, adware, spyware, bachi o altri strumenti elettronici nocivi;</p>"+
                "<p>•	effettui azioni volte ad aggirare strumenti per l'esclusione di robot o altre misure che il sito possa utilizzare per prevenire accessi non autorizzati ai servizi della stessa.</p>"+
                "<br><p><b>Art. 6 - Esclusione di responsabilità</b></p>"+
                "<p>1.Come indicato in precedenza, il titolare svolge con la massima diligenza la cura e il mantenimento del sito e dei suoi contenuti, tuttavia, non si assume alcuna responsabilità per la correttezza, la completezza e la tempestività dei dati e delle informazioni fornite sul sito o sui siti ad esso collegati. Deve perciò escludersi ogni responsabilità per errori od omissioni derivanti dall'uso dei dati e delle informazioni sul sito.</p>"+
                "<p>2. Il titolare declina ogni responsabilità, inclusa la presenza di errori, la correzione degli errori, la responsabilità del server ospitante il sito; non è altresì responsabile dell'uso delle informazioni contenute, della loro correttezza e affidabilità. In nessun caso, inclusa la negligenza, il titolare sarà responsabile di ogni diretto o indiretto danno che possa risultare dall'uso, o dalla incapacità di usare, i materiali presenti nel sito. </p>"+
                "<p><b>Art. 7 - Limitazioni all'erogazione del servizio</b></p>"+
                "<p>1. Il titolare non potrà essere ritenuto responsabile dei danni conseguenti alla mancata prestazione del servizio a causa dell'errato o mancato funzionamento dei mezzi elettronici di comunicazione per cause estranee alla sfera del proprio prevedibile controllo. A titolo esemplificativo, ma non esaustivo, il malfunzionamento dei server ed altri dispositivi elettronici anche non facenti parte integrante della rete Internet, malfunzionamento dei software installati, virus informatici sull'eventuale presenza di virus o altri componenti informatici nocivi e dannosi, nonché da azioni di hacker o altri utenti aventi accesso alla rete. L'utente s'impegna dunque a tenere indenne e manlevare il titolare da qualsiasi responsabilità e/o richiesta al riguardo.</p>"+
                "<p><b>Art. 8 - Link di altri siti</b></p>"+
                "<p>1. Il sito può contenere collegamenti ipertestuali ad altri siti web che non hanno nessun collegamento con lo stesso. Il titolare non controlla né monitora di tali siti web e non ne garantisce pertanto in alcun modo i contenuti né la gestione dei dati. L'utente dovrà pertanto leggere attentamente le condizioni d'uso dei siti terzi visitati e le relative privacy policy, in quanto le presenti condizioni d'uso e la privacy policy si riferiscono unicamente al presente sito.</p>"+
                "<p><b>Art.9 - Link in altre pagine web</b></p>"+
                "<p>1. Il presente sito può essere raggiunto anche attraverso siti terzi dove sarà presente un link o banner per accedere al sito.</p>"+
                "<p>2. L'attivazione di link su siti terzi verso il presente sito è possibile solamente previo consenso ed autorizzazione del titolare, che potrà essere richiesta contattando lo stesso all'indirizzo summenzionato, ovvero scrivendo all'indirizzo email: araid.anas99@gmail.com.</p>"+
                "<p>3. L'attivazione di link non autorizzati legittimerà il titolare ad agire per l'immediata disattivazione dei link illegittimi e per l'eventuale riconoscimento della relativa pratica commerciale o concorrenza sleale ovvero azione a discapito del buon nome e della rinomanza del titolare, dei suoi servizi e delle società del medesimo gruppo. È in ogni caso vietata l'attivazione di collegamenti ipertestuali profondi (quali deep frames o deep links) al Sito ovvero l'uso non autorizzato di meta-tags.</p>"+
                "<p><b>Art. 10 - Marchi</b></p>"+
                "<p>1. Tutti i marchi ed i segni distintivi presenti sul sito, anche relativi alle singole attività svolte dal titolare, sono esclusiva del titolare medesimo o delle società a lui referenti.</p>"+
                "<p>2. Il titolare ha la facoltà di far uso esclusivo dei suddetti marchi. Pertanto, qualsiasi uso non consentito, non autorizzato e/o non conforme alla legge è severamente vietato e comporta conseguenze legali. Non è in alcun modo consentito usare detti marchi ed ogni altro segno distintivo presente sul sito per trarre indebitamente, anche indirettamente, vantaggio dal carattere distintivo o dalla rinomanza dei marchi del titolare o in modo da recare pregiudizio agli stessi ed ai loro titolari.</p>"+
                "<p><b>Art. 11 - Trattamento dei dati</b></p>"+
                "<p>1. I dati dell'utente sono trattati conformemente a quanto previsto dalla normativa in materia di protezione dei dati personali, come specificato nell'apposita sezione contenente l'informativa ai sensi dell'art. 13 Regolamento UE 2016/679 (Privacy Policy). Per più informazioni accedere alla sezione privacy policy del sito</p>"+
                "<p><b>Art. 12 - Contatti</b></p>"+
                "<p>1. Ogni richiesta di informazione potrà essere inviata via mail al seguente indirizzo araid.anas99@gmail.com</p>"+
                "<p>Le presenti condizioni sono state redatte in data 25/04/2019.</p>"+
                "</div>";
  var termsModal = new tingle.modal({
    closeMethods: ['overlay', 'button', 'escape'],
    closeLabel: "Chiudi",
    onOpen: function() {
      termsModal.setContent(
        content
      );
    },
  });
  termsModal.open();
}