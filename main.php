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
$nasaResponse = $nasaHttpClient->get($nasaUri, [
    'query' => 'api_key=' . $nasaApiKey,
]);
$body = $nasaResponse->getBody();
$contents = json_decode($body->getContents(), true);
$date = $contents['date'];
$title = $contents['title'];
$explanation = $contents['explanation'];
$hdUrl = $contents['hdurl'];

$slackWebhookUri = 'https://hooks.slack.com/services/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';
$slackHttpClient = new Client();

$slackHttpClient->post(
    $slackWebhookUri, [
        'json' => [
            'text' => "*$title*\n$explanation\n$hdUrl"
        ],
    ]
);
