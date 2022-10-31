<?php

namespace models;


class wallet
{
    public $conn = '';


    public function __construct(\PDO $conn)
    {
        $this->data['appParams'] = getKeyInArray(load('/config/app.params.php'), 'appParams');
        $this->conn = $conn;
    }


    public function getMovements(array $params = [])
    {
        $email = getKeyInArray($params, 'email', null);
        $return['email_passed'] = $email;

        $sql = <<<'SQL'
                SELECT 
                `movements`.`id`
                ,`wallet type`.`id` as `wallet type id`
                ,`movements`.`userid`

                ,`movements`.`data`
                ,`movements`.`value`
                ,`wallet type`.`name`
                ,`wallet type`.`negative`

                FROM `movements` 
                join `wallet type` on `wallet type`.`id` = `movements`.`wallet type id` 
            SQL;

        if (array_key_exists('email', $params)) {
            $sql .= ' WHERE email = :email';
        }
        $return['sql_query'] = $sql;

        $stm = $this->conn->prepare($sql);
        $stm->execute();
        if ($email) {
            $stm->execute(['email' => $email]);
        }

        if ($stm) {
            $return['results'] = $stm->fetchAll(\PDO::FETCH_OBJ);
            $return['row_count'] =
                $stm->rowCount();
        }


        return $return;
    }
}