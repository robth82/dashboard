<?php
/**
 * Created by PhpStorm.
 * User: RobterHaar
 * Date: 29-6-2016
 * Time: 22:19
 */

namespace Store;

use Robth82\Dashboard\Store\JsonStore;

class JsonStoreTest extends \PHPUnit_Framework_TestCase
{
    const CONST_ID = 'id';

    public function testJsonStore() {
        $store = new JsonStore('data.json');

        $value = [ 1 => 'test'];
        $store->save(self::CONST_ID, $value);
        $expectValue = $store->load(self::CONST_ID);

        $this->assertSame($value, $expectValue);

        $store->delete(self::CONST_ID);
        $falseValue = $store->load(self::CONST_ID);

        $this->assertFalse($falseValue);
    }
}