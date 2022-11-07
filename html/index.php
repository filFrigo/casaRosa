<?php


# Imposta la cartella Globale
chdir(dirname(__DIR__));

#Visualizza gli errori
error_reporting(E_ALL);
ini_set('display_errors', true);

#Inizializza la sessione dell'utente
session_start();



#Carica le funzioni dell'app
require_once __DIR__ . '/../helpers/functions.php';


try {
  // Cerca di caricare automaticamente le Classi:
  if (!spl_autoload_register('autoloadClass')) {
    throw new \Exception('autoload does not exist', 2);
  }


  new core\app();
} catch (Throwable $e) {
  echo "Message: " . $e->getMessage();
  echo "<br>Code: " . $e->getCode();
}