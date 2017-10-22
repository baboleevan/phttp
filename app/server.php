<?php
$server = stream_socket_server("tcp://127.0.0.1:1337", $errno, $errorMessage);

if ($server === false) {
    throw new UnexpectedValueException("Could not bind to socket: $errorMessage");
}

while (true) {
    $client = @stream_socket_accept($server);

    if ($client) {
        $clientSentData= fread($client, 1024);

        $responseBody = 'HTTP/1.0 200 OK' . PHP_EOL;
        $responseBody .= 'Content-Type: text/html' . PHP_EOL;
        $responseBody .= PHP_EOL;
        $responseBody .= 'you sent :' . PHP_EOL . $clientSentData . PHP_EOL;

        fwrite($client, $responseBody, strlen($responseBody));
        fclose($client);
    }
}
