<?php

const GET = 'GET';
const POST = 'POST';

use GuzzleHttp\Client as Client;

$nasaApiKey = 'iM1tau6c6NlcqwczM7ng4PECq9CO9m2MDeBe3Sct';
$nasaUri = 'https://api.nasa.gov/planetary/apod';
$nasaHttpClient = new Client();
$nasaResponse = $nasaHttpClient->get($nasaUri, ['query' => 'api_key=' . $nasaApiKey]);

$slackWebhookUri = 'https://hooks.slack.com/services/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';
$payload = [
    'text' => 'Hello, World!',
];
$slackHttpClient = new Client();
$slackResponse = $slackHttpClient->request(
    POST,
    $slackWebhookUri,
    ['body' => $payload]
);
