<?php 

namespace Api;

use Application\AuthenticationException;
use Application\AuthoritationExcepcion;
use Infrastructure\Http\HttpResponse;
use Infrastructure\Http\HttpCode;

final class ApiFetcher {
    public function fetch(string $route): HttpResponse {
        $ch = curl_init($route);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if ($response === false) 
            return new HttpResponse(null, HttpCode::INTERNAL_SERVER_ERROR);
        
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $this->checkResponseStatusCode($statusCode);

        $data = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) 
            return new HttpResponse(null, HttpCode::INTERNAL_SERVER_ERROR);
        

        return new HttpResponse($data, HttpCode::from($statusCode));
    }

    private function checkResponseStatusCode(int $statusCode): void {
        switch ($statusCode){
            case HttpCode::UNAUTHORIZED->value:
                throw new AuthoritationExcepcion();
            case HttpCode::FORBIDDEN->value: 
                throw new AuthenticationException();
            default:
                break;
        }
    }
}

?>