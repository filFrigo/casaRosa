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
        $id = getKeyInArray($params, 'id', 0);
        // $return['id_passed'] = $id;

        $session = getKeyInArray($_SESSION, 'userData', []);
        $zoneid = getKeyInArray($session, 'zone_id', 0);

        $onlyExpense = getKeyInArray($params, 'expense', false);

        $sql = <<<'SQL'
                SELECT `movements`.`id` 
                ,`wallet type`.`id` as `walletTypeId`
                ,`movements`.`userid`
                ,`movements`.`data` as `datetime`
                ,`movements`.`value`
                ,`wallet type`.`name`
                ,`wallet type`.`negative`
                FROM `movements` 
                join `wallet type` on `wallet type`.`id` = `movements`.`wallet type id`
                WHERE `movements`.`zoneid` = :zoneid
            SQL;
        if ($id > 0) {
            $sql .= ' AND `movements`.`id` = :id ';
        }
        if ($onlyExpense) {
            $sql .= ' AND `wallet type`.`negative` = 1 ';
        }
        $sql .= ' order by `movements`.`data` desc';

        // $return['sql_query'] = $sql;

        $stm = $this->conn->prepare($sql);

        $stm->bindParam(':zoneid', $zoneid);

        if ($id > 0) {
            $stm->bindParam(':id', $id);
            // $stm->execute(['id' => $id]);
        }
        $stm->execute();

        if ($stm) {
            $return['results'] = $stm->fetchAll(\PDO::FETCH_OBJ);
            $return['row_count'] =
                $stm->rowCount();
        }

        $return['sum'] = 0;
        foreach ($return['results'] as $value) {
            $return['sum'] = $return['sum'] + $value->value;
        }


        return $return;
    }

    // SERVE PER: recuperare le categorie
    public function getWalletType(array $params = [])
    {
        $id = getKeyInArray($params, 'id', 0);
        $return['id_passed'] = $id;

        $session = getKeyInArray($_SESSION, 'userData', []);
        $zoneid = getKeyInArray($session, 'zone_id', 0);

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
                WHERE zonesid = :zoneid
            SQL;
        if ($id > 0) {
            $sql .= ' AND id = :id';
        }
        if ($negative > -1) {
            $sql .= ' AND negative = :negative';
        }
        $return['sql_query'] = $sql;

        $stm = $this->conn->prepare($sql);

        $stm->bindParam(':zoneid', $zoneid);

        if ($id > 0) {
            $stm->bindParam(':id', $id);
        }
        if ($negative > -1) {
            $stm->bindParam(':negative', $negative);
        }
        $stm->execute();

        if ($stm) {
            $return['results'] = $stm->fetchAll(\PDO::FETCH_OBJ);
            $return['row_count'] =
                $stm->rowCount();
        }


        return $return;
    }


    function storeMovement($json)
    {
        // REcupero la sessione
        $session = getKeyInArray($_SESSION, 'userData', []);
        $zoneid = getKeyInArray($session, 'zone_id', 0);

        $return['error'] = '';
        $data = $json->localData;
        // $return['data_passed'] = $data;

        $date = $data->data; //'2022-11-05 15:37:39.000000'
        // TODO: VERIFICA DELLA DATA

        // VERIFICA DELL'IMPORTO
        $temp_value =  $data->value;
        $return['error'] = 'Inserisci un inporto valido';
        // $value = ;
        $has_comma = strpos($temp_value, ',');
        $has_point = strpos($temp_value, '.');

        // VERIFICO SE L'importo ha sia la virgola sia i punti => segnalo l'errore.
        if ($has_comma && $has_point) {
            return $return;
        }

        // Se non ho decimali, moltiplico per 100
        if (!$has_comma && !$has_point) {
            $value = $temp_value * 100;
        }

        // Formatto i valori se hanno un decimale
        $has_comma ? $value =  transformDecimal($temp_value, ',') : 0;
        $has_point ? $value = transformDecimal($temp_value, '.') : 0;



        $category = (int) $data->category;
        // FIXME: Verifica il segno del movimento
        $category_data = $this->getWalletType(['id' => $category]);

        if ($category_data['row_count'] > 0) {
            $is_negative = $category_data['results'][0]->negative;

            // Se la categoria è negativa, trasformo il numero in negativo
            $is_negative ? $value = ((int)$value) * -1 : '';
        } else {
            // Se non trovo dati sulla query genero un errore.
            $return['error'] = 'Categoria Inesistente';
            return $return;
        }

        // FIXME: recupera l'userid dalla sessione
        $userid = 1;


        $sql = <<<'SQL'
                INSERT INTO `movements` (`id`,`zoneid`, `data`, `wallet type id` , `value`, `userid`) 
                VALUES (NULL, :zoneid, :date, :category, :value, :userid);
            SQL;
        // $return['sql_query'] = $sql;

        $stm = $this->conn->prepare($sql);

        $stm->bindParam(':zoneid', $zoneid);
        $stm->bindParam(':date', $date);
        $stm->bindParam(':category', $category);
        $stm->bindParam(':value', $value);
        $stm->bindParam(':userid', $userid);

        $stm->execute();



        if ($stm) {
            $return['results'] = $stm->fetchAll(\PDO::FETCH_OBJ);
            $return['row_count'] =
                $stm->rowCount();

            $last_id = (int) $this->conn->lastInsertId();
            if ($last_id > 0) {
                $return['last_id'] = $last_id;
                $return['last_mov_data'] = $this->getMovements(['id' => $return['last_id']]);
            }
        }

        return $return;
    }



    // Somma dei movimenti
    public function getMovementsTotal(array $params = [])
    {
        $session = getKeyInArray($_SESSION, 'userData', []);
        $zoneid = getKeyInArray($session, 'zone_id', 0);

        $sql = <<<'SQL'
                SELECT sum(value) as `total` FROM `movements`
                where `zoneid` = :zoneid;
            SQL;
        $stm = $this->conn->prepare($sql);
        $stm->bindParam(':zoneid', $zoneid);
        $stm->execute();

        if ($stm) {
            $return['results'] = $stm->fetch(\PDO::FETCH_ASSOC);
        }

        return $return;
    }
}