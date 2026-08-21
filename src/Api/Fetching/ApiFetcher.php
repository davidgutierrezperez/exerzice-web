<?php 

namespace Api\Fetching;

use Api\ApiUrl;
use Application\Security\AuthenticationException;
use Application\Security\AuthorizationException;
use Infrastructure\Http\HttpResponse;
use Infrastructure\Http\HttpCode;
use Infrastructure\Http\HttpFetchingRequest;
use Infrastructure\Http\HttpQueryBuilder;

/**
 * The class ApiFetcher represents the API fetcher components to request queries to the main Exerzice API.
 */
class ApiFetcher {

    /**
     * Fetches a query to the main Exerzice API.
     * @param HttpFetchingRequest $request Route of the API query.
     * @return HttpResponse HTTP response.
     */
    protected function fetch(HttpFetchingRequest $request): HttpResponse {
        $method = $request->getMethod()->value;
        $query = $request->getQuery();
        $params = $request->getParams();

        $response = fetch($query, [
            'method' => $method,
            'json' => $params
        ]);

        $statusCode = $response->status();
        $data = $response->json();

        $this->checkResponseStatusCode($statusCode);

        return new HttpResponse($data, HttpCode::from($statusCode));
    }

    /**
     * Builds a fetch query to use when using the API.
     * @param string $baseUrl Base URL of the query.
     * @param array $params Parameters of the query.
     * @return string Query fully built.
     */
    protected function buildFetchQuery(string $baseUrl, array $params = []): string {
        $queryParams = HttpQueryBuilder::build($params);

        return ApiUrl::url() . $baseUrl . '?' . $queryParams;
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
                throw new AuthorizationException();
            case HttpCode::FORBIDDEN->value: 
                throw new AuthenticationException();
            default:
                break;
        }
    }
}

?>