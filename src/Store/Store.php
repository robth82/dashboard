<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 27-10-14
 * Time: 19:04
 */

namespace Robth82\Dashboard\Store;


interface Store
{
    public function save($id, array $config);

    public function load($id);

    public function delete($id);
} 