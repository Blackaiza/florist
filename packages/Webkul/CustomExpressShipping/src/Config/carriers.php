<?php

return [
    'customexpressshipping' => [
        'code'         => 'customexpressshipping',
        'title'        => 'CustomExpressShipping',
        'description'  => 'CustomExpressShipping',
        'active'       => true,
        'default_rate' => '30',
        'type'         => 'per_unit',
        'class'        => 'Webkul\CustomExpressShipping\Carriers\CustomExpressShipping',
    ],
];
