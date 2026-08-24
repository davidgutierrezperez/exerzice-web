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
    private static string $LOGIN_URL = '/login';

    /**
     * Base URL for logging out fetching.
     * @var string
     */
    private static string $LOGOUT_URL = '/logout';

    /**
     * Feches a logging request based on a authentication token.
     * @param string $authToken Authentication token.
     * @return HttpResponse HTTP response.
     */
    public function login(string $authToken): HttpResponse {
        $params = [
            'auth_token' => $authToken
        ];

        $query = $this->buildFetchQuery(self::$LOGIN_URL);
        $fetchingRequest = new HttpFetchingRequest(HttpMethod::POST, $query, $params);
        
        return $this->fetch($fetchingRequest);
    }

    /**
     * Fetches a logging out request.
     * @return HttpResponse HTTP response.
     */
    public function logout(): HttpResponse {
        $query = $this->buildFetchQuery(self::$LOGOUT_URL);
        $fetchingRequest = new HttpFetchingRequest(HttpMethod::POST, $query, []);

        return $this->fetch($fetchingRequest);
    }
}

