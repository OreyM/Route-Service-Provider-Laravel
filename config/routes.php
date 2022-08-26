<?php
 return [
     'backend' => [
         'web' => [
             'path' => 'backend/web',
             'prefix' => 'admin',
             'as' => 'admin',
         ],
         'api' => [
             'path' => 'backend/api/v1',
             'prefix' => 'backend/api/v1',
             'as' => 'backend.api.v1',
         ],
     ],
     'frontend' => [
         'web' => [
             'path' => 'frontend/web',
             'prefix' => '',
             'as' => 'frontend',
         ],
         'api' => [
             'path' => 'frontend/api/v1',
             'prefix' => 'api/v1',
             'as' => 'frontend.api.v1',
         ],
     ],
 ];
