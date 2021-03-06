<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 27/03/15
 * Time: 01:15
 */

namespace BitWasp\Bitcoin\Test\Network\Messages;

use BitWasp\Bitcoin\Bitcoin;
use BitWasp\Bitcoin\Network\Messages\Ping;
use BitWasp\Bitcoin\Tests\AbstractTestCase;

class PingTest extends AbstractTestCase
{
    public function testPing()
    {
        $ping = new Ping();
        $this->assertInternalType('string', $ping->getNonce());
        $this->assertEquals('ping', $ping->getNetworkCommand());
        $math = Bitcoin::getMath();
        $this->assertEquals(str_pad($math->decHex($ping->getNonce()), 16, '0', STR_PAD_LEFT), $ping->getBuffer()->getHex());

    }
}