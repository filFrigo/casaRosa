<?php

namespace controllers;

class main
{
  public $content = 'no load content';
  public $sidebar = 'no load sidebar';
  public $toasts = '';
  private $data = [];
  public $conn = '';


  public function __construct(\PDO $conn)
  {
    $this->data['appParams'] = getKeyInArray(load('/config/app.params.php'), 'appParams');
    $this->conn = $conn;
  }

  public function home()
  {
    $data = $this->data;

    // Carica il contenuto della pagina
    $this->content = view('guest/home', compact('data'));

    // carica il layout della pagina
    include __DIR__ . '/../../layout/homepage.tpl.php';
  }
}