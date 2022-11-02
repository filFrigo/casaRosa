<?php

namespace core;

use core\DbFactory;
use controllers\temp;
use core\languages;

class app {

  protected $database = [];


  public function __construct(){
      $this->loadApp();
  }

  private function loadApp()
  {


      //recupero la connessione dal PDO
      $database = load('/config/app.database.php');
      // MI connetto al database


      $conn = DbFactory::create($database)->getConn();

  

      $this->conn = $conn;

      #Istanzio il router
      $router = new router($conn);
      #Gestisco la rotta
      $controller = $router->dispatch($conn);
  }

}
