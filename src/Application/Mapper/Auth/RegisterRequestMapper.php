<?php 

namespace Application\Mapper\Auth;

use Application\Mapper\Mapper;
use Application\Persistence\Auth\RegisterRequest;
use Infrastructure\Http\HttpRequest;
use Override;

/**
 * The class RegisterRequestMapper represents a specific mapper component for registering users requests.
 */
final class RegisterRequestMapper implements Mapper {

    #[Override]
    /**
     * Maps a HTTP request into another object.
     * @param HttpRequest $request HTTP request.
     * @return mixed Mapped object.
     */
    public function map(HttpRequest $request): mixed {
        $authToken = $request->input('credential');
        $location = 'Almería';

        return new RegisterRequest($authToken, $location);
    }
}