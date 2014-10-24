<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 20-10-14
 * Time: 22:37
 */

namespace Robth82\Dashboard\Widget;


class TableWidget extends Widget
{
    private $columns;

    function __construct($title, $content)
    {
        parent::__construct($title, $content);
        $this->setName('table');

        $cols = array();
        foreach ($content[0] as $colname => $value) {
            $cols[] = $colname;
        }
        $this->setColumns($cols);
    }

    /**
     * @param mixed $columns
     */
    public function setColumns($columns)
    {
        $this->columns = $columns;
    }

    /**
     * @return mixed
     */
    public function getColumns()
    {
        return $this->columns;
    }


}