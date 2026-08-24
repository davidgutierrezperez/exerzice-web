<?php 

namespace Application\Middleware;

use Application\Security\Auth\UserSession;
use Application\Security\AuthenticationException;
use Override;

final class RequireAuthenticatedMiddleware implements Middleware {

    #[Override]
    public function execute(): void {
        if (!UserSession::isLoggedIn())
            throw new AuthenticationException();
    }
}