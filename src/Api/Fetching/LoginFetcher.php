<?php 

namespace Api\Fetching;

use Infrastructure\Http\HttpFetchingRequest;
use Infrastructure\Http\HttpMethod;
use Infrastructure\Http\HttpResponse;

/**
 * The class LoginFetcher represents a specific fetching component for logging features.
 */
final class LoginFetcher extends ApiFetcher {

    /**
     * Base URL for logging fetching.
     * @var string
     */
    private static string $BASE_URL = '/login';

    /**
     * Feches a logging request based on a authentication token.
     * @param string $authToken Authentication token.
     * @return HttpResponse HTTP response.
     */
    public function fetchLogin(string $authToken): HttpResponse {
        $params = [
            'auth_token' => $authToken
        ];

        $query = $this->buildFetchQuery(self::$BASE_URL);
        $fetchingRequest = new HttpFetchingRequest(HttpMethod::POST, $query, $params);
        
        return $this->fetch($fetchingRequest);
    }
}

