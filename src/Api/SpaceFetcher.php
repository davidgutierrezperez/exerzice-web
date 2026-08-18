<?php

namespace Api;

use Api\ApiFetcher;
use Api\Fetcher;
use Infrastructure\Http\HttpResponse;

/**
 * The class SpaceFetcher represents a specific API fetcher component for spaces.
 */
final class SpaceFetcher extends Fetcher {

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
     * API fetcher component.
     * @var ApiFetcher
     */
    private readonly ApiFetcher $fetcher;

    /**
     * Default constructor of the class SpaceFetcher.
     */
    public function __construct(){
        $this->fetcher = new ApiFetcher();
    }

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
        return $this->fetcher->fetch($query);
    }
}

?>