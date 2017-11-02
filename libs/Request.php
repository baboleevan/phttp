<?php

class Request
{
    private $requestMessage;
    private $resourcePath;

    public function __construct(string $requestMessage)
    {
        //하지만 아직 쓰진 않지
        $this->requestMessage = $requestMessage;
    }

    public function getResourcePath()
    {
        $this->parseMessage();
        return $this->resourcePath;
    }

    private function parseMessage()
    {
        $this->resourcePath = '/index.html';
    }
}
