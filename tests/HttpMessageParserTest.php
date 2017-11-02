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
    }
}
