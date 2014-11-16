<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 27-10-14
 * Time: 19:04
 */

namespace Robth82\Dashboard\Store;

/**
 * Class SessionStore
 * @package Robth82\Dashboard\Store
 */
class SessionStore implements Store
{
    private $sessionName;

    function __construct($sessionName = 'dashboard')
    {
        $this->sessionName = $sessionName;
    }

    /**
     * @param $id
     * @param array $config
     */
    public function save($id, array $config)
    {
        $_SESSION['dashboard'][$id] = serialize($config);
    }

    /**
     * @param $id
     * @return array|mixed
     */
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

    /**
     * @param $id
     */
    public function delete($id)
    {
        unset($_SESSION['dashboard'][$id]);
    }


}