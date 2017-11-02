<?php

use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    public function testGetResourcePath(): void
    {
        $request = new Request([]);
        $this->assertEquals('/index.html', $request->getResourcePath());
    }
}
