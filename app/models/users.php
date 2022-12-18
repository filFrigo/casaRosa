<?php

namespace models;


class users
{
    public $conn = '';


    public function __construct(\PDO $conn)
    {
        $this->data['appParams'] = getKeyInArray(load('/config/app.params.php'), 'appParams');
        $this->conn = $conn;
    }



    public function getUsers(array $params = [])
    {
        $email = getKeyInArray($params, 'email', '');
        $userid = getKeyInArray($params, 'userid', 0);
        $return['email_passed'] = $email;

        $sql = 'select * from users WHERE id > 0';
        if (array_key_exists('email', $params)) {
            $sql .= ' AND email = :email';
        }
        if ($userid > 0) {
            $sql .= ' AND id = :userid';
        }

        $return['sql_query'] = $sql;

        $stm = $this->conn->prepare($sql);

        // $stm->bindParam(':zoneid', $zoneid);
        if ($email) {
            $stm->bindParam('email', $email);
        }
        if ($userid > 0) {
            $stm->bindParam('userid', $userid);
        }
        $stm->execute();

        if ($stm) {
            $return['results'] = $stm->fetchAll(\PDO::FETCH_OBJ);
            $return['row_count'] =
                $stm->rowCount();
        }


        return $return;
    }

    public function getUsersZone(array $params = [])
    {
        $session = getKeyInArray($_SESSION, 'userData', []);
        $zoneid = getKeyInArray($session, 'zone_id', 0);

        //  A
        //$sql = 'select userid from areas WHERE userid = :zoneid';
        $sql = 'SELECT userid FROM `usersZone` where zoneid = :zoneid';
        $return['sql_query'] = $sql;

        $stm = $this->conn->prepare($sql);
        $stm->bindParam(':zoneid', $zoneid);
        $stm->execute();

        if ($stm) {
            $return['results'] = $stm->fetchAll(\PDO::FETCH_COLUMN);
        }

        $users = [];
        foreach ($return['results'] as $userid) {
            // $user
            $userdata = $this->getUsers(['userid' => $userid]);
            $users[] = $userdata['results'][0];
        }
        // TODO: Aggiungere gli amministratori

        return $users;
    }

    // Funzione di salvataggio un un nuovo utente
    public function storeUser(array $params = [])
    {
        $user_name = getKeyInArray($params, 'user_name', '');
        $user_surname = getKeyInArray($params, 'user_surname', '');
        $user_email = getKeyInArray($params, 'user_email', '');
        $user_user_pwd = getKeyInArray($params, 'user_pwd', NULL);



        $sql = 'INSERT INTO `users` (`id`, `nome`, `cognome`, `email`, `password`) VALUES (NULL, :user_name, :user_surname, :user_email, :user_pwd)';
        $return['sql_query'] = $sql;

        $stm = $this->conn->prepare($sql);


        $stm->bindParam('user_name', $user_name);
        $stm->bindParam('user_surname', $user_surname);
        $stm->bindParam('user_email', $user_email);
        $stm->bindParam('user_pwd', $user_pwd);
        $stm->execute();

        if ($stm) {
            $return['results'] = $stm->fetchAll(\PDO::FETCH_COLUMN);
            $return['row_count'] = $stm->rowCount();
            $return['last_id'] = $this->conn->lastInsertId();
        }


        return $return;
    }


    // Funzione che permette di abilitare un utente ad una zona
    public function allowZone(array $params = [])
    {
        $user_id = (int)getKeyInArray($params, 'user_id', 0);
        $zone_id = (int)getKeyInArray($params, 'zone_id', 0);

        $sql = 'INSERT INTO `usersZone` (`id`, `userid`, `zoneid`) VALUES (NULL, :user_id, :zone_id)';
        $return['sql_query'] = $sql;

        $stm = $this->conn->prepare($sql);


        $stm->bindParam('user_id', $user_id);
        $stm->bindParam('zone_id', $zone_id);
        $stm->execute();

        if ($stm) {
            $return['results'] = $stm->fetchAll(\PDO::FETCH_COLUMN);
            $return['row_count'] = $stm->rowCount();
            $return['last_id'] = $this->conn->lastInsertId();
        }

        return $return;
    }

    // Funzione che permette di abilitare un utente ad una zona
    public function allowArea(array $params = [])
    {
        $user_id = (int)getKeyInArray($params, 'user_id', 0);
        $area_id = (int)getKeyInArray($params, 'area_id', 0);

        $sql = 'INSERT INTO `usersArea` (`id`, `userid`, `areaid`) VALUES (NULL, :user_id, :area_id)';
        $return['sql_query'] = $sql;

        $stm = $this->conn->prepare($sql);


        $stm->bindParam('user_id', $user_id);
        $stm->bindParam('area_id', $area_id);
        $stm->execute();

        if ($stm) {
            $return['results'] = $stm->fetchAll(\PDO::FETCH_COLUMN);
            $return['row_count'] = $stm->rowCount();
            $return['last_id'] = $this->conn->lastInsertId();
        }

        return $return;
    }

}