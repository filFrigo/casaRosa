<?php

# Funzione che permette il Caricamento Automatico delle Classi:
function autoloadClass($className)
{
  # Recupero la classe richiesta (Puntamento da cartella functions.php)
  $class_To_Load = __DIR__ . '/../app/' . str_replace('\\', '/', $className) . '.php';

  # Se la classe esiste la includo
  if (file_exists($class_To_Load)) {
    require_once $class_To_Load;
  } else {
    throw new \Exception('Autoload doesnt match class "' . $className . '".', 505);
  }
}


function newload($file_path, array $data = [])
{
  #var_dump($data);
  extract($data);
  ob_start();
  require __DIR__ . '/../' . $file_path;
  $data = ob_get_contents();
  ob_end_clean();
  return $data;
}



function load($file_path)
{
  $file_path = trim($file_path, '/');
  $dir = __DIR__ . '/../' . $file_path;

  if (file_exists($dir)) {
    return include $dir;  #tolto include


  } else {
    echo "Do not load " . $dir;
  }
}


function loadJSON($file_path)
{
  $file_path = trim($file_path, '/');
  $dir = __DIR__ . '/../' . $file_path;

  if (file_exists($dir)) {
    $file = file_get_contents($dir);



    $data = json_decode($file);

    return $data;
  } else {
    echo "Do not load " . $dir;
  }
}



function view($view, array $data = [])
{
  #var_dump($data);
  extract($data);
  ob_start();
  require __DIR__ . '/../app/views/' . $view . '.tpl.php';
  $data = ob_get_contents();
  ob_end_clean();
  return $data;
}


function getKeyInArray(array $data, $key, $default = NULL)
{
  return array_key_exists($key,  $data) ? $data[$key] : $default;
}

# La funzione permette di fare un reindirizzamento.
function redirect($url = '/')
{
  header('Location:' . $url);
  exit;
}

function array_sort_by_column(&$arr, $col, $dir = SORT_ASC)
{
  $sort_col = array();
  foreach ($arr as $key => $row) {
    $sort_col[$key] = $row[$col];
  }

  array_multisort($sort_col, $dir, $arr);
}


function transformDecimal($value, $needle)
{
  // Recupero i valori prima e dopo la virgola
  $values = explode($needle, $value);

  // VERIFICA : se inserisco piu needle  es. 10,10,10 = ritornare errore
  if (array_key_exists(2, $values)) {
    return false;
  }

  // Assegno i valori:
  $importo = $values[0];
  $decimali = $values[1];

  // Se il decimale è di una sola cifra, aggiungo uno zero.
  if (strlen($decimali) <= 1) {
    $decimali = $decimali . '0';
  }

  // Ritorno il valore formattato
  return $importo . substr($decimali, 0, 2);
}

function sessionData($param)
{
  // Entro nei dati di sessione
  $sessionData = getKeyInArray($_SESSION, 'userData', []);

  if ($sessionData == []) {
    return false;
  }
  return getKeyInArray($sessionData, $param, false);
}