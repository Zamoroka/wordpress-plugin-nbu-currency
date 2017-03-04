<?php

/**
 * Created by PhpStorm.
 * User: zamoroka
 * Date: 04.03.2017
 * Time: 15:12
 */
class View
{
    private $data = array();

    public function assign($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function display($htmlPage)
    {
        extract($this->data);
        include_once __DIR__ . '/../' . $htmlPage;
    }
}

?>