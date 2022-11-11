<?php

namespace models;


class zones
{
    public $conn = '';


    public function __construct(\PDO $conn)
    {
        $this->data['appParams'] = getKeyInArray(load('/config/app.params.php'), 'appParams');
        $this->conn = $conn;
    }

    public function getZones(array $params = [])
    {
        $id = getKeyInArray($params, 'id', 0);
        $return['id_passed'] = $id;

        $sql = 'select * from zones WHERE id > 0';
        if ($id > 0) {
            $sql .= ' AND id = :id';
        }
        $return['sql_query'] = $sql;

        $stm = $this->conn->prepare($sql);
        $stm->execute();
        if ($id > 0) {
            $stm->execute(['id' => $id]);
        }

        if ($stm) {
            $return['results'] = $stm->fetchAll(\PDO::FETCH_OBJ);
            $return['row_count'] =
                $stm->rowCount();
        }


        return $return;
    }

    public function getAreas(array $params = [])
    {
        $session = getKeyInArray($_SESSION, 'userData', []);
        $zoneid = getKeyInArray($session, 'zone_id', 0);

        $id = getKeyInArray($params, 'id', 0);
        $userid = getKeyInArray($params, 'userid', 0);
        $return['id_passed'] = $id;

        $sql = 'select * from areas WHERE zoneid = :zoneid';
        if (array_key_exists('id', $params)) {
            $sql .= ' AND id = :id';
        }
        if ($userid > 0) {
            $sql .= ' AND userid = :userid';
        }
        $return['sql_query'] = $sql;

        $stm = $this->conn->prepare($sql);

        $stm->bindParam(':zoneid', $zoneid);
        if ($id > 0) {
            $stm->bindParam('id', $id);
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


    public function getUserZone($userid)
    {

        // $session = getKeyInArray($_SESSION, 'userData', []);
        // $zoneid = getKeyInArray($session, 'zone_id', 0);


        $userid = $userid ?? 0;
        $return['id_passed'] = $userid;

        $sql = 'select zoneid from usersZone WHERE id > 0';
        if ($userid > 0) {
            $sql .= ' AND userid = :userid';
        }

        $return['sql_query'] = $sql;

        $stm = $this->conn->prepare($sql);
        // $stm->bindParam(':zoneid', $zoneid);
        if ($userid > 0) {
            $stm->bindParam('userid', $userid);
        }
        $stm->execute();

        if ($stm) {
            $return['results'] = $stm->fetchAll(\PDO::FETCH_COLUMN);
            $return['row_count'] =
                $stm->rowCount();
        }


        $zonesAllowed = [];
        foreach ($return['results'] as $userZone) {



            $zoneid_allowed = $userZone;
            // Recupero i dati della zona
            $zone_data = $this->getZones(['id' => $zoneid_allowed]);
            // Creo l'array
            $zonesAllowed[] = [
                'id' => $zoneid_allowed,
                'zone_clientid' => $zone_data['results'][0]->clientid,
                'zone_name' => $zone_data['results'][0]->name,
            ];
        }

        // $areas = $this->getAreas(['userid' => $userid]);

        // $zonesAllowed = [];
        // foreach ($areas['results'] as $userArea) {
        //     $zoneid_allowed = $userArea->zonesid;
        //     // Recupero i dati della zona
        //     $zone_data = $this->getZones(['id' => $zoneid_allowed]);
        //     // Creo l'array
        //     $zonesAllowed[] = [
        //         'id' => $zoneid_allowed,
        //         'zone_clientid' => $zone_data['results'][0]->clientid,
        //         'zone_name' => $zone_data['results'][0]->name,
        //     ];
        // }

        $zones_default = $zonesAllowed[0];


        return ['allowed' => $zonesAllowed, 'default' => $zones_default];
    }
}
