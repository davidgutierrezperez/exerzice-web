<?php 

namespace Api;

use Infrastructure\Http\HttpResponse;
use Infrastructure\Http\HttpCode;

final class ApiFetcher {
    public function fetch(string $route): HttpResponse {
        if (empty(trim($route)))
            return new HttpResponse(null, HttpCode::NOT_FOUND);

        $ch = curl_init($route);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $data = json_decode($response, true);

        return new HttpResponse($data, HttpCode::SUCCESS);
    }
}

?>