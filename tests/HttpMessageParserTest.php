<?php

use PHPUnit\Framework\TestCase;

class HttpMessageParserTest extends TestCase
{

    public function testReturnValue()
    {
        $parser = new HttpMessageParser('');
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
}
