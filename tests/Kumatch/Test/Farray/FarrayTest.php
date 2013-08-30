<?php

namespace Kumatch\Test\Farray;

use Kumatch\Farray\Farray;

class FarrayTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        parent::setUp();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    public function testCreateIndexedFarray()
    {
        $origin = array('foo', 'bar', 'baz');
        $list = new Farray($origin);

        $this->assertEquals($origin[0], $list[0]);
        $this->assertEquals($origin[1], $list[1]);
        $this->assertEquals($origin[2], $list[2]);

        $this->assertEquals(count($origin), count($list));
        $this->assertEquals(count($origin), $list->count());

        foreach ($list as $index => $value) {
            $this->assertEquals($origin[$index], $value);
        }
    }

    public function testCreateAssociativeFarray()
    {
        $origin = array('foo' => 10, 'bar' => 20, 'baz' => 30);
        $list = new Farray($origin);

        $this->assertEquals($origin['foo'], $list['foo']);
        $this->assertEquals($origin['bar'], $list['bar']);
        $this->assertEquals($origin['baz'], $list['baz']);

        $this->assertEquals(count($origin), count($list));
        $this->assertEquals(count($origin), $list->count());

        foreach ($list as $key => $value) {
            $this->assertEquals($origin[$key], $value);
        }
    }

    public function testUndefinedIndexToNull()
    {
        $origin1 = array(10);
        $origin2 = array("foo" => 10);
        $list1 = new Farray($origin1);
        $list2 = new Farray($origin2);

        $this->assertTrue(isset($list1[0]));
        $this->assertFalse(isset($list1[1]));

        $this->assertTrue(isset($list2['foo']));
        $this->assertFalse(isset($list2['bar']));

        $this->assertTrue($list1->offsetExists(0));
        $this->assertFalse($list1->offsetExists(1));

        $this->assertTrue($list2->offsetExists('foo'));
        $this->assertFalse($list2->offsetExists('bar'));


        try {
            $value = $origin1[2];
            $this->fail();
        } catch (\PHPUnit_Framework_Error_Notice $e) { }

        try {
            $value = $origin2['bar'];
            $this->fail();
        } catch (\PHPUnit_Framework_Error_Notice $e) { }

        try {
            $this->assertNull($list1[1]);
        } catch (\PHPUnit_Framework_Error_Notice $e) {
            $this->fail();
        }

        try {
            $this->assertNull($list2['bar']);
        } catch (\PHPUnit_Framework_Error_Notice $e) {
            $this->fail();
        }
    }

    public function testArrayASProps()
    {
        $list = new Farray(array(10, 20), Farray::ARRAY_AS_PROPS);

        $this->assertEquals(10, $list->{0});
        $this->assertEquals(10, $list[0]);
        $this->assertEquals(20, $list->{1});
        $this->assertEquals(20, $list[1]);
        $this->assertNull($list->{2});
        $this->assertNull($list[2]);

        $list = new Farray(array("foo" => 30, "bar" => 40), Farray::ARRAY_AS_PROPS);

        $this->assertEquals(30, $list->foo);
        $this->assertEquals(30, $list['foo']);
        $this->assertEquals(40, $list->bar);
        $this->assertEquals(40, $list['bar']);
        $this->assertNull($list->baz);
        $this->assertNull($list['baz']);
    }

    public function testFarrayRecursive()
    {
        $list = new Farray(array(
            10, 11, array( 20, 21, array(30, 31) )
        ));

        $this->assertEquals(10, $list[0]);
        $this->assertEquals(11, $list[1]);

        $this->assertInstanceOf('Kumatch\Farray\Farray', $list[2]);
        $this->assertEquals(20, $list[2][0]);
        $this->assertEquals(21, $list[2][1]);

        $this->assertInstanceOf('Kumatch\Farray\Farray', $list[2][2]);
        $this->assertEquals(30, $list[2][2][0]);
        $this->assertEquals(31, $list[2][2][1]);

        $this->assertNull($list[3]);
        $this->assertNull($list[2][3]);
        $this->assertNull($list[2][2][3]);
    }
}