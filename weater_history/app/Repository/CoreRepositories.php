<?php
declare(strict_types=1);

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;

abstract class CoreRepositories
{
    protected $model;

    public function __construct() {
        $this->model = app($this->getModelClass());
    }

    abstract protected function getModelClass();

    protected function startConditions() : Model {
        return clone $this->model;
    }
}
