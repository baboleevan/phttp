<?php
$server = stream_socket_server("tcp://127.0.0.1:1337", $errno, $errorMessage);

if ($server === false) {
    throw new UnexpectedValueException("Could not bind to socket: $errorMessage");
}

while (true) {
    $client = @stream_socket_accept($server);

    if ($client) {
        $request= fread($client, 1024);

        $response = 'HTTP/1.0 200 OK' . PHP_EOL;
        $response .= 'Content-Type: text/html' . PHP_EOL;
        $response .= PHP_EOL;
        $response .= 'you sent :' . PHP_EOL . $request . PHP_EOL;

        fwrite($client, $response, strlen($response));
        fclose($client);
    }
}
