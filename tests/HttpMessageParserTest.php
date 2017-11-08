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
            ['GET 둘 셋'],
            ['POST 둘 셋'],
            ['HEAD 둘 셋'],
            ['HEAD / 셋'],
            ['HEAD /index 셋'],
            ['HEAD /index HTTP/1.1'],
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
