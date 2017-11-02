<?php

class Request
{
    private $requestMessage;

    public function __construct(string $requestMessage)
    {
        //하지만 아직 쓰진 않지
        $this->requestMessage = $requestMessage;
    }

    public function getResourcePath()
    {
        return '/index.html';
    }
}
