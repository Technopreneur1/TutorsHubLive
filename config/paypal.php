<?php
return [
    'client_id' => env('PAYPAL_CLIENT_ID','AQJBgbxwGJkhuDwcblLfVwPq6TnDpAliMv5_HllIFnJ5l-Im6Sv5VK30SV8j7TSLUEYKYBCdTcamB-2K'),
    'secret' => env('PAYPAL_SECRET','EJtPudodmm0Uyad76GqHHubqQ1TZyrQba9d4UowCy_B0jwTiKojd02sObDUV2Wdbnu_36688L2kD0sDP'),
    'settings' => array(
        'mode' => env('PAYPAL_MODE','live'),
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'ERROR'
    ),
];