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

                ,`movements`.`data` as `datetime`
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


    public function getWalletType(array $params = [])
    {
        $id = getKeyInArray($params, 'id', 0);
        $return['id_passed'] = $id;

        $typeMovements = getKeyInArray($params, 'typeMovement', -1);
        $return['typeMovement_passed'] = $typeMovements;

        switch ($typeMovements) {
            case 'expense':
                $negative = 1;
                break;
            case 'entrance':
                $negative = 0;
                break;
            default:
                $negative = -1;
                break;
        }
        $return['negative_passed'] = $negative;

        //FIXME imposta la zoneid dalla sessione
        $sql = <<<'SQL'
                SELECT * FROM `wallet type`
                WHERE zonesid > 0
            SQL;
        if ($id > 0) {
            $sql .= ' AND id = :id';
        }
        if ($negative > -1) {
            $sql .= ' AND negative = :negative';
        }
        $return['sql_query'] = $sql;

        $stm = $this->conn->prepare($sql);
        $stm->execute();
        if ($id > 0) {
            $stm->execute(['id' => $id]);
        }
        if ($negative > -1) {
            $stm->execute(['negative' => $negative]);
        }

        if ($stm) {
            $return['results'] = $stm->fetchAll(\PDO::FETCH_OBJ);
            $return['row_count'] =
                $stm->rowCount();
        }


        return $return;
    }
}