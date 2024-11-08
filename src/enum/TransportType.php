<?php

namespace App\enum;

/**
 * Enum représentant les différents types de transport disponibles.
 */
enum TransportType: string {
    case TRAIN = 'train';
    case AIRPORT_BUS = 'airport bus';
    case FLIGHT = 'flight';
    case BUS = 'bus';
}
