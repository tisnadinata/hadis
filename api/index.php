<?php
require 'flight/Flight.php';
require 'api.php';

Flight::route('GET /', 'hello');
Flight::route('POST /', 'getRiwayat');
 
Flight::route('GET /riwayat', 'getRiwayat');
Flight::route('POST /riwayat', 'addRiwayat');

Flight::start();

?>