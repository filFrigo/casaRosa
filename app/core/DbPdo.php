<?php


namespace core;

class DbPdo {
  protected $conn;
  protected static $instance;

  public static function getInstance(array $options)
  {
    if (!static::$instance) {
      static::$instance = new static($options);
    }
    return static::$instance;
  }
  protected function __construct(array $options){


    //echo "Sono QUI!"; die;
    //echo "<pre>";
    //print_r($options);
    //die;

    //$connx = new \PDO('mysql:host=localhost;dbname=mydata;charset=utf8','root','',[]);

    $this->conn = new \PDO($options['dsn'],$options['user'],$options['password'],$options['pdooptions']);


    if (array_key_exists('options', $options)) {
      foreach ($options as $opt) {
        $this->conn->setAttribute(key($opt), current($opt));
      }
    }

  }

  public function getConn(){
    return $this->conn;

  }


}
