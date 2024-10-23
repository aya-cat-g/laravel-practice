<?php

namespace App\MyClasses;

class MyServiceSet implements MyServiceInterface
{
    private $id;
    private $msg;
    private $data;
    private $serial;

    public function __construct(int $id)
    {
        $this->id = $id;
        $this->msg = "no id.";
        $this->data = ['Hello', 'Welcome', 'Bye'];
        $this->serial = rand();
        $this->setId($id);
        echo "[{$this->serial}]";
    }

    public function setId($id)
    {
        $this->id = $id;
        if ($id >= 0) {
            $this->msg = "select: {$id}";
        }
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
