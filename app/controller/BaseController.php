<?php

abstract class BaseController
{

    protected $_data = [];

    public function __construct()
    {
        $this->initialize();
    }

    public function getData()
    {
        return $this->_data;
    }

    protected abstract function initialize();
}
