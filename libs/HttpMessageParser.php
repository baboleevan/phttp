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
        //메시지를 \r\n 혹은 \n으로 나누기
        $messageSplit = preg_split('/(\r\n|\n)/', $this->message);
        //각 줄의 양 끝 공백은 제거한다
        array_walk($messageSplit, function(&$item){
            $item = trim($item);
        });

        //시작줄은 있어야 한다
        if (empty($messageSplit) || empty($messageSplit[0])) {
            throw new Exception('Invalid message format.');
        }

        //시작줄을 whitespace로 나누기
        $startLine = $messageSplit[0];
        $startLineSplit = preg_split('/\s/', $startLine);

        if (empty($startLineSplit) || count($startLineSplit) !== 3) {
            throw new Exception('Invalid message format.');
        }
    }

    public function getResult(): array
    {
        return $this->result;
    }
}
