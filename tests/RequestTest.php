<?php

use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    public function testCanBeCreated(): void
    {
        $this->assertInstanceOf(
            Request::class,
            new Request([])
        );
    }

    public function testConstructByReflection() : void
    {
        $requestMessage = ['testKey' => 'testVal'];
        $request = new Request($requestMessage);
        $reflectionClass = new \ReflectionClass($request);

        $reflectionProperty = $reflectionClass->getProperty('requestMessage');
        $reflectionProperty->setAccessible(true);
        $privateVal = $reflectionProperty->getValue($request);

        $this->assertEquals(
            serialize($requestMessage),
            serialize($privateVal)
        );
    }

    public function testConstructByGetter() : void
    {
        $requestMessage = ['testKey' => 'testVal'];
        $request = new Request($requestMessage);

        $valueByGetter = $request->getRequestMessage();

        $this->assertEquals(
            serialize($requestMessage),
            serialize($valueByGetter)
        );
    }
}
