<?php

return [
  'routes' =>
  [
    'GET' => [
      /*  mainController */
      '' =>
      'controllers\main@displayHome',
      'login' => 'controllers\main@displayLogin',
      'dashboard' => 'controllers\main@displayHome',

      'wallet' => 'controllers\main@displayWallet',

      'config/zone' => 'controllers\main@displayZone',
      'config/areas' => 'controllers\main@displayArea',
      'config/users' => 'controllers\main@displayUsers',



      'api/zones' => 'controllers\api@getZones',
      'api/zones/:id' => 'controllers\api@getZones',

      'api/areas' => 'controllers\api@getAreas',

      'api/getUsers' => 'controllers\api@getUsers',

      'api/getMovements' => 'controllers\api@getMovements',

    ],
    'POST' => [
      'api/login' => 'controllers\api@login',
    ]
  ],
];