<?php 

namespace Application\Middleware;

use Application\Security\Auth\UserSession;
use Application\Security\AuthenticationException;
use Override;

/**
 * The class RequireAuthenticatedMiddleware represents a specific middleware component that 
 * checks if the user is logged in.
 */
final class RequireAuthenticatedMiddleware implements Middleware {

    #[Override]
    /**
     * Checks if the user is logged in.
     * @throws AuthenticationException
     * @return void
     */
    public function execute(): void {
        if (!UserSession::isLoggedIn())
            throw new AuthenticationException();

    }
}