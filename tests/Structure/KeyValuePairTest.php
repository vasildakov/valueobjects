<?php

namespace ValueObjects\Tests\Structure;

use ValueObjects\String\String;
use ValueObjects\Structure\KeyValuePair;
use ValueObjects\Tests\TestCase;

class KeyValuePairTest extends TestCase
{
    /** @var KeyValuePair */
    protected $keyValuePair;

    public function setup()
    {
        $this->keyValuePair = new KeyValuePair(new String('key'), new String('value'));
    }

    public function testFromNative()
    {
        $fromNativePair  = KeyValuePair::fromNative('key', 'value');
        $this->assertTrue($this->keyValuePair->sameValueAs($fromNativePair));
    }

    /** @expectedException \BadMethodCallException */
    public function testInvalidFromNative()
    {
        KeyValuePair::fromNative('key', 'value', 'invalid');
    }

    public function testSameValueAs()
    {
        $keyValuePair2 = new KeyValuePair(new String('key'), new String('value'));
        $keyValuePair3 = new KeyValuePair(new String('foo'), new String('bar'));

        $this->assertTrue($this->keyValuePair->sameValueAs($keyValuePair2));
        $this->assertTrue($keyValuePair2->sameValueAs($this->keyValuePair));
        $this->assertFalse($this->keyValuePair->sameValueAs($keyValuePair3));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($this->keyValuePair->sameValueAs($mock));
    }

    public function testGetKey()
    {
        $this->assertEquals('key', $this->keyValuePair->getKey());
    }

    public function testGetValue()
    {
        $this->assertEquals('value', $this->keyValuePair->getValue());
    }

    public function testToString()
    {
        $this->assertEquals('key => value', $this->keyValuePair->__toString());
    }
}
