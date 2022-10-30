<?php

namespace controllers;

use models\users;

class api
{
    public $conn = '';


    public function __construct(\PDO $conn)
    {
        $this->data['appParams'] = getKeyInArray(load('/config/app.params.php'), 'appParams');
        $this->conn = $conn;
    }


    public function login()
    {

        $json = json_decode(file_get_contents('php://input'));


        // Verifico login e password
        $login = $json->login;
        $password = $json->password;

        // preparo la risposta
        $results = [
            'success' => false,
            'message' => 'Accesso non riuscito',
            // 'temp_data' => [$login, $password]
        ];

        // cerco la login tramite email
        $users = new users($this->conn);
        $usersList = $users->getUsers(['email' => $login]);


        if ($usersList['row_count'] < 1) {
            $results['message'] = 'Email non presente';
        }



        // verifico se la password corrisponde
        foreach ($usersList['results']  as $user) {

            if ($user->password == $password) {
                $results['success'] = true;
                // GENERO LA SESSIONE

            } else {
                $results['message'] = 'Password non corretta';
            }
        }

        // rispondo al client:
        header('Content-type: application/json');
        echo json_encode($results);
    }
}