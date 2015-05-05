<?php


namespace Robth82\Dashboard\Store;


class ArrayStore implements Store {
    private $config;

    public function __construct() {
        global $config;
        $this->config = $config;
    }

    private function writeBack() {
        global $config;
        $config = $this->config;
    }

    public function save($id, array $config)
    {
        $this->config[$id] = $config;
        $this->writeBack();
    }

    public function load($id)
    {
        if(isset ($this->config[$id])) {
            return $this->config[$id];

        }
        return false;

    }

    public function delete($id)
    {
        unset($this->config[$id]);
        $this->writeBack();
    }

}