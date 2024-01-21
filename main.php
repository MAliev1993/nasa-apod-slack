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
$body = $nasaResponse->getBody();
var_dump($body);

/*
$slackWebhookUri = 'https://hooks.slack.com/services/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';
$slackHttpClient = new Client();

$slackHttpClient->request(
    POST,
    $slackWebhookUri,
    ['json' => ['text' => 'Take a look at the latest NASA picture of the day!']]
);

$slackHttpClient->request(
    POST,
    $slackWebhookUri,
    ['json' => ['text' => 'Take a look at the latest NASA picture of the day!']]
);
*/

// $client contains all the methods to interact with the API
$slackServiceToken = 'xoxp-159477670640-612226523526-6436890174294-ee2cd3d15b4df8906be1179f01cfec09';
$channelName = 'nasa-apod';
$client = JoliCode\Slack\ClientFactory::create($slackServiceToken);
$client->chatPostMessage([
    'channel' => $channelName,
    'text' => 'Hello, world!',
    'blocks' => json_encode([
        [
            'type' => 'section',
            'text' => [
                'type' => 'mrkdwn',
                'text' => ':tada: Blocks are working!',
            ],
        ],
    ]),
]);
