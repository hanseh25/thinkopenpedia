<?php
namespace ShineOS\Install;

use ShineOS\Module;
use ShineOS\Utils\Database as DbUtils;
use Illuminate\Support\Facades\Schema as DbSchema;

use Cache;

class DbInstaller
{
    public function run($sql=NULL)
    {
        Cache::flush();
        $this->createSchema($sql);
        Cache::flush();
    }

    public function createSchema($sql=NULL)
    {
        $runsql = "shineos.sql";
        $builder = new DbUtils();

        if($sql) $runsql = $sql;
        $shineos_sql = SHINEOS_PATH . 'Install' . DS . 'Schema' . DS . $runsql;

        $builder->import_sql_file($shineos_sql);

    }

    public function donothing()
    {
        return true;
    }

}
