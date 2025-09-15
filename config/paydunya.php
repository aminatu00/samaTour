<?php

return [
    'merchant_key' => env('PAYDUNYA_MERCHANT_KEY'),
    'public_key'   => env('PAYDUNYA_PUBLIC_KEY'),
    'private_key'  => env('PAYDUNYA_PRIVATE_KEY'),
    'mode'         => env('PAYDUNYA_MODE', 'sandbox'),
];
