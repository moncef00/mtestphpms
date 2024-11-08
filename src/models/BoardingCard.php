<?php
namespace App\models;

use App\enum\TransportType;

/**
 * Class BoardingCard
 * Représente une carte d'embarquement générique pour différents types de transport.
 */
class BoardingCard {
    private TransportType $transportType;
    private string $departure;
    private string $arrival;
    private ?string $seat;
    private ?string $details;

    /**
     * BoardingCard constructor.
     *
     * @param TransportType $transportType Le type de transport.
     * @param string $departure La ville de départ.
     * @param string $arrival La ville d'arrivée.
     * @param string|null $seat Le siège assigné, si applicable.
     * @param string|null $details Détails supplémentaires, si applicable.
     */
    public function __construct(TransportType $transportType, string $departure, string $arrival, ?string $seat = null, ?string $details = null) {
        $this->transportType = $transportType;
        $this->departure = $departure;
        $this->arrival = $arrival;
        $this->seat = $seat;
        $this->details = $details;
    }

    /**
     * @return TransportType Le type de transport.
     */
    public function getTransportType(): TransportType {
        return $this->transportType;
    }

    /**
     * @return string La ville de départ.
     */
    public function getDeparture(): string {
        return $this->departure;
    }

    /**
     * @return string La ville d'arrivée.
     */
    public function getArrival(): string {
        return $this->arrival;
    }

    /**
     * @return string|null Le siège assigné, si applicable.
     */
    public function getSeat(): ?string {
        return $this->seat;
    }

    /**
     * @return string|null Détails supplémentaires, si applicable.
     */
    public function getDetails(): ?string {
        return $this->details;
    }
}

