<?php

/*
 * Configuration  Monetico
 */
return [
    'service_version' => env('MONETICO_SERVICE_VERSION', '3.0'),
    'main_request_url' => env('MONETICO_MAIN_REQUEST_URL',  'https://p.monetico-services.com'),
    'misc_request_url' => env('MONETICO_MISC_REQUEST_URLL',  'https://payment-api.e-i.com'),

    /* OBLIGATIORE dans les fichier .env */

    'ept_code' => env('MONETICO_EPT_CODE', null),
    'security_key' => env('MONETICO_SECURITY_KEY', null),
    'company_code' => env('MONETICO_COMPAGNY_CODE', null),
];