<?php

use PHPUnit\Framework\TestCase;

class HttpMessageParserTest extends TestCase
{

    public function testReturnValue()
    {
        $goodMsg = 'GET / HTTP/1.1';
        $parser = new HttpMessageParser($goodMsg);
        $result = $parser->getResult();
        $this->assertEquals(true, is_array($result));

        $requiredFields = [
            'start_line',
            'method',
            'uri',
            'version',
            'headers',
            'body',
        ];
        foreach ($requiredFields as $field) {
            $this->assertArrayHasKey($field, $result, 'key "' . $field . '" does not exist');
        }
    }

    public function badMessages()
    {
        return [
            [''],
            ['haha'],
        ];
    }

    /**
     * @dataProvider badMessages
     * @expectedException Exception
     */
    public function testInvalidMessageCausesException($badMsg)
    {
        new HttpMessageParser($badMsg);
    }
}
