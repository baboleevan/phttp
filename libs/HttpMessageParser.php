<?php

class HttpMessageParser
{
    private $message = '';

    /**
     * HttpMessageParser constructor.
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function getResult()
    {
        return [];
    }
}
