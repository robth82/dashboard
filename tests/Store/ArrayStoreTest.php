<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 21-4-2015
 * Time: 21:55
 */

//namespace Robth82\Dashboard\Tests;

use Robth82\Dashboard\Store\ArrayStore;

class ArrayStoreTest extends \PHPUnit_Framework_TestCase {

    const CONST_ID = 'id';

    public function testArrayStore() {
        $store = new ArrayStore();

        $value = [ 1 => 'test'];
        $store->save(self::CONST_ID, $value);
        $expectValue = $store->load(self::CONST_ID);

        $this->assertSame($value, $expectValue);

        $store->delete(self::CONST_ID);
        $falseValue = $store->load(self::CONST_ID);

        $this->assertFalse($falseValue);
    }
}
 