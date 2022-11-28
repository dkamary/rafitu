<?php

$mode = trim(strtolower(env('PAYPAL_MODE', 'sanbox')));
$isSandbox = ($mode == 'sandbox');
$entrySandbox = env('PAYPAL_ENTRY_SANBOX');
$entryLive = env('PAYPAL_ENTRY_LIVE');

return [
    'mode' => $mode,
    'entry' => $isSandbox ? $entrySandbox : $entryLive,
    'entry_sandbox' => $entrySandbox,
    'entry_live' => $entryLive,
    'account' => env('PAYPAL_ACCOUNT'),
    'client_id' => env('PAYPAL_CLIENT_ID'),
    'secret' => env('PAYPAL_SECRET'),
    'bn_code' => env('PAYPAL_BN_CODE'),
    'plateform_partner_app' => env('PAYPAL_PLATEFORM_PARTNER_APP'),
];
