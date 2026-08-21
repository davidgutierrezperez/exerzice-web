<?php

namespace Application\Middleware;

use Application\Security\AlreadyAuthenticatedException;
use Application\Security\Auth\UserSession;
use Override;

final class AuthenticationMiddleware implements Middleware {

    #[Override]
    public function execute(): void {
        if (UserSession::isLoggedIn())
            throw new AlreadyAuthenticatedException();
    }
}