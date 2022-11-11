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
        $sql = 'select userid from areas WHERE userid = :zoneid';
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
}