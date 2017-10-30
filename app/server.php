<?php
require __DIR__ . '/../vendor/autoload.php';

defined('PROJECT_ROOT') or define('PROJECT_ROOT', __DIR__ . '/..');

$server = stream_socket_server("tcp://127.0.0.1:1337", $errno, $errorMessage);

if ($server === false) {
    throw new UnexpectedValueException("Could not bind to socket: $errorMessage");
}

while (true) {
    $client = @stream_socket_accept($server);

    if ($client) {
        $clientSentData = fread($client, 1024);

        $resourcePath = (new Request($clientSentData))->getResourcePath();
        $response = (new Response())->getResponse($resourcePath);

        fwrite($client, $response, strlen($response));
        fclose($client);
    }
}
