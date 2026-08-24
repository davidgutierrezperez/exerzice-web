<?php 

namespace Infrastructure\Resolver\Auth;

use Infrastructure\Http\HttpResponse;
use Infrastructure\Resolver\Auth\RegisterResolverError as AuthRegisterResolverError;
use Infrastructure\Resolver\ResolveResult;
use Infrastructure\Resolver\ResponseResolver;
use Override;

final class RegisterResponseResolver extends ResponseResolver {

    #[Override]
    public function resolve(HttpResponse $response): ResolveResult {
        $data = $response->getValue();
        $errors = $data['errors'] ?? [];
        
        if ($errors)
            return $this->resolveErrors(RegisterResolverError::class, $errors);

        return new ResolveResult(null, []);
    }
}