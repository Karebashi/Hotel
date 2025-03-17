<?php
require __DIR__ . '/../../vendor/autoload.php';

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

$apiContext = new ApiContext(
    new OAuthTokenCredential(
        'AbphnY12XQG-n0zn0xukrRcOm8ttL8QUk5FbmNmCbScZcast6N47oQrnkojmt8BvGoSqgecDoNwhAOoa', // ClientID
        'EMcl-FiFgh-a6OOgDXHtV7ks6DayXK3klsulYKixVcHMqQCUQBxSYN9cQ3-6e9NzXxOgJySMJ0mFr--j' // ClientSecret
    )
);

$apiContext->setConfig(
    array(
        'mode' => 'sandbox', // or 'live'
        'log.LogEnabled' => true,
        'log.FileName' => '../PayPal.log',
        'log.LogLevel' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
        'cache.enabled' => true,
    )
);
?>