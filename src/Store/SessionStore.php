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
    private $commit;

    function __construct($sessionName = 'dashboard', $commit = false)
    {
        $this->sessionName = $sessionName;
        $this->commit = $commit;
    }

    /**
     * @param $id
     * @param array $config
     */
    public function save($id, array $config)
    {
        if ($this->commit) {
            @session_start();
        }

        $_SESSION[$this->sessionName][$id] = serialize($config);

        if ($this->commit) {
            session_commit();
        }

    }

    /**
     * @param $id
     * @return array|mixed
     */
    public function load($id)
    {
        if (isset($_SESSION[$this->sessionName][$id])) {
            return unserialize($_SESSION[$this->sessionName][$id]);
        }
        return false;

    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        unset($_SESSION['dashboard'][$id]);
    }


}