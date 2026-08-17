<?php 

namespace Infrastructure\Http;

use Infrastructure\Http\HttpCode;

final class HttpResponse {
    private readonly mixed $value;
    private readonly HttpCode $code; 

    public function __construct(mixed $value, HttpCode $code){
        $this->value = $value;
        $this->code = $code;
    }

    /**
     * Get the value of value
     */ 
    public function getValue(): mixed {
        return $this->value;
    }

    /**
     * Get the value of code
     */ 
    public function getCode(): HttpCode {
        return $this->code;
    }
}

?>