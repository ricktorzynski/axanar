<?php

namespace Ares\Services;

use Ares\App;

class BaseService
{
    /**
     * @var \Ares\Database\Db
     */
    protected $connection;

    /**
     * Constructor
     * Sets up database connection
     */
    public function __constructor()
    {
        $this->connection = App::getDbConnection();
    }

    /**
     * @return \Ares\Database\Db
     */
    public function getDbConnection()
    {
        return $this->connection;
    }
}
