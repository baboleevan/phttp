<?php

class Request
{
    private $requestMessage;

    public function __construct($requestMessage)
    {
        //하지만 아직 쓰진 않지
        $this->requestMessage = $requestMessage;
    }

    public function getResponse()
    {
        $filename = PROJECT_ROOT . '/public/index.html';
        if (!($fp = fopen($filename, 'r'))) {
            return 'HTTP/1.0 404 파일 없음' . PHP_EOL;
        }
        $responseBody = fread($fp, filesize($filename));

        $response = 'HTTP/1.0 200 OK' . PHP_EOL;
        $response .= 'Content-Type: text/html' . PHP_EOL;
        $response .= PHP_EOL;
        $response .= $responseBody . PHP_EOL;

        return $response;
    }
}
