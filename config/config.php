<?php

return [
    "enabled" => env('SMSFLY_ENABLED', false),
    "api_key" => env('SMSFLY_API_KEY', ''),
    "channel" => env('SMSFLY_CHANNEL', 'sms'),
    "name_sms" => env('SMSFLY_SMS_NAME', ''),
    "name_viber" => env('SMSFLY_VIBER_NAME', ''),
    "ttl" => env('SMSFLY_MESSAGE_TTL', 300),
    "priority" => env('SMSFLY_PRIORITY', 1),
    "prefix" => env('SMSFLY_PREFIX', "any"),
    "tags" => env('SMSFLY_TAGS', '#smsfly, #fly'),
    "default" => env('SMSFLY_DEFAULT', false),
    "devmode" => env('SMSFLY_DEVMODE', false),
];
