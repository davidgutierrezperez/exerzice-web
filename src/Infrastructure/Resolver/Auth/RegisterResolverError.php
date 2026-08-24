<?php

namespace Infrastructure\Resolver\Auth;

use Infrastructure\Resolver\ResolveError;

/**
 * The enum RegisterResolverError contains all the errors that might happen while
 * resolving a response from a ruser register request to the API.
 */
enum RegisterResolverError: string implements ResolveError {

    /**
     * The user is already registered error.
     */
    case USER_ALREADY_REGISTERED = 'user.already_registered';
}