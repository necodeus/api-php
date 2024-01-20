<?php

namespace Controllers\GiepewuApi;

use Libraries\Database;
use Services\GiepewuApi;

set_time_limit(10000);

/**
 * types
 * indexes
 * stocks
 * bonds
 * pp
 * futures
 * pda
 * investmentCertificates
 * warrants
 * indexUnits
 * options
 * structuredProducts
 * etf
 * bankSecurities
 * etc
 * finalFutures
 * finalOptions
 */

class InstrumentsController extends \Controllers\BaseController
{
    public function indexes(): void
    {
        $indexes = GiepewuApi::getInstrumentsByType('1'); // indeksy

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'indexes' => $indexes,
        ]);
    }

    public function stocks(): void
    {
        $stocks = GiepewuApi::getInstrumentsByType('10'); // akcje

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'stocks' => $stocks,
        ]);
    }

    public function bonds(): void
    {
        $bonds = GiepewuApi::getInstrumentsByType('13'); // obligacje skarbowe

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'bonds' => $bonds,
        ]);
    }

    public function pp(): void
    {
        $pp = GiepewuApi::getInstrumentsByType('17'); // prawa poboru

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'pp' => $pp,
        ]);
    }

    public function futures(): void
    {
        $futures = GiepewuApi::getInstrumentsByType('35'); // kontrakty terminowe

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'futures' => $futures,
        ]);
    }

    public function pda(): void
    {
        $pda = GiepewuApi::getInstrumentsByType('37'); // prawa do akcji

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'pda' => $pda,
        ]);
    }

    public function investmentCertificates(): void
    {
        $investmentCertificates = GiepewuApi::getInstrumentsByType('48'); // certyfikaty inwestycyjne

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'investmentCertificates' => $investmentCertificates,
        ]);
    }

    public function warrants(): void
    {
        $warrants = GiepewuApi::getInstrumentsByType('53'); // waranty

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'warrants' => $warrants,
        ]);
    }

    public function indexUnits(): void
    {
        $indexUnits = GiepewuApi::getInstrumentsByType('54'); // jednostki indeksowe

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'indexUnits' => $indexUnits,
        ]);
    }

    public function options(): void
    {
        $options = GiepewuApi::getInstrumentsByType('66'); // opcje

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'options' => $options,
        ]);
    }

    public function structuredProducts(): void
    {
        $structuredProducts = GiepewuApi::getInstrumentsByType('161'); // produkty strukturyzowane

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'structuredProducts' => $structuredProducts,
        ]);
    }

    public function etf(): void
    {
        $etf = GiepewuApi::getInstrumentsByType('241'); // etf

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'etf' => $etf,
        ]);
    }

    public function bankSecurities(): void
    {
        $bankSecurities = GiepewuApi::getInstrumentsByType('537'); // bankowe papiery wartościowe

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'bankSecurities' => $bankSecurities,
        ]);
    }

    public function etc(): void
    {
        $etc = GiepewuApi::getInstrumentsByType('560'); // etc

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'etc' => $etc,
        ]);
    }

    public function finalFutures(): void
    {
        $finalFutures = GiepewuApi::getInstrumentsByType('konktrakt_okr'); // ostateczne kursy rozliczeniowe kontraktów

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'finalFutures' => $finalFutures,
        ]);
    }

    public function finalOptions(): void
    {
        $finalOptions = GiepewuApi::getInstrumentsByType('opcje_kr'); // kursy rozliczeniowe opcji

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'finalOptions' => $finalOptions,
        ]);
    }

    protected function upsertTypes(array $types): void
    {
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

    public function types(): void
    {
        $types = GiepewuApi::getTypes();

        $this->upsertTypes($types);

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'types' => $types,
        ]);
    }

    public function upsertInstruments(string $type, array $types, array $instruments): void
    {
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

    public function instruments(string $type): void
    {
        // $types = GiepewuApi::getTypes();
        $instruments = GiepewuApi::getInstrumentsByType($type);

        // $this->upsertInstruments($type, $types, $instruments);

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'instruments' => $instruments,
        ]);
    }

    public function data(string $type, string $name): void
    {
        $data = GiepewuApi::data($type, $name);

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'data' => $data,
        ]);
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

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'instruments' => count($instruments),
        ]);
    }
}
