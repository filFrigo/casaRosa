<?php

return [
  'routes' =>
  [
    'GET' => [
      /*  mainController */
      '' =>
      'controllers\main@displayHome',
      'login' => 'controllers\main@displayLogin',
      'dashboard' => 'controllers\main@displayDashboard',
    ],
    'POST' => [
      'api/login' => 'controllers\api@login',
    ]
  ],
];