<?php
$client = stream_socket_client("tcp://127.0.0.1:1337", $errno, $errorMessage);
if ($client === false) {
    throw new UnexpectedValueException("Failed to connect: $errno - $errorMessage");
}

/*
 * generate a message
 */
$startLine = 'GET / HTTP/1.0';

$headers = [
    'Host: localhost',
    'Accept: */*',
];
$header = implode(PHP_EOL, $headers);

$emptyLine = PHP_EOL;

$body = '';

/*
 * request
 */
$message = implode(PHP_EOL, [
    $startLine,
    $header,
    $emptyLine,
    $body,
]);
fwrite($client, $message);

/*
 * response
 */
$messageLenth = strlen($message);
$totalLenth = 0;
while (true) {
    $response = stream_get_contents($client, 1);
    echo $response;
    $totalLenth += strlen($response);
    if ($messageLenth <= $totalLenth) {
        break;
    }
}

/*
 * bye bye
 */
fclose($client);
