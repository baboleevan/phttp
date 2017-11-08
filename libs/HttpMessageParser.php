<?php

class HttpMessageParser
{
    private $message = '';
    private $result = [
        'start_line' => '',
        'method' => '',
        'uri' => '',
        'version' => '',
        'headers' => '',
        'body' => '',
    ];

    public function __construct(string $message)
    {
        $this->message = $message;
        $this->parse();
    }

    private function parse()
    {
        if ($this->message == '') {
            throw new Exception('Invalid message format.');
        }
    }

    public function getResult(): array
    {
        return $this->result;
    }
}
