<?php 

namespace Infrastructure\Resolver;

use Infrastructure\Resolver\ResolveResult;

/**
 * The interface ResponseResolver represents a generic resolver for HTTP responses.
 */
interface ResponseResolver {

    /**
     * Resolves a HTTP response.
     * @param mixed $response HTTP response to resolve.
     * @return ResolveResult Result of the resolving process.
     */
    function resolve(mixed $response): ResolveResult;
}