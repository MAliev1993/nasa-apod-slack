<?php

require_once('vendor/autoload.php');

use GuzzleHttp\Client as Client;

const GET = 'GET';
const POST = 'POST';

$nasaApiKey = 'iM1tau6c6NlcqwczM7ng4PECq9CO9m2MDeBe3Sct';
$nasaUri = 'https://api.nasa.gov/planetary/apod';
$nasaHeaders = [
    "Content-Type" => "application/json",
    "Accept" => "application/json",
];
$nasaHttpClient = new Client([
    'headers' => $nasaHeaders,
]);

$nasaRequestOptions = [];
$nasaResponse = $nasaHttpClient->get($nasaUri, ['query' => 'api_key=' . $nasaApiKey]);

$slackWebhookUri = 'https://hooks.slack.com/services/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';
$payload = [
    'text' => 'Hello, World!',
];
$slackHttpClient = new Client();
$slackResponse = $slackHttpClient->request(
    POST,
    $slackWebhookUri,
    ['json' => $payload]
);
