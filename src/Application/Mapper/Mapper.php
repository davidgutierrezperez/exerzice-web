<?php 

namespace Application\Mapper;

use Infrastructure\Http\HttpRequest;

interface Mapper {
    function map(HttpRequest $request): mixed;
}