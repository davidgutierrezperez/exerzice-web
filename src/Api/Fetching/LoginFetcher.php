<?php 

namespace Api\Fetching;

use Infrastructure\Http\HttpResponse;

final class LoginFetcher extends ApiFetcher {
    private static string $BASE_URL = '/login';

    public function fetchLogin(string $authToken): HttpResponse {
        $params = [
            'auth_token' => $authToken
        ];

        $query = $this->buildFetchQuery(self::$BASE_URL);
        return $this->fetch($query, $params);
    }
}

?>