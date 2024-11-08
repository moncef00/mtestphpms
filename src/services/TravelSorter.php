<?php
namespace App\services;

use App\models\BoardingCard;
use App\models\FlightCard;
use App\models\TrainCard;
use App\models\BusCard;

use Exception;

/**
 * Classe TravelSorter
 * Responsable du tri des cartes d'embarquement et de la génération de l'itinéraire.
 */
class TravelSorter {

    /**
     * Méthode principale pour obtenir l'itinéraire trié.
     *
     * @param BoardingCard[] $boardingCards Un tableau de cartes d'embarquement.
     * @return array Un tableau d'étapes du voyage.
     * @throws Exception Si l'itinéraire contient une boucle ou n'a pas de point de départ unique.
     */
    public function getOrderedItinerary(array $boardingCards): array {
        // Trier les cartes d'embarquement dans l'ordre du voyage
        $sortedCards = $this->sortBoardingCards($boardingCards);

        // Si aucun itinéraire valide n'a été trouvé, lance une exception
        if ($sortedCards === null) {
            throw new Exception("Erreur : Impossible de déterminer un point de départ unique ou l'itinéraire contient une boucle.");
        }

        // Générer la description complète de l'itinéraire
        return $this->generateItineraryDescription($sortedCards);
    }

    /**
     * Trie les cartes d'embarquement dans l'ordre chronologique.
     *
     * @param BoardingCard[] $cards Un tableau de cartes d'embarquement.
     * @return BoardingCard[]|null Un tableau de cartes triées, ou null si une erreur de boucle est détectée.
     */
    private function sortBoardingCards(array $cards): ?array {
        $departureMap = [];
        $arrivalMap = [];

        // Crée une carte de départ et d'arrivée
        foreach ($cards as $card) {
            $departureMap[$card->getDeparture()] = $card;
            $arrivalMap[$card->getArrival()] = $card;
        }

        // Trouve la ville de départ unique
        $startCity = $this->findStartCity($departureMap, $arrivalMap);
        if ($startCity === null) {
            return null; // Aucun point de départ unique trouvé, on retourne null
        }

        $orderedCards = [];
        $visited = [];

        // Trie les cartes en suivant l'ordre des départs et arrivées
        while (isset($departureMap[$startCity])) {
            if (in_array($startCity, $visited)) {
                return null; // Détection d'une boucle, retourne null
            }

            $currentCard = $departureMap[$startCity];
            $orderedCards[] = $currentCard;
            $visited[] = $startCity;

            // Mise à jour de la ville de départ pour la prochaine étape
            $startCity = $currentCard->getArrival();
        }

        return $orderedCards;
    }

    /**
     * Trouve la ville de départ unique dans les cartes d'embarquement.
     *
     * @param array $departureMap Un tableau des cartes d'embarquement, indexé par ville de départ.
     * @param array $arrivalMap Un tableau des cartes d'embarquement, indexé par ville d'arrivée.
     * @return string|null La ville de départ unique, ou null si elle n'existe pas.
     */
    private function findStartCity(array $departureMap, array $arrivalMap): ?string {
        foreach ($departureMap as $city => $card) {
            if (!isset($arrivalMap[$city])) {
                return $city; // Ville de départ sans correspondance dans les arrivées
            }
        }
        return null;
    }

    /**
     * Génère une description complète de l'itinéraire trié.
     *
     * @param BoardingCard[] $sortedCards Un tableau de cartes triées.
     * @return array Un tableau de descriptions d'étapes de voyage.
     */
    private function generateItineraryDescription(array $sortedCards): array {
        $itinerary = [];

        // Parcours chaque carte d'embarquement triée et génère sa description
        foreach ($sortedCards as $card) {
            // Initialisation de la description de base
            if ($card instanceof FlightCard) {
                $description = "From " . $card->getDeparture() . ", take flight " . $card->getFlightNumber() . " to " . $card->getArrival() . ". Gate " . $card->getGate() . ", seat " . $card->getSeat() . ". " . $card->getBaggage();
            } elseif ($card instanceof TrainCard) {
                $description = "Take train " . $card->getTrainNumber() . " from " . $card->getDeparture() . " to " . $card->getArrival() . ". Sit in seat " . $card->getSeat() . ".";
            } elseif ($card instanceof BusCard) {
                $description = "Take the airport bus from " . $card->getDeparture() . " to " . $card->getArrival() . ". No seat assignment.";
            }

            // Ajouter la description à l'itinéraire
            $itinerary[] = $description;
        }

        // Ajouter la fin de l'itinéraire
        $itinerary[] = "You have arrived at your final destination.";
        return $itinerary;
    }
}

