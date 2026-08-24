<?php 

namespace Application\Mapper\Auth;

use Application\Mapper\Mapper;
use Application\Persistence\Auth\RegisterRequest;
use Infrastructure\Http\HttpRequest;
use Override;

final class RegisterRequestMapper implements Mapper {
    #[Override]
    public function map(HttpRequest $request): mixed {
        $authToken = $request->input('credential');
        $location = 'Almería';

        return new RegisterRequest($authToken, $location);
    }
}