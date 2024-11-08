<?php

use App\services\TravelSorter;
use PHPUnit\Framework\TestCase;
use App\models\TrainCard;
use App\models\BusCard;
use App\models\FlightCard;

use Exception;

/**
 * Classe de test pour TravelSorter.
 * Vérifie le bon ordre de l'itinéraire et la gestion des erreurs.
 */
class TravelSorterTest extends TestCase {

    /**
     * Test de l'itinéraire ordonné avec des cartes valides.
     * Vérifie si l'itinéraire est trié correctement.
     */
    public function testOrderedItinerary() {
        // Création de cartes d'embarquement
        $boardingCards = [
            new TrainCard('78A', 'Madrid', 'Barcelona', '45B'),
            new BusCard('Barcelona', 'Gerona Airport'),
            new FlightCard('SK455', 'Gerona Airport', 'Stockholm', '3A', '45B', 'Baggage drop at ticket counter 344.'),
            new FlightCard('SK22', 'Stockholm', 'New York JFK', '7B', '22', 'Baggage will be automatically transferred from your last leg.')
        ];

        // Initialiser TravelSorter
        $travelSorter = new TravelSorter();

        // Obtenir l'itinéraire ordonné
        $itinerary = $travelSorter->getOrderedItinerary($boardingCards);

        // Résultat attendu
        $expectedItinerary = [
            "Take train 78A from Madrid to Barcelona. Sit in seat 45B.",
            "Take the airport bus from Barcelona to Gerona Airport. No seat assignment.",
            "From Gerona Airport, take flight SK455 to Stockholm. Gate 45B, seat 3A. Baggage drop at ticket counter 344.",
            "From Stockholm, take flight SK22 to New York JFK. Gate 22, seat 7B. Baggage will be automatically transferred from your last leg.",
            "You have arrived at your final destination."
        ];

        // Vérifier si l'itinéraire généré correspond à l'itinéraire attendu
        $this->assertEquals($expectedItinerary, $itinerary);
    }

    /**
     * Test de l'erreur pour un itinéraire incorrect.
     * Vérifie si une exception est levée en cas d'itinéraire sans point de départ unique.
     */
    public function testItineraryWithLoop() {
        // Création de cartes d'embarquement avec une boucle
        $boardingCards = [
            new TrainCard('78A', 'Madrid', 'Barcelona', '45B'),
            new BusCard('Barcelona', 'Gerona Airport'),
            new FlightCard('SK455', 'Gerona Airport', 'Madrid', '3A', '45B', 'Baggage drop at ticket counter 344.')
        ];

        $travelSorter = new TravelSorter();

        // Vérifier si une exception est levée pour une boucle dans l'itinéraire
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Erreur : Impossible de déterminer un point de départ unique ou l'itinéraire contient une boucle.");
        $travelSorter->getOrderedItinerary($boardingCards);
    }

    /**
     * Test avec une carte unique pour vérifier le comportement minimal.
     * Vérifie si une carte unique est traitée correctement.
     */
    public function testSingleCardItinerary() {
        $boardingCards = [
            new TrainCard('78A', 'Madrid', 'Barcelona', '45B')
        ];

        $travelSorter = new TravelSorter();

        // Résultat attendu pour une carte unique
        $expectedItinerary = [
            "Take train 78A from Madrid to Barcelona. Sit in seat 45B.",
            "You have arrived at your final destination."
        ];

        // Vérifier le résultat
        $this->assertEquals($expectedItinerary, $travelSorter->getOrderedItinerary($boardingCards));
    }
}

