<?php 

namespace Infrastructure\Http;

use Infrastructure\Http\HttpCode;

/**
 * The class HttpResponse represents a response component for the HTTP protocol.
 */
final class HttpResponse {

    /**
     * Value data of the response.
     * @var mixed
     */
    private readonly mixed $value;

    /**
     * HTTP response status code.
     * @var HttpCode
     */
    private readonly HttpCode $code; 

    /**
     * Default constructor of the class HttpResponse.
     * @param mixed $value Value data of the response.
     * @param HttpCode $code HTTP response status code.
     */
    public function __construct(mixed $value, HttpCode $code){
        $this->value = $value;
        $this->code = $code;
    }

    /**
     * Returns the value data of the response.
     * @param mixed
     */ 
    public function getValue(): mixed {
        return $this->value;
    }

    /**
     * Returns the HTTP code of the response.
     * @param HttpCode 
     */ 
    public function getCode(): HttpCode {
        return $this->code;
    }
}

?>