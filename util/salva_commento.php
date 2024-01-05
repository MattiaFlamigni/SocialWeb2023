<?php
require("../bootstrap.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $commento = $_POST['commento'];
  $postId = $_GET["postId"];
  // Assicurati di validare e sanificare $commento prima di utilizzarlo nella query SQL
  // ...

  // Esegui la query per inserire il commento nel database
  $dbh->inserisciCommento($commento, $postId);

  // Restituisci una risposta al client
  http_response_code(200);
  echo "Commento salvato con successo";
} else {
  // Restituisci un errore se la richiesta non è di tipo POST
  http_response_code(400);
  echo "Richiesta non valida";
}




header("Location: ../template/commenti.php?postId=".$postId);
?>
