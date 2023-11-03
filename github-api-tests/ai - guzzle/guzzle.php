<?php
//Nie da się załączyć innego silnika niż davinci czemu ???
//composer require guzzlehttp/guzzle

require 'guzzle/vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

// Tworzenie obiektu klienta Guzzle i ustawienie klucza API
$client = new Client([
    'base_uri' => 'https://api.openai.com/v1/',
    'headers' => [
        'Authorization' => 'Bearer API_CODE',
        'Content-Type' => 'application/json'
    ]
]);

// Utworzenie tablicy z danymi do wysłania jako JSON
$data = [
    'prompt' => 'Tell me about papague',
    'temperature' => 0.5,
    'max_tokens' => 30,
    'top_p' => 1,
    'n' => 1,
    'model' => 'text-davinci-002',
];

// Przekonwertowanie tablicy na format JSON
$jsonData = json_encode($data);

// Wysłanie zapytania HTTP POST do API DeepAI
$response = $client->post('completions', [
    RequestOptions::BODY => $jsonData,
]);

// Odczytanie odpowiedzi serwera
$body = $response->getBody()->getContents();

// Wyświetlenie odpowiedzi
echo $body;
?>