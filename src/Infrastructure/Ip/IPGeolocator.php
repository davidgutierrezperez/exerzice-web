<?php 

namespace Infrastructure\Ip;

final class IPGeolocator {
    private static string $API_URL = 'http://ip-api.com/json/';

    public static function locate(): ?string {
        $ip = $_SERVER['REMOTE_ADDR'];

        $url = self::$API_URL . urlencode($ip);

        $json = file_get_contents($url);
        $data = json_decode($json, true);

        if ($data && $data['status'] === 'success')
            return $data['city'];

        return null;
    }
}