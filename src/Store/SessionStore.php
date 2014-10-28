<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 27-10-14
 * Time: 19:04
 */

namespace Robth82\Dashboard\Store;


class SessionStore implements Store
{
    public function save($id, $config)
    {
//        print '<pre>';
//        echo 'save';
//        print_r($config);
//        print '</pre>';
        $_SESSION['dashboard'][$id] = serialize($config);
    }

    public function load($id)
    {
        if (isset($_SESSION['dashboard'][$id])) {
            return unserialize($_SESSION['dashboard'][$id]);
        }
        return array(
            'no1' => array(),
            'no2' => array()
        );
    }

} 