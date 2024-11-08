<?php
namespace App\models;

use App\enum\TransportType;

/**
 * Class BusCard
 * Représente une carte d'embarquement pour un bus.
 */
class BusCard extends BoardingCard {
    /**
     * BusCard constructor.
     *
     * @param string $departure La ville de départ.
     * @param string $arrival La ville d'arrivée.
     */
    public function __construct(string $departure, string $arrival) {
        parent::__construct(TransportType::AIRPORT_BUS, $departure, $arrival, null, "No seat assignment.");
    }

    /**
     * @return string Détails supplémentaires pour le bus.
     */
    public function getDetails(): string {
        return "";
    }
}

