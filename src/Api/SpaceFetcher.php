<?php

namespace Api;

use Api\ApiFetcher;
use Api\Fetcher;

final class SpaceFetcher extends Fetcher {
    private static string $BASE_URL = '/spaces';
    private static string $LOCATION_PARAMETER = 'location';

    private readonly ApiFetcher $fetcher;

    public function __construct(){
        $this->fetcher = new ApiFetcher();
    }

    public function fetchByLocation(string $location){
        $params = [
            self::$LOCATION_PARAMETER => $location
        ];

        $query = $this->buildFetchQuery(self::$BASE_URL, $params);
        return $this->fetcher->fetch($query);
    }
}

?>