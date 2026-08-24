<?php 

namespace Infrastructure\Resolver\Auth;

use Infrastructure\Http\HttpResponse;
use Infrastructure\Resolver\ResolveResult;
use Infrastructure\Resolver\ResponseResolver;
use Override;

/**
 * The class RegisterResponseResolver represents a specific response resolver component
 * for users' register responses.
 */
final class RegisterResponseResolver extends ResponseResolver {

    #[Override]
    /**
     * Resolves a HTTP response.
     * @param mixed $response HTTP response to resolve.
     * @return ResolveResult Result of the resolving process.
     */
    public function resolve(HttpResponse $response): ResolveResult {
        $data = $response->getValue();
        $errors = $data['errors'] ?? [];
        
        if ($errors)
            return $this->resolveErrors(RegisterResolverError::class, $errors);

        return new ResolveResult(null, []);
    }
}