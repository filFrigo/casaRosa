<?php

namespace core;
use core\DbPdo;

class DbFactory {
  public function __construct() {
    //echo "dbfactory created"; die;


  }

  public static function create(array $options)
  {


    if(!array_key_exists('dsn',$options)){
      if(!array_key_exists('driver',$options)){
        throw new \invalidArgumentException('Nessun drive predefinito');
      }

      $dsn = '';

      switch ($options['driver']) {
        case 'mysql':
        case 'oracle':
        case 'mssql':
        $dsn = $options['driver'].'mysql:host='.$options['host'];
        $dsn .= ';dbname='.$options['database'].';charset='.$options['charset'];
        break;

        case 'sqlite':
        $dsn = 'sqllite:'.$options['database'];
        break;

        default:
        throw new \invalidArgumentException('Driver non impostato o sconosciuto');
        break;
      }
      $options['dsn'] = $dsn;
    }

    return DbPdo::getInstance($options);
      
  }
}
