<?php 

namespace Infrastructure\Resolver;

use Infrastructure\Http\HttpResponse;
use Infrastructure\Resolver\ResolveResult;

/**
 * The class ResponseResolver represents a generic resolver for HTTP responses.
 */
abstract class ResponseResolver {

    /**
     * Resolves a HTTP response.
     * @param mixed $response HTTP response to resolve.
     * @return ResolveResult Result of the resolving process.
     */
    abstract function resolve(HttpResponse $response): ResolveResult;

    /**
     * Resolves the errors of the response.
     * @param array $errors Errors of the response.
     * @return ResolveResult Result of the resolving process.
     */
    protected function resolveErrors(string $enum, array $errors): ResolveResult {
        $normalizedErrors = [];

        foreach ($enum::cases() as $error) {
            if (in_array($error->value, $errors, true)) 
                $normalizedErrors[] = $error;
        }

        return new ResolveResult(null, $normalizedErrors);
    }
}