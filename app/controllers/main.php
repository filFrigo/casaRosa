<?php

namespace controllers;

class main
{
  public $content = 'no load content';
  public $sidebar = '';
  public $toasts = '';
  private $data = [];
  public $conn = '';

  public $navbar = '';


  public function __construct(\PDO $conn)
  {
    $this->data['appParams'] = getKeyInArray(load('/config/app.params.php'), 'appParams');
    $this->conn = $conn;
  }

  public function displayLogin()
  {

    // carica il layout della pagina
    include __DIR__ . '/../../layout/login.tpl.php';
  }

  public function displayDashboard()
  {
    $data = $this->data;

    // Carica il contenuto della pagina
    $this->content = view('user/dashboard', compact('data'));

    // carica il layout della pagina
    include __DIR__ . '/../../layout/empty.tpl.php';
  }

  public function displayHome()
  {
    $data = $this->data;

    $this->createNavbar($data);
    $this->createSidebar($data);

    // Carica il contenuto della pagina
    $this->content = view('user/home', compact('data'));

    // carica il layout della pagina
    include
      __DIR__ . '/../../layout/empty.tpl.php';
  }

  private function createNavbar($data)
  {

    $this->navbar =

      __DIR__ . '/../../layout/navbars/navbar.tpl.php';
  }

  private function createSidebar($data)
  {

    $this->sidebar =

      __DIR__ . '/../../layout/sidebars/sidebar.tpl.php';
  }
}