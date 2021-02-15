<?php
return [
    'client_id' => env('PAYPAL_CLIENT_ID','AU1qSrl-VvM9r15F6lhSITnPRtJvJwFJfd__J5cMP8FvpXCDcEloTOysg8exK1DZN8rMCsgBXCOUbPFd'),
    'secret' => env('PAYPAL_SECRET','EKKlo3JguTblXRLotwpThMfEMU3aRgaLlvp_beooPlfl3HCPej2pslh8b6E7eSYYZJywHkQtgfMEtuN-'),
    'settings' => array(
        'mode' => env('PAYPAL_MODE','live'),
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'ERROR'
    ),
];
