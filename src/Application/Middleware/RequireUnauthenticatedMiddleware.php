<?php

namespace Application\Middleware;

use Application\Security\AlreadyAuthenticatedException;
use Application\Security\Auth\UserSession;
use Override;

/**
 * The class AuthenticationMiddleware represents a specific middleware component that checks if
 * the user is already logged in.
 */
final class RequireUnauthenticatedMiddleware implements Middleware {

    #[Override]
    /**
     * Checks if the user is already logged in.
     * @throws AlreadyAuthenticatedException
     * @return void
     */
    public function execute(): void {
        if (UserSession::isLoggedIn())
            throw new AlreadyAuthenticatedException();
    }
}