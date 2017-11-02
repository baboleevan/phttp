<?php
/**
 * Created by PhpStorm.
 * User: youngiggy
 * Date: 2017. 11. 2.
 * Time: PM 11:43
 */

use PHPUnit\Framework\TestCase;

class HttpMessageParserTest extends TestCase
{

    public function testReturnValue()
    {
        $parser = new HttpMessageParser('');
        $result = $parser->getResult();
        $this->assertEquals(true, is_array($result));

        $this->assertArrayHasKey('start_line', $result, 'key start_line exists');
        $this->assertArrayHasKey('method', $result, 'key method exists');
        $this->assertArrayHasKey('uri', $result, 'key uri exists');
        $this->assertArrayHasKey('version', $result, 'key version exists');
        $this->assertArrayHasKey('headers', $result, 'key headers exists');
        $this->assertArrayHasKey('body', $result, 'key body exists');
    }
}
