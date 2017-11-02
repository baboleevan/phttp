<?php

use PHPUnit\Framework\TestCase;

class HttpMessageParserTest extends TestCase
{

    public function testReturnValue()
    {
        $parser = new HttpMessageParser('');
        $result = $parser->getResult();
        $this->assertEquals(true, is_array($result));

        $this->assertArrayHasKey('start_line', $result, 'key "start_line" not exists');
        $this->assertArrayHasKey('method', $result, 'key "method" not exists');
        $this->assertArrayHasKey('uri', $result, 'key "uri" not exists');
        $this->assertArrayHasKey('version', $result, 'key "version" not exists');
        $this->assertArrayHasKey('headers', $result, 'key "headers" not exists');
        $this->assertArrayHasKey('body', $result, 'key "body" not exists');
    }
}
