<?php

namespace Commands;

use Libraries\Color;
use Libraries\Database;

use Services\GpwScraperService;

class UpdateGpwInstrumentsCommand extends BaseCommand
{
    protected $name = 'update:gpw-instruments';

    protected $description = '';

    public function handle($arguments)
    {
        $db = new Database(
            $_ENV['DATABASE_HOST'],
            $_ENV['DATABASE_PORT'],
            $_ENV['DATABASE_USER'],
            $_ENV['DATABASE_PASSWORD'],
            $_ENV['DATABASE_NAME'],
        );

        $instruments = $db->fetchAll("SELECT * FROM gpw_instruments WHERE isin IS NULL");

        foreach ($instruments as $instrument) {
            $response = GpwScraperService::data($instrument['type_id'], $instrument['name']);

            $isin = $response[0]['isin'] ?? null;

            Color::print("Updating instrument {$instrument['name']} with ISIN $isin...\n", 'lightgreen');

            $db->update('gpw_instruments', [
                'isin' => $isin,
            ], [
                'name' => $instrument['name'],
            ]);
        }
    }
}
