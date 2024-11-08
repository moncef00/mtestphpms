<?php
namespace App\controllers;

use App\services\TravelSorter;
use App\models\TrainCard;
use App\models\BusCard;
use App\models\FlightCard;


class TravelController {


    public function displayItinerary() {
        $cards = [
        new TrainCard("78A", "Madrid", "Barcelone", "45B"),
        new FlightCard("SK455", "Aéroport de Gérone", "Stockholm", "3A", "45B", "Baggage drop at ticket counter 344."),
        new BusCard("Barcelone", "Aéroport de Gérone"),
        new FlightCard("SK22", "Stockholm", "New York JFK", "7B", "22","Baggage will be automatically transferred from your last leg.")

        ];
        $travelSorter = new TravelSorter();
        $itinerary = $travelSorter->getOrderedItinerary($cards);
        foreach ($itinerary as $step)
        {
            echo $step . '<br>';
        }

    }
}
