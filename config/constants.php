<?php

return [
    'imagePath' => [
        'CompanyImage' => 'public/company/',
        'Driver' => 'local'
    ],
    'defaultImage' => [
        'default' => config("app.image_url")."assets/default/default.png"
        //'default' => asset('assets/default/default.png'),
    ],
];

