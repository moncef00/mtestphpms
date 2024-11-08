<?php
namespace App\models;

use App\enum\TransportType;

/**
 * Class FlightCard
 * Représente une carte d'embarquement pour un vol.
 */
class FlightCard extends BoardingCard {
    private string $flightNumber;
    private string $gate;
    private string $baggage;

    /**
     * FlightCard constructor.
     *
     * @param string $flightNumber Le numéro de vol.
     * @param string $departure La ville de départ.
     * @param string $arrival La ville d'arrivée.
     * @param string $seat Le siège assigné.
     * @param string $gate La porte d'embarquement.
     * @param string $baggage Les informations sur les bagages.
     */
    public function __construct(string $flightNumber, string $departure, string $arrival, string $seat, string $gate, string $baggage) {
        parent::__construct(TransportType::FLIGHT, $departure, $arrival, $seat, null);
        $this->flightNumber = $flightNumber;
        $this->gate = $gate;
        $this->baggage = $baggage;
    }

    /**
     * @return string Le numéro de vol.
     */
    public function getFlightNumber(): string {
        return $this->flightNumber;
    }

    /**
     * @return string La porte d'embarquement.
     */
    public function getGate(): string {
        return $this->gate;
    }

    /**
     * @return string Les informations sur les bagages.
     */
    public function getBaggage(): string {
        return $this->baggage;
    }

    /**
     * @return string Détails supplémentaires pour le vol.
     */
    public function getDetails(): string {
        return "Gate " . $this->getGate() . ". " . $this->getBaggage();
    }
}

