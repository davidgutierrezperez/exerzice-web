<?php 

namespace Infrastructure\Http;

use Infrastructure\Http\HttpMethod;

/**
 * The class HttpFetchingRequest represents a request for HTTP fetching.
 */
final class HttpFetchingRequest {

    /**
     * HTTP method of the request.
     * @var HttpMethod
     */
    private readonly HttpMethod $method;

    /**
     * Route of the query itself.
     * @var string
     */
    private readonly string $query;

    /**
     * Parameters of the request.
     * @var array
     */
    private readonly array $params;

    /**
     * Default constructor of the class HttpFetchingRequest.
     * @param HttpMethod $method HTTP method of the request.
     * @param string $query Route of the query itself.
     * @param array $params Parameters of the request.
     */
    public function __construct(HttpMethod $method, string $query, array $params = []){
        $this->method = $method;
        $this->query = $query;
        $this->params = $params;
    }

    /**
     * Returns the method of the request.
     * @return HttpMethod HTTP method.
     */ 
    public function getMethod(): HttpMethod {
        return $this->method;
    }

    /**
     * Returns the query of the request.
     * @return string
     */ 
    public function getQuery(): string {
        return $this->query;
    }

    /**
     * Returns the parameters of the request.
     * @return array.
     */ 
    public function getParams(): array {
        return $this->params;
    }
}

