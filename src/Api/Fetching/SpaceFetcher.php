<?php

namespace Api\Fetching;

use Api\Fetching\ApiFetcher;
use Infrastructure\Http\HttpFetchingRequest;
use Infrastructure\Http\HttpMethod;
use Infrastructure\Http\HttpResponse;

/**
 * The class SpaceFetcher represents a specific API fetcher component for spaces.
 */
final class SpaceFetcher extends ApiFetcher {

    /**
     * Bas URL to make requests about spaces to the API.
     * @var string
     */
    private static string $BASE_URL = '/spaces';

    /**
     * Parameter to make queries based on location.
     * @var string
     */
    private static string $LOCATION_PARAMETER = 'location';

    /**
     * Fetches spaces based on location.
     * @param string $location Location of the spaces.
     * @return HttpResponse HTTP response.
     */
    public function fetchByLocation(string $location){
        $params = [
            self::$LOCATION_PARAMETER => $location
        ];

        $query = $this->buildFetchQuery(self::$BASE_URL, $params);
        $fetchingRequest = new HttpFetchingRequest(HttpMethod::GET, $query);

        return $this->fetch($fetchingRequest);
    }
}

?>