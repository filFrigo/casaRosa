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
        $email = getKeyInArray($params, 'email', null);
        $return['email_passed'] = $email;

        $sql = 'select * from users';
        if (array_key_exists('email', $params)) {
            $sql .= ' WHERE email = :email';
        }
        $return['sql_query'] = $sql;

        $stm = $this->conn->prepare($sql);
        $stm->execute();
        if ($params['email']) {
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