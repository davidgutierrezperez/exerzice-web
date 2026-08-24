<?php 

namespace Application\Mapper;

use Infrastructure\Http\HttpRequest;

/**
 * The interface Mapper represents a generic mapper for HTTP requests.
 */
interface Mapper {

    /**
     * Maps a HTTP request into another object.
     * @param HttpRequest $request HTTP request.
     * @return mixed Mapped object.
     */
    function map(HttpRequest $request): mixed;
}