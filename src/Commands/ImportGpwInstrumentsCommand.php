<?php

namespace Commands;

use Libraries\Database;
use Services\GiepewuApi;

set_time_limit(10000);

class UpdateGpwInstrumentsCommand extends \BaseCommand
{
    protected $name = 'update:gpw-instruments';

    protected $description = '';

    public function handle($arguments)
    {
        $type = 1; // indeksy

        $types = GiepewuApi::getTypes();
        $instruments = GiepewuApi::getInstrumentsByType($type);

        $db = new Database(
            $_ENV['DATABASE_HOST'],
            $_ENV['DATABASE_PORT'],
            $_ENV['DATABASE_USER'],
            $_ENV['DATABASE_PASSWORD'],
            $_ENV['DATABASE_NAME'],
        );

        foreach ($instruments as $instrument) {
            $data = [
                'type_id' => $type,
                'type_name' => $types[$type],
                'name' => $instrument,
                'isin' => null,
                'first_quotation_date' => null,
                'last_quotation_date' => null,
            ];

            $db->upsert('gpw_instruments', $data);
        }
    }

    protected function getInstruments(): array
    {
        $db = new Database(
            $_ENV['DATABASE_HOST'],
            $_ENV['DATABASE_PORT'],
            $_ENV['DATABASE_USER'],
            $_ENV['DATABASE_PASSWORD'],
            $_ENV['DATABASE_NAME'],
        );

        return $db->fetchAll("SELECT * FROM gpw_instruments WHERE isin IS NULL");
    }

    public function findIndex(array $instruments, string $name): ?int
    {
        foreach ($instruments as $index => $instrument) {
            if ($instrument['name'] === $name) {
                return $index;
            }
        }

        return null;
    }

    public function fill(): void
    {
        $db = new Database(
            $_ENV['DATABASE_HOST'],
            $_ENV['DATABASE_PORT'],
            $_ENV['DATABASE_USER'],
            $_ENV['DATABASE_PASSWORD'],
            $_ENV['DATABASE_NAME'],
        );

        $instruments = $this->getInstruments();

        foreach ($instruments as $index => $instrument) {
            $response = GiepewuApi::data($instrument['type_id'], $instrument['name']);

            $isin = $response[0]['isin'] ?? null;

            $db->update('gpw_instruments', [
                'isin' => $isin,
            ], [
                'name' => $instrument['name'],
            ]);
        }

        return response([
            'status' => 'ok',
            'instruments' => count($instruments),
        ])->status(200);
    }
}
