<?php
require_once("../bootstrap.php");
require_once("./Mailer.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $commento = $_POST['commento'];
  $postId = $_GET["postId"];




  // Esegui la query per inserire il commento nel databas
  $dbh->inserisciCommento($commento, $postId);
  $destinatario = $dbh->getMailFromImage($postId);

  $mailer = new Mailer();

  $mailer->sendMail("flami2002@gmail.com", $destinatario, "Nuovo Commento", "Hai ricevuto un nuovo commento: ".$commento);


  http_response_code(200);
  echo "Commento salvato con successo";
} else {
  // Restituisci un errore se la richiesta non è di tipo POST
  http_response_code(400);
  echo "Richiesta non valida";
}




header("Location: ../commenti.php?postId=".$postId);
?>
