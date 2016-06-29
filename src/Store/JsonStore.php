<?php
/**
 * Created by PhpStorm.
 * User: RobterHaar
 * Date: 29-6-2016
 * Time: 22:21
 */

namespace Robth82\Dashboard\Store;;


class JsonStore implements Store
{
    protected $filename;
    protected $data;

    /**
     * JsonStore constructor.
     * @param $filename
     */
    public function __construct($filename)
    {
        $this->data = [];
        $this->filename = $filename;
        if(file_exists($filename)) {
            $this->data = json_decode(file_get_contents($filename), true);
        }

    }


    public function save($id, array $config)
    {
        $this->data[$id] = serialize($config);
        $this->writeFile();
    }

    public function load($id)
    {
        if(isset($this->data[$id])) {
            return unserialize($this->data[$id]);
        }
        return false;
    }

    public function delete($id)
    {
        unset($this->data[$id]);
        $this->writeFile();
    }

    private function writeFile()
    {
        $json = json_encode($this->data);
        file_put_contents($this->filename, $json);
    }


}