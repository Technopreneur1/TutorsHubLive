<?php
return [
    'client_id' => env('PAYPAL_CLIENT_ID','AVFwGL9zZBOvXXI-5fXKpcqWOnd2GqobVOea8jUASQXy7eqtnTiQZxAxt2iaOt_nDSVHMShjxdt3fOrE'),
    'secret' => env('PAYPAL_SECRET','EFi_mXhQm4XLDXt47D1iaWA0eB0klTqIirlZU-_HHWPLuKo9SsxQSpa7jA8_0viHHl3m1NdHNPVEcPMZ'),
    'settings' => array(
        'mode' => env('PAYPAL_MODE','live'),
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'ERROR'
    ),
];