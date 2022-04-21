<?php

declare(strict_types=1);

namespace MiniCRUD\Database;

use mysqli;

class MySQLManager
{
    private ?mysqli $instance = null;

    public function connect(): mysqli
    {
        try {
            $this->instance = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, (int)DB_PORT);
            $this->instance->set_charset(CHARSET);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        return $this->instance;
    }
}
