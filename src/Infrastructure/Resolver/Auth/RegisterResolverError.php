<?php

namespace Infrastructure\Resolver\Auth;

use Infrastructure\Resolver\ResolveError;

enum RegisterResolverError: string implements ResolveError {
    case USER_ALREADY_REGISTERED = 'user.already_registered';
}