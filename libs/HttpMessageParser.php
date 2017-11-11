<?php

class HttpMessageParser
{
    private $message = '';
    private $messageLines = [];
    private $result = [
        'start_line' => '',
        'method' => '',
        'uri' => '',
        'version' => '',
        'headers' => '',
        'body' => '',
    ];
    private $supportMethods = ['GET', 'HEAD', 'POST',];

    public function __construct(string $message)
    {
        $this->message = $message;
        $this->parse();
    }

    private function parse(): void
    {
        $this->splitMessageIntoLines();

        $this->verifyStartLine();
    }

    private function throwInvalidMessageFormat(): void
    {
        throw new Exception('Invalid message format.');
    }

    public function getResult(): array
    {
        return $this->result;
    }

    /**
     * 메시지를 \r\n 혹은 \n으로 나누기
     */
    private function splitMessageIntoLines()
    {
        $this->messageLines = preg_split('/(\r\n|\n)/', $this->message);
        //각 줄의 양 끝 공백은 제거한다
        array_walk($this->messageLines, function (&$item) {
            $item = trim($item);
        });
    }

    private function verifyStartLine(): void
    {
        $this->splitStartLineInto3Components();

        // TODO refactoring
        //      메소드를 확인한다
        //      URI를 확인한다
        //      버전을 확인한다

        //check Method
        if (empty($this->result['method']) || !in_array($this->result['method'], $this->supportMethods)) {
            $this->throwInvalidMessageFormat();
        }

        //check URI
        if (empty($this->result['uri']) || strpos($this->result['uri'], '/') !== 0) {
            $this->throwInvalidMessageFormat();
        }

        //check version
        if (empty($this->result['version']) || !preg_match('/HTTP\/\d+.\d+/', $this->result['version'])) {
            $this->throwInvalidMessageFormat();
        }
    }

    private function splitStartLineInto3Components()
    {
        //시작줄은 있어야 한다
        if (empty($this->messageLines) || empty($this->messageLines[0])) {
            $this->throwInvalidMessageFormat();
        }

        //시작줄을 whitespace로 나누기
        $startLine = $this->messageLines[0];
        $startLineSplit = preg_split('/\s/', $startLine);

        if (empty($startLineSplit) || count($startLineSplit) !== 3) {
            $this->throwInvalidMessageFormat();
        }

        $this->result['method'] = $startLineSplit[0];
        $this->result['uri'] = $startLineSplit[1];
        $this->result['version'] = $startLineSplit[2];
    }
}
