<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use BpmRestfull\Formater\Json;

class RequestFormaterTest extends TestCase
{

    public function testFormatable()
    {
        $formater = new Json();
        $this->assertInstanceOf(\BpmRestfull\Formater\Formatable::class, $formater);
        $this->assertArrayHasKey('Content-Type', $formater->httpHeaders());
        $this->assertEquals($formater->httpHeaders()['Content-Type'], 'application/json');
    }
    
    
    public function providerFormat()
    {
        return [
            [['test' => 123], '{"test":123}'],
            [['test' => 'foo'], '{"test":"foo"}'],
            [['test' => 4.23], '{"test":4.23}'],
            [['test' => null], '{"test":null}'],
            [['test' => true], '{"test":true}'],
            [['test' => false], '{"test":false}'],
            [['foo' => 'bar', 'x' => 'y'], '{"foo":"bar","x":"y"}']
        ];
    }

    /**
     * @dataProvider providerFormat
     */
    public function testFormat($data, $actual)
    {
        $json = new Json();
        
        $mock = $this->createMock(\BpmRestfull\Definition\Arrayable::class);
        $mock->expects($this->once())
            ->method('toArray')
            ->willReturn($data);
        
        $this->assertEquals($json->format($mock), $actual);
    }
}