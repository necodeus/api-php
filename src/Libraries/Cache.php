<?php 

namespace Libraries;

class Cache
{
    private $cacheDir = __DIR__ . '/../../cache/';

    public function get(string $key)
    {
        $cacheFile = $this->cacheDir . $key . '.cache';

        if (file_exists($cacheFile)) {
            $cache = file_get_contents($cacheFile);
            $cache = unserialize($cache);

            if (isset($cache['cacheTime']) && $cache['cacheTime'] > time()) {
                return $cache['value'];
            }
        }

        return null;
    }

    public function set(string $key, $value, int $cacheTime = 3600): void
    {
        $cacheFile = $this->cacheDir . $key . '.cache';

        $cache = [
            'value' => $value,
            'cacheTime' => time() + $cacheTime
        ];

        $cache = serialize($cache);

        file_put_contents($cacheFile, $cache);
    }
}