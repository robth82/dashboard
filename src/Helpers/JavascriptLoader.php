<?php

namespace Robth82\Dashboard\Helpers;

class JavascriptLoader {
    static $javascript = '';
    static public function addScript($javascript) {
        self::$javascript .= $javascript;
    }

    static public function getScript() {
        return self::$javascript;
    }
}