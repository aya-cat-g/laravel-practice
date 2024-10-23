<?php

namespace App\MyClasses;

class PowerMyServiceSet implements MyServiceInterface
{
    private $id;
    private $msg;
    private $data;

    public function __construct()
    {
        $this->id = -1;
        $this->msg = "no id.";
        $this->data = ['いちご', 'みかん', 'バナナ'];
        $this->setId(rand());
    }

    public function setId($id)
    {
        $this->id = $id;
        if ($id >= 0) {
            $this->msg = "idはデフォルトではランダム、 {$id}";
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
