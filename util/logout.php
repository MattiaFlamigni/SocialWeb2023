<?php
// Distruggi la sessione
session_start();
session_destroy();

// Impedisci la cache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Reindirizza alla pagina di login
header("Location: ../index.php");
exit();
?>

