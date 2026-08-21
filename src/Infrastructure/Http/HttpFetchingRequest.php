<?php 

namespace Infrastructure\Http;

use Infrastructure\Http\HttpMethod;

final class HttpFetchingRequest {

    private readonly HttpMethod $method;
    private readonly string $query;
    private readonly array $params;

    public function __construct(HttpMethod $method, string $query, array $params = []){
        $this->method = $method;
        $this->query = $query;
        $this->params = $params;
    }

    

    /**
     * Get the value of method
     */ 
    public function getMethod(): HttpMethod {
        return $this->method;
    }

    /**
     * Get the value of query
     */ 
    public function getQuery(): string {
        return $this->query;
    }

    /**
     * Get the value of params
     */ 
    public function getParams(): array {
        return $this->params;
    }
}

?>