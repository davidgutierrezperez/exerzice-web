<?php 

namespace Api\Fetching;

use Infrastructure\Http\HttpFetchingRequest;
use Infrastructure\Http\HttpMethod;
use Infrastructure\Http\HttpResponse;

final class LoginFetcher extends ApiFetcher {
    private static string $BASE_URL = '/login';

    public function fetchLogin(string $authToken): HttpResponse {
        $params = [
            'auth_token' => $authToken
        ];

        $query = $this->buildFetchQuery(self::$BASE_URL);
        $fetchingRequest = new HttpFetchingRequest(HttpMethod::POST, $query, $params);
        
        return $this->fetch($fetchingRequest);
    }
}

?>