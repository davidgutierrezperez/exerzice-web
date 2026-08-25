<?php 

namespace Api\Fetching;

use Api\Fetching\ApiFetcher;
use Infrastructure\Http\HttpFetchingRequest;
use Infrastructure\Http\HttpMethod;
use Infrastructure\Http\HttpResponse;

final class UserFetcher extends ApiFetcher {

    private static $BASE_URL = '/users';

    private static $LOGGED_USER_URL = '/me';

    public function byId(string $id): HttpResponse {
        $params = [
            'id' => $id
        ];

        $query = $this->buildFetchQuery(self::$BASE_URL, $params);
        $fetchingRequest = new HttpFetchingRequest(HttpMethod::GET, $query, $params);

        return $this->fetch($fetchingRequest);
    }

    public function loggedUser(): HttpResponse {
        $query = $this->buildFetchQuery(self::$LOGGED_USER_URL, []);

        $fetchingRequest = new HttpFetchingRequest(HttpMethod::GET, $query, []);
        return $this->fetch($fetchingRequest);
    }
}