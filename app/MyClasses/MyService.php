<?php

namespace App\MyClasses;

use Exception;

class MyService
{
    private $id = -1;
    private $msg;
    private $data;

    public function __construct(int $id = -1)
    {
        if ($id < 0) {
            throw new Exception("id is required.");
        }
        $this->id = $id;
        $this->msg = "select: {$id}";
        $this->data = ['Hello', 'Welcome', 'Bye'];
    }
    public function getId()
    {
        return $this->id;
    }
    public function getMsg()
    {
        return $this->msg;
    }
    public function getData()
    {
        return $this->data;
    }
}
