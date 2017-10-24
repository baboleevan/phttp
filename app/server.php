<?php
require __DIR__ . '/../vendor/autoload.php';

//todo 지울 것 s
$req = new Request();
echo ($req instanceof Request);
exit;
//todo 지울 것 e

$server = stream_socket_server("tcp://127.0.0.1:1337", $errno, $errorMessage);

if ($server === false) {
    throw new UnexpectedValueException("Could not bind to socket: $errorMessage");
}

while (true) {
    $client = @stream_socket_accept($server);

    if ($client) {
        //todo 요청(request) 처리 모듈로 분리하기
        $request= fread($client, 1024);

        //todo 응답(response) 처리 모듈로 분리하기
        $filename = '../public/index.html';
        if (!($fp = fopen($filename, 'r'))) {
            $response = 'HTTP/1.0 404 파일 없음' . PHP_EOL;
            fwrite($client, $response, strlen($response));
            fclose($client);
        }
        $responseBody = fread($fp, filesize($filename));

        $response = 'HTTP/1.0 200 OK' . PHP_EOL;
        $response .= 'Content-Type: text/html' . PHP_EOL;
        $response .= PHP_EOL;
        $response .= $responseBody . PHP_EOL;

        fwrite($client, $response, strlen($response));
        fclose($client);
    }
}
