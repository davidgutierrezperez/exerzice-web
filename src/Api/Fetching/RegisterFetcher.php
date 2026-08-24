<?php

namespace Api\Fetching;

use Application\Persistence\Auth\RegisterRequest;
use Infrastructure\Http\HttpFetchingRequest;
use Infrastructure\Http\HttpMethod;
use Infrastructure\Http\HttpResponse;

final class RegisterFetcher extends ApiFetcher {
    private static string $BASE_URL = '/users';

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