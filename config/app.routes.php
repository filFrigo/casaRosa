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
      'talks' => 'controllers\main@displayTalks',

      'wallet' => 'controllers\main@displayWallet',
      'spaces' => 'controllers\main@displaySpaces',

      'config/zone' => 'controllers\main@displayConfigZone',
      'config/areas' => 'controllers\main@displayConfigArea',
      'config/users' => 'controllers\main@displayConfigUsers',

      'logout' => 'controllers\api@logout',

      'api/zones' => 'controllers\api@getZones',
      'api/zones_allowed' => 'controllers\api@getZonesAllowed',
      'api/zones/:id' => 'controllers\api@getZones',
      'api/changeZone/:id' => 'controllers\api@changeZone',

      'api/areas' => 'controllers\api@getAreas',

      // 'api/getUsers' => 'controllers\api@getUsers',
      'api/getUsersZone' => 'controllers\api@getUsersZone',


      'api/getMovements' => 'controllers\api@getMovements',
      'api/getDashboardReports' => 'controllers\api@getDashboardReports',

      'api/getTypeMovements' => 'controllers\api@getTypeMovements',
      'api/getTypeMovements/:typeMovements' => 'controllers\api@getTypeMovements',

    ],
    'POST' => [
      'api/login' => 'controllers\api@login',

      'api/storeMovement' => 'controllers\api@storeMovement',

      'api/storeUser' => 'controllers\api@storeUser',

    ]
  ],
];