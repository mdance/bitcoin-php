<?php

namespace BitWasp\Bitcoin\Test\Network\Messages;


use BitWasp\Bitcoin\Block\BlockHeaderFactory;
use BitWasp\Bitcoin\Network\Messages\Headers;
use BitWasp\Bitcoin\Tests\AbstractTestCase;

class HeadersTest extends AbstractTestCase
{
    public function testHeaders()
    {
        $headers = new Headers();
        $this->assertEquals('headers', $headers->getNetworkCommand());
        $this->assertEquals(0, count($headers));

        $empty = $headers->getHeaders();
        $this->assertEquals(0, count($empty));
        $this->assertInternalType('array', $empty);

        $h = BlockHeaderFactory::fromHex('0100000000000000000000000000000000000000000000000000000000000000000000003ba3edfd7a7b12b27ac72c3e67768f617fc81bc3888a51323a9fb8aa4b1e5e4a29ab5f49ffff001d1dac2b7c');

        $headers->addHeader($h);
        $this->assertEquals(1, count($headers));
        $this->assertEquals($h, $headers->getHeader(0));
    }

    public function testHeadersArray()
    {
        $arr = [
            BlockHeaderFactory::fromHex('0100000000000000000000000000000000000000000000000000000000000000000000003ba3edfd7a7b12b27ac72c3e67768f617fc81bc3888a51323a9fb8aa4b1e5e4a29ab5f49ffff001d1dac2b7c')
        ];

        $headers = new Headers($arr);
        $this->assertEquals($arr, $headers->getHeaders());
        $this->assertEquals(1, count($headers));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testGetHeaderFailure()
    {
        $headers = new Headers();
        $headers->getHeader(10);
    }
}