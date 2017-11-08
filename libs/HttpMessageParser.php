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

    public function getResult(): array
    {
        return [
            'start_line' => '',
            'method' => '',
            'uri' => '',
            'version' => '',
            'headers' => '',
            'body' => '',
        ];
    }
}
