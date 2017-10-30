<?php

class Response
{
    private $docRoot = PROJECT_ROOT . '/public';

    public function getResponse($resourcePath)
    {
        $filename = $this->docRoot . $resourcePath;
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
