<?php

declare(strict_types=1);

return [

    'default' => env('IP_GEOLOCATION_DRIVER', 'null'),

    'drivers' => [

        'ip2loc' => [
            'token' => env('IP2LOC_API_TOKEN'),
        ],

    ],

    'features' => [

        /**
         * Laravel's about command provides useful information regarding the state of
         * your Laravel application. If `about_command` is set to true, we will show
         * useful information about IP Geolocation  in about command output.
         */
        'about_command' => true,

    ]

];
