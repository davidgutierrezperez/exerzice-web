<?php 

namespace Api\Fetching;

use Api\Fetching\ApiFetcher;
use Infrastructure\Http\HttpFetchingRequest;
use Infrastructure\Http\HttpMethod;
use Infrastructure\Http\HttpResponse;

/**
 * The class UserFetcher represents a specific users' data fetching component.
 */
final class UserFetcher extends ApiFetcher {

    /**
     * Base URL to obtain data about users.
     * @var string
     */
    private static $BASE_URL = '/users';

    /**
     * URL to obtain data about the current logged user.
     * @var string
     */
    private static $LOGGED_USER_URL = '/me';

    /**
     * ID parameter to obtain data about users.
     * @var string
     */
    private static $ID_PARAMETER = '/id';

    /**
     * Fetches information about a user identified by its ID.
     * @param string $id User's ID.
     * @return HttpResponse HTTP response.
     */
    public function byId(string $id): HttpResponse {
        $url = self::$BASE_URL . self::$ID_PARAMETER . '/' . $id;
        $query = $this->buildFetchQuery($url);

        $fetchingRequest = new HttpFetchingRequest(HttpMethod::GET, $query);

        return $this->fetch($fetchingRequest);
    }

    /**
     * Fetches information about the current logged user.
     * @return HttpResponse HTTP response.
     */
    public function loggedUser(): HttpResponse {
        $query = $this->buildFetchQuery(self::$LOGGED_USER_URL, []);

        $fetchingRequest = new HttpFetchingRequest(HttpMethod::GET, $query, []);
        return $this->fetch($fetchingRequest);
    }
}