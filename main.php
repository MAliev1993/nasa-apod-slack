<?php

require_once('vendor/autoload.php');

use GuzzleHttp\Client as Client;

const GET = 'GET';
const POST = 'POST';

$testMode = $argv[1] === "test";

$config = json_decode(file_get_contents('local.json'), true) ?? [];

$nasaApiKey = $config['nasaApiKey'];
$nasaUri = 'https://api.nasa.gov/planetary/apod';
$nasaHeaders = [
    "Content-Type" => "application/json",
    "Accept" => "application/json",
];
$nasaHttpClient = new Client([
    'headers' => $nasaHeaders,
]);

$nasaRequestOptions = [];
$nasaResponse = $nasaHttpClient->get($nasaUri, [
    'query' => 'api_key=' . $nasaApiKey,
]);
$body = $nasaResponse->getBody();
$contents = json_decode($body->getContents(), true);
$date = $contents['date'];
$title = $contents['title'];
$explanation = $contents['explanation'];
$hdUrl = $contents['hdurl'];

$slackWebhookUri = $config['slackWebhooks'][$testMode ? 'test' : 'prod'];
$slackHttpClient = new Client();

$slackHttpClient->post(
    $slackWebhookUri, [
        'json' => [
            'text' => "*$title*\n$explanation\n$hdUrl"
        ],
    ]
);
