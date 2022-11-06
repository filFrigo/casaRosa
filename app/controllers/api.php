<?php

namespace controllers;

use models\users;
use models\zones;
use models\wallet;

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


    public function getZones($id = 0)
    {
        $zones = new zones($this->conn);
        $listOFZones = $zones->getZones(['id' => $id]);


        $results = [
            'list_of_zones' => $listOFZones['results'],
            'number_of_zones' => $listOFZones['row_count'],
            // 'debug' => $listOFZones
        ];

        // rispondo al client:
        header('Content-type: application/json');
        echo json_encode($results);
    }

    public function getAreas()
    {
        $zones = new zones($this->conn);
        $listOFAreas = $zones->getAreas();


        $results = [
            'list_of_areas' => $listOFAreas['results'],
            'number_of_areas' => $listOFAreas['row_count']
        ];

        // rispondo al client:
        header('Content-type: application/json');
        echo json_encode($results);
    }

    public function getUsers()
    {
        // carico gli utenti
        $users = new users($this->conn);
        $usersList = $users->getUsers();


        $results = [
            'list_of_users' => $usersList['results'],
            'number_of_users' => $usersList['row_count']
        ];

        // rispondo al client:
        header('Content-type: application/json');
        echo json_encode($results);
    }

    public function getMovements()
    {
        // carico i movimenti
        $movements = new wallet($this->conn);
        $movementsLists = $movements->getMovements();


        $results = [
            'list_of_movements' => $movementsLists['results'],
            'number_of_movements' => $movementsLists['row_count']
        ];

        // rispondo al client:
        header('Content-type: application/json');
        echo json_encode($results);
    }

    public function getTypeMovements($typeMovement = null)
    {
        // carico le categorie
        $categories = new wallet($this->conn);
        $categoriesList = $categories->getWalletType(['typeMovement' => $typeMovement]);

        $results = [
            'type_movements' => $typeMovement,
            'list_of_category' => $categoriesList['results'],
            // 'debug_query_data' => $categoriesList
        ];

        // rispondo al client:
        header('Content-type: application/json');
        echo json_encode($results);
    }

    public function storeMovement()
    {

        $json = json_decode(file_get_contents('php://input'));

        $result = [
            'state' => false,
            'message' => '',
            'data_stored' => $json
        ];

        // TODO: salva i dati sul database
        $wallet = new wallet($this->conn);
        $istance = $wallet->storeMovement($json);

        if (!$istance['last_id']) {
            $result['message'] = 'Inserimento non valido';
        } else {
            $result['last_id'] = $istance['last_id'];
            $result['state'] = true;
        }

        // rispondo al client:
        header('Content-type: application/json');
        echo json_encode($result);
    }
}