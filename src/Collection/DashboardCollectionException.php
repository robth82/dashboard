<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 26-10-14
 * Time: 12:47
 */

namespace Robth82\Dashboard\Collection;


use Exception;
use Robth82\Dashboard\Widget\Widget;

class DashboardCollectionException extends \Exception
{
    private $widget;

    public function __construct(Widget $widget, $message = "", $code = 0, Exception $previous = null)
    {
        $this->widget = $widget;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @param \Robth82\Dashboard\Widget\Widget $widget
     */
    public function setWidget($widget)
    {
        $this->widget = $widget;
    }

    /**
     * @return \Robth82\Dashboard\Widget\Widget
     */
    public function getWidget()
    {
        return $this->widget;
    }


}