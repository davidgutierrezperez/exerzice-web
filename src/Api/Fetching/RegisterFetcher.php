<?php

namespace Api\Fetching;

use Application\Persistence\Auth\RegisterRequest;
use Infrastructure\Http\HttpFetchingRequest;
use Infrastructure\Http\HttpMethod;
use Infrastructure\Http\HttpResponse;

/**
 * The class RegisterFetcher represents a specific fetching component for registering users.
 */
final class RegisterFetcher extends ApiFetcher {

    /**
     * Base URL to register new users.
     * @var string
     */
    private static string $BASE_URL = '/users';

    /**
     * Fetches a request to register a new user.
     * @param RegisterRequest $request Request to register a new use.
     * @return HttpResponse HTTP response.
     */
    public function register(RegisterRequest $request): HttpResponse {
        $params = [
            'auth_token' => $request->getAuthToken(),
            'location' => $request->getLocation()
        ];

        $query = $this->buildFetchQuery(self::$BASE_URL, $params);
        $fetchingRequest = new HttpFetchingRequest(HttpMethod::POST, $query, $params);

        return $this->fetch($fetchingRequest);
    }
}