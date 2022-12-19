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



  public function displayHome()
  {
    $data = $this->data;

    $this->createNavbar($data);
    $this->createSidebar($data);

    // Carica il contenuto della pagina
    $this->content = view('user/dashboard', compact('data'));

    // carica il layout della pagina
    include
      __DIR__ . '/../../layout/empty.tpl.php';
  }

  // 
  public function displayWallet()
  {
    $data = $this->data;

    $this->createNavbar($data);
    $this->createSidebar($data);

    // Carica il contenuto della pagina
    $this->content = view('user/wallet', compact('data'));

    // carica il layout della pagina
    include
      __DIR__ . '/../../layout/empty.tpl.php';
  }

  // Visualizza la divisione degli appartamenti
  public function displayConfigZone()
  {
    $data = $this->data;

    $this->createNavbar($data);
    $this->createSidebar($data);

    // Carica il contenuto della pagina
    $this->content = view('user/configZone', compact('data'));

    // carica il layout della pagina
    include
      __DIR__ . '/../../layout/empty.tpl.php';
  }

  public function displayConfigArea()
  {
    $data = $this->data;

    $this->createNavbar($data);
    $this->createSidebar($data);

    // Carica il contenuto della pagina
    $this->content = view('user/configAreas', compact('data'));

    // carica il layout della pagina
    include
      __DIR__ . '/../../layout/empty.tpl.php';
  }

  public function displayConfigUsers()
  {
    $data = $this->data;

    $this->createNavbar($data);
    $this->createSidebar($data);

    // Carica il contenuto della pagina
    $this->content = view('user/configUsers', compact('data'));

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

  // visualizza la suddivisione degli spazi della zona
  public function displaySpaces()
  {
    $data = $this->data;

    $this->createNavbar($data);
    $this->createSidebar($data);

    // Carica il contenuto della pagina
    $this->content = view('zone/view', compact('data'));

    // carica il layout della pagina
    include
      __DIR__ . '/../../layout/empty.tpl.php';
  }

    public function displayTalks()
  {
    $data = $this->data;

    $this->createNavbar($data);
    $this->createSidebar($data);

    // Carica il contenuto della pagina
    $this->content = view('user/talks', compact('data'));

    // carica il layout della pagina
    include
      __DIR__ . '/../../layout/empty.tpl.php';
  }
}