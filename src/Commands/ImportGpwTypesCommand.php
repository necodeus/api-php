<?php

namespace Commands;

use Libraries\Database;
use Services\GiepewuApi;

set_time_limit(10000);

class ImportGpwTypesCommand extends \BaseCommand
{
    protected $name = 'import:gpw-types';

    protected $description = '';

    public function handle($arguments)
    {
        $types = GiepewuApi::getTypes();

        $db = new Database(
            $_ENV['DATABASE_HOST'],
            $_ENV['DATABASE_PORT'],
            $_ENV['DATABASE_USER'],
            $_ENV['DATABASE_PASSWORD'],
            $_ENV['DATABASE_NAME'],
        );

        foreach ($types as $id => $name) {
            $db->upsert('gpw_types', [
                'id' => $id,
                'name' => $name,
            ]);
        }
    }
}
