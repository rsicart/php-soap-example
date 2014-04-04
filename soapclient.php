<?php

$sc = new SoapClient(
	null, 
	['location' => 'http://localhost/soapserver.php',
	'uri' => 'urn://test/rsicart'
	]
);

$res = $sc->__soapCall('getTrackingItems', []);

print_r($res);
