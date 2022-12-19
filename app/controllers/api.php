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
                // distruggo la password
                unset($user->password);

                $zones = new zones($this->conn);
                $zones = $zones->getUserZone($user->id);

                // TODO: genero i dati di sessione
                $_SESSION["userLogin"] = 'true';
                $_SESSION["userData"] = [
                    'email' => $login,
                    'user_id' => $user->id,
                    'user_name' => $user->nome,
                    'user_surname' => $user->cognome,
                    'zones_allowed' => $zones['allowed'],
                    'zone_id' => $zones['default']['id'],
                    'zone_clientid' => $zones['default']['zone_clientid'],
                    'zone_name' => $zones['default']['zone_name'],
                ];
            } else {
                $results['message'] = 'Password non corretta';
            }
        }




        // rispondo al client:
        header('Content-type: application/json');
        echo json_encode($results);
    }

    public function logout()
    {
        session_destroy();
        // rispondo al client:
        header('Content-type: application/json');
        echo json_encode(['logout_user' => true]);
    }


    public function getZones($zoneid = 0)
    {
        $session = getKeyInArray($_SESSION, 'userData', []);

        if ($zoneid == 0) {
            $zoneid = getKeyInArray($session, 'zone_id', 0);
        }

        $zones = new zones($this->conn);
        $listOFZones = $zones->getZones(['id' => $zoneid]);


        $results = [
            'list_of_zones' => $listOFZones['results'],
            'number_of_zones' => $listOFZones['row_count'],
            // 'debug' => $listOFZones
        ];

        // rispondo al client:
        header('Content-type: application/json');
        echo json_encode($results);
    }

    public function getZonesAllowed()
    {
        $session = getKeyInArray($_SESSION, 'userData', []);
        $zones = getKeyInArray($session, 'zones_allowed', []);

        // rispondo al client:
        header('Content-type: application/json');
        echo json_encode(['list_of_zones' => $zones]);
    }

    // CAMBIA IL FOCUS DELLA ZONA
    public function changeZone($zoneid = 0)
    {
        $zones = new zones($this->conn);
        $zoneData = $zones->getZones(['id' => $zoneid]);
        $zone = $zoneData['results'][0];

        // FIXME: verifica se posso visualizzare la zona
        $_SESSION['userData']['zone_id'] = $zone->id;
        $_SESSION['userData']['zone_clientid'] = $zone->clientid;
        $_SESSION['userData']['zone_name'] = $zone->name;

        // rispondo al client:
        header('Content-type: application/json');
        echo json_encode(['state' => true]);
    }

    public function getAreas()
    {
        $zones = new zones($this->conn);
        $listOFAreas = $zones->getAreas();


        $wallet = new wallet($this->conn);
        $expese = $wallet->getMovements(['expense'=>true]);

        $results = [
            //'list_of_areas_old' => $listOFAreas['results'],
            'number_of_areas' => $listOFAreas['row_count'],
            'report_expese_mov' => $expese['results'],
            'report_expese_tot' => $expese['sum'],
            'expese_area' => $expese['sum'] / $listOFAreas['row_count']
        ];
        

        
        // CR_20 ➡ aggiungere gli utenti dell'area
        
        //$results['list_of_users'] = [];
        foreach ($listOFAreas['results'] as $area) {
            
            // Recupero gli utenti nell'area
            //$areas_istance = new areas($this->conn);
            $usersOnArea = $zones->getUserinArea($area->id);


            $results['list_of_areas'][$area->id] = [
                'area_id' => $area->id,
                'zone_id' => $area->zoneid,
                'description' => $area->description,
                'civic' => $area->civic,
                'users' => $usersOnArea['results'],
            ];

        }




        // rispondo al client:
        header('Content-type: application/json');
        echo json_encode($results);
    }

    // public function getUsers()
    // {
    //     // carico gli utenti
    //     $users = new users($this->conn);
    //     $usersList = $users->getUsers();


    //     $results = [
    //         'list_of_users' => $usersList['results'],
    //         'number_of_users' => $usersList['row_count']
    //     ];

    //     // rispondo al client:
    //     header('Content-type: application/json');
    //     echo json_encode($results);
    // }

    // Permette di recuperare gli utenti che sono nella zona ASSOCIATI
    public function getUsersZone()
    {
        // carico gli utenti
        $users = new users($this->conn);
        $usersList = $users->getUsersZone();


        $results = [
            'list_of_users' => $usersList,
            // 'number_of_users' => $usersList['row_count']
        ];

        // rispondo al client:
        header('Content-type: application/json');
        echo json_encode($results);
    }

    public function getUsers()
    {
        // carico gli utenti
        $users = new users($this->conn);
        $usersList = $users->getUsersZone();


        $results = [
            'list_of_users' => $usersList,
            // 'number_of_users' => $usersList['row_count']
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

        // salva i dati sul database
        $wallet = new wallet($this->conn);
        $istance = $wallet->storeMovement($json);

        if (!$istance['last_id']) {
            $result['message'] = 'Inserimento non valido';
        } else {
            $result['last_id'] = $istance['last_id'];
            $result['last_mov_data'] = $istance['last_mov_data'];
            $result['state'] = true;
        }

        // rispondo al client:
        header('Content-type: application/json');
        echo json_encode($result);
    }

    public function getMovementTotal()
    {
        $wallet = new wallet($this->conn);
        $result = $wallet->getMovementsTotal();
        // rispondo al client:
        header('Content-type: application/json');
        echo json_encode(['movement_total' => $result['results']['total']]);
    }


    public function storeUser()
    {
        // rispondo al client:
        header('Content-type: application/json');

        $json = json_decode(file_get_contents('php://input'));
        $hasError= false;

        $dataObject = $json->localData;

        $result = [
            'state' => false,
            'message' => 'Errore generico',
            'data_stored' => $json,
        ];


        // validare i dati ricevuti
        $email = $dataObject->email;
        $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
        if (!preg_match($pattern, $email) || empty($email)) {
           $result['message'] = 'email non valida';
           // $hasError = true; // ❌ Tolgo la verifica della email
        }

        $surname = $dataObject->surname;
        if (!preg_match('/^[A-Za-z]*$/', $surname)|| empty($surname)) {
            $result['message'] = 'cognome non valido';
            $hasError = true;
        }

        $name = $dataObject->name;
        if (!preg_match('/^[A-Za-z]*$/', $name) || empty($name)) {
            $result['message'] = 'nome non valido';  
            $hasError = true;    

        }
        
        
        // #CR-5 Salva i dati sul db ➡ Se sono riuscito
              if (!$hasError) {
                    $users = new users($this->conn);
                    $user_istance = $users->storeUser(['user_name'=>$name,'user_surname'=>$surname,'user_email'=>$email ]);
                    $user_id  = $user_istance['last_id'];  // ID dell'utente appena creato
                    $result['new_user'] = [
                        'name' => $name,
                        'surname' => $surname,
                        'email' => $email,
                        'id' => $user_id,
                    ];


                    $zone_id =  $_SESSION["userData"]['zone_id'];
                    $zone_istance = $users->allowZone(['user_id'=>$user_id,'zone_id'=>$zone_id]);
                    
                    $result['state'] = true;
                    $result['message'] = '';
              }
            
        

        echo json_encode($result);
    }
}