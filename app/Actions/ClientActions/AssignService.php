<?php namespace App\Actions\ClientActions;

use App\Actions\BaseAction;
use App\Client;

class AssignService extends BaseAction
{
    private $services;

    public function execute()
    {
        $this->getModel()->services()->sync($this->services);
    }

    public function setServices(array $services)
    {
        $this->services = $services;
        return $this;
    }

    public function setInstance($instance)
    {
        $this->setModel($instance);
        return $this;
    }

}
