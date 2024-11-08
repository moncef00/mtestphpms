Travel Itinerary Sorting API

This project provides an API that sorts travel segments and generates a step-by-step description of your journey.

## Installation

### Prerequisites

- PHP 8.1 or higher
- Composer installed

### Steps to Install

1. **Download the project**:
    - Download the latest release from the project repository or copy the project files to your local machine.

2. **Install dependencies**:
    - Navigate to the project folder in your terminal and run the following command to install the dependencies:
    
            composer install
    
      This will install all the required libraries and dependencies defined in the `composer.json` file.


3. **Run the application locally**:
    - Start the built-in PHP web server:


      php -S localhost:8000 -t public


      Visit `http://localhost:8000` in your browser to test the application.

## Directory Structure

        Structure du Projet
        project-root/
        ├── App/
        │   ├── public/
        │   │   ├── index.php
        │   ├── enum/
        │   │   ├── TransportType.php
        │   ├── models/
        │   │   ├── BoardingCard.php
        │   │   ├── BusCard.php
        │   │   ├── FlightCard.php
        │   │   ├── TrainCard.php
        │   ├── services/
        │   │   ├── TravelSorter.php
        ├── tests/
        │   ├── TravelSorterTest.php
        ├── vendor/
        ├── composer.json
        ├── composer.lock
        └── README.md
Description des Dossiers et Fichiers
   
     App/: Ce répertoire contient tout le code applicatif.

         public/: Contient les fichiers public .

            index.php: le fichier index.
         
        enum/: Contient les énumérations.

            TransportType.php: Énumération pour les types de transport.

         models/: Contient les classes modèles.

            BoardingCard.php: Classe de base pour une carte d'embarquement.

            BusCard.php: Classe pour une carte d'embarquement de bus.

            FlightCard.php: Classe pour une carte d'embarquement de vol.

            TrainCard.php: Classe pour une carte d'embarquement de train.

        services/: Contient les services de l'application.

            TravelSorter.php: Service responsable du tri des cartes d'embarquement et de la génération de l'itinéraire.

    tests/: Contient les tests unitaires.

        TravelSorterTest.php: Tests unitaires pour TravelSorter.

    vendor/: Contient les dépendances du projet installées via Composer.

## Running Tests

### PHPUnit

To test the application, you can run the unit tests using PHPUnit.

1. **Install PHPUnit** (if not already installed):

   
    composer require --dev phpunit/phpunit
 

2. **Run the tests**:

   
    vendor/bin/phpunit --testdox tests/TravelSorterTest.php

   This will execute the test defined in the `/tests` directory.

### Browser

To test the application in the browser, you can start the built-in PHP web server:

1. **Run the PHP built-in server**:

    php -S localhost:8000 -t public
 

2. **Open your browser** and go to `http://localhost:8000` to test the API or application.

## Usage

### API Endpoint

This API allows you to submit an array of boarding cards and receive back a sorted journey itinerary with step-by-step descriptions.

#### Example Request:

[
    {"departure": "Madrid", "arrival": "Barcelona", "transport_type": "train", "seat": "45B", "details": "Take train 78A from Madrid to Barcelona."},
    {"departure": "Barcelona", "arrival": "Gerona", "transport_type": "bus", "details": "Take airport bus from Barcelona to Gerona Airport."},
    {"departure": "Gerona", "arrival": "Stockholm", "transport_type": "flight", "seat": "3A", "details": "Take flight SK455 from Gerona Airport to Stockholm."},
    {"departure": "Stockholm", "arrival": "New York", "transport_type": "flight", "seat": "7B", "details": "Take flight SK22 from Stockholm to New York JFK."}
]
Example Response:

[
    "Take train 78A from Madrid to Barcelona. Seat 45B.",
    "Take the airport bus from Barcelona to Gerona Airport. No seat assignment.",
    "From Gerona Airport, take flight SK455 to Stockholm. Gate 45B, seat 3A. Baggage drop at ticket counter 344.",
    "From Stockholm, take flight SK22 to New York JFK. Gate 22, seat 7B. Baggage will be automatically transferred from your last leg.",
    "You have arrived at your final destination."
]



### Explications :
1. **Installation** : Commence directement avec l'installation via Composer. Il est supposé que l'utilisateur a déjà téléchargé les fichiers du projet.
2. **Structure des dossiers** : Vue d'ensemble détaillée du projet, expliquant où se trouvent les fichiers importants.
3. **Tests** : Explications sur l'utilisation de PHPUnit et sur la possibilité de tester via le serveur PHP intégré pour voir les résultats dans le navigateur.
4. **Usage** : Exemple d'une requête et d'une réponse typiques pour utiliser l'API