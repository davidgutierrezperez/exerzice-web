<?php 

namespace Api;

use Application\AuthenticationException;
use Application\AuthoritationExcepcion;
use Infrastructure\Http\HttpResponse;
use Infrastructure\Http\HttpCode;

/**
 * The class ApiFetcher represents the API fetcher components to request queries to the main Exerzice API.
 */
final class ApiFetcher {

    /**
     * Fetches a query to the main Exerzice API.
     * @param string $route Route of the API query.
     * @return HttpResponse HTTP response.
     */
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

    /**
     * Checks the status code of a HTTP response and throws an exception if needed.
     * @param int $statusCode Status code of an HTTP response.
     * @throws AuthoritationExcepcion
     * @throws AuthenticationException
     * @return void
     */
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