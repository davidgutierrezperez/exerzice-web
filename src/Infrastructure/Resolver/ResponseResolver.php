<?php 

namespace Infrastructure\Resolver;

use Infrastructure\Resolver\ResolveResult;

interface ResponseResolver {
    function resolve(mixed $response): ResolveResult;
}