<?php

namespace core;



use controllers;

class router
{
  protected $conn;
  protected $routes = [
    'GET' => [],
    'POST' => [],
  ];

  public function __construct(\PDO $conn)
  {
    $this->loadRoutes(load('config/app.routes.php')['routes']);
    $this->conn = $conn;
  }

  # Carica le Rotte
  public function loadRoutes(array $routes)
  {
    $this->routes = $routes;
  }

  # Ritorna le rotte
  public function getRoutes()
  {
    return $this->routes;
  }

  # Gestisce la gestione delle rotte
  public function dispatch()
  {
    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);    # /login/sss/
    $url = trim($url, '/');                                     # login/sss
    $method = $_SERVER['REQUEST_METHOD'];                       # GET || POST



    # Interpreta la rotta
    return $this->processUri($url, $method);
  }

  # Recupera il Token chiamato dal router
  protected function processUri($url, $method = 'GET')
  {
    $routes = $this->routes[$method];

    foreach ($routes as $route => $callback) {
      $regMatch = preg_quote($route);
      $subPattern = preg_replace('/\\\:[a-zA-Z0-9\_\-]+/', '([a-zA-Z0-9\-\_]+)', $regMatch);
      $pattern = "@^" . $subPattern . "$@D";

      $matches = array();
      if (preg_match($pattern, $url, $matches)) {
        #remove the first match
        array_shift($matches);
        # Gestisci la rotta
        return $this->route($callback, $matches);
      }
    }

    #se la rotta non esiste:
    return $this->route('controllers\errorController@page404', []);
  }


  # permette di gestire la rotta
  protected function route($callback, array $matches)
  {


    if (is_callable($callback)) {  # controllers\temp::home
      return call_user_func($callback, $matches);
    }


    $tokens = explode('@', $callback);

    #'controllers\home@homeView'
    $controller = $tokens[0];   #controllers\home
    $method = $tokens[1];       #homeView
    $segnaposto = $matches;     #parametro del segnaposto (ora non usato)
    $class = new $controller($this->conn);

    if (method_exists($controller, $method) == true) {
      # Se ho trovato il metodo
      call_user_func_array([$class, $method], $matches);
      return $class;
    } else {
      #Se non ho trovato il metodo ma la rotta esiste.
      throw new \Exception("Not found method " . $method . " in controller " . $controller, 506);
    }
  }
}