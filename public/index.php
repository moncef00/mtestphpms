<?php
require __DIR__ . '/../vendor/autoload.php';

use App\controllers\TravelController;

$controller = new TravelController();
$controller->displayItinerary();