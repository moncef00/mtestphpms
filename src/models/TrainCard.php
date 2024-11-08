<?php
namespace App\models;

use App\enum\TransportType;

/**
 * Class TrainCard
 * Représente une carte d'embarquement pour un train.
 */
class TrainCard extends BoardingCard {
    private string $trainNumber;

    /**
     * TrainCard constructor.
     *
     * @param string $trainNumber Le numéro de train.
     * @param string $departure La ville de départ.
     * @param string $arrival La ville d'arrivée.
     * @param string $seat Le siège assigné.
     */
    public function __construct(string $trainNumber, string $departure, string $arrival, string $seat) {
        parent::__construct(TransportType::TRAIN, $departure, $arrival, $seat, null);
        $this->trainNumber = $trainNumber;
    }

    /**
     * @return string Le numéro de train.
     */
    public function getTrainNumber(): string {
        return $this->trainNumber;
    }

    /**
     * @return string Détails supplémentaires pour le train.
     */
    public function getDetails(): string {
        return "Train " . $this->getTrainNumber();
    }
}

