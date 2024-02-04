<?php

namespace Services;

use GuzzleHttp\Client;

class GpwScraperService
{
    public static function getTypes(): ?array
    {
        $client = new Client();

        $response = $client->request('GET', 'https://www.gpw.pl/archiwum-notowan', [
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:122.0) Gecko/20100101 Firefox/122.0',
                'Accept' => '*/*',
                'Accept-Language' => 'pl,en-US;q=0.7,en;q=0.3',
            ],
        ]);

        $body = $response->getBody()->getContents();

        $dom = new \simple_html_dom($body);

        $select = $dom->find('#selectType', 0);

        $options = $select->find('option');

        $out = [];

        foreach ($options as $option) {
            $value = $option->value;
            $text = $option->innertext;

            if (empty($value)) {
                continue;
            }

            $value = trim($value);
            $text = trim($text);
            $text = strtolower($text);

            $out[$value] = $text;
        }

        return $out;
    }

    public static function getInstrumentsByType(string $type = '1'): ?array
    {
        $client = new Client();

        $response = $client->request('POST', 'https://www.gpw.pl/ajaxindex.php', [
            'form_params' => [
                'action' => 'GPWQuotationsArchive',
                'start' => 'ajaxInstrument',
                'type' => $type,
                'date' => '',
            ],
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:122.0) Gecko/20100101 Firefox/122.0',
                'Accept' => '*/*',
                'Accept-Language' => 'pl,en-US;q=0.7,en;q=0.3',
            ],
        ]);

        $body = $response->getBody()->getContents();

        preg_match_all('/<option value="([^"]+)">([^<]+)<\/option>/', $body, $matches);

        return $matches[1] ?? null;
    }

    public static function data(string $type, string $name): array
    {
        $client = new Client();

        $type = urlencode($type);
        $name = urlencode($name);

        $response = $client->request('GET', "https://www.gpw.pl/archiwum-notowan-full?type={$type}&instrument={$name}&date=", [
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:122.0) Gecko/20100101 Firefox/122.0',
                'Accept' => '*/*',
                'Accept-Language' => 'pl,en-US;q=0.7,en;q=0.3',
            ],
        ]);

        $body = $response->getBody()->getContents();

        $dom = new \simple_html_dom($body);

        $table = $dom->find('.quotations-archive table', 0);

        $thead = $table->find('thead', 0);

        $tr = $thead->find('tr', 0);

        $th = $tr->find('th');

        $headers = [];

        foreach ($th as $th) {
            $hhh = $th->innertext;
            $hhh = str_replace('*', '', $hhh);
            $hhh = trim($hhh);
            $hhh = strtolower($hhh);

            if ($hhh === 'data sesji') {
                $hhh = 'date';
            } elseif ($hhh === 'kod isin') {
                $hhh = 'isin';
            } elseif ($hhh === 'waluta') {
                $hhh = 'currency';
            } elseif ($hhh === 'kurs otwarcia') {
                $hhh = 'open';
            } elseif ($hhh === 'kurs maksymalny') {
                $hhh = 'high';
            } elseif ($hhh === 'kurs minimalny') {
                $hhh = 'low';
            } elseif ($hhh === 'kurs zamknięcia') {
                $hhh = 'close';
            } elseif ($hhh === 'kurs rozliczeniowy') {
                $hhh = 'settlement';
            } elseif ($hhh === 'zmiana kursu %') {
                $hhh = 'change';
            } elseif ($hhh === 'wolumen obrotu (w szt.)') {
                $hhh = 'turnover_volume';
            } elseif ($hhh === 'liczba transakcji') {
                $hhh = 'transactions';
            } elseif ($hhh === 'wartość obrotu (w tys.)') {
                $hhh = 'turnover_value';
            }

            $headers[] = $hhh;
        }

        $tr = $table->find('tr');

        $body = [];

        foreach ($tr as $tr) {
            $td = $tr->find('td');

            if (empty($td)) {
                continue;
            }

            $row = [];

            foreach ($td as $td) {
                $row[] = trim($td->innertext);
            }

            $body[] = $row;
        }

        $out = [];

        foreach ($body as $row) {
            $out[] = array_combine($headers, $row);
        }

        return $out;
    }
}
