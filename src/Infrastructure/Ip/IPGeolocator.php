<?php 

namespace Infrastructure\Ip;

/**
 * The class IPGeolocator represents a geolocation component based on the current IP of a user.
 */
final class IPGeolocator {

    /**
     * Geolocation API URL.
     * @var string
     */
    private static string $API_URL = 'http://ip-api.com/json/';

    /**
     * Locates the city where the user is located.
     * @return string|null
     */
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