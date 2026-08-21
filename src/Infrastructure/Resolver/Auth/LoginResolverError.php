<?php 

namespace Infrastructure\Resolver\Auth;

use Infrastructure\Resolver\ResolveError;

/**
 * The enum LoginResolverError contains all the possible errors that might
 * happen while resolvinga user's logging response. 
 */
enum LoginResolverError: string implements ResolveError {

    /**
     * The user is not actually registered.
     */
    case USER_NO_REGISTERED = 'no_registered_user';

    /**
     * The user is already logged in.
     */
    case USER_ALREADY_LOGGED_IN = "user_already_logged";

    /**
     * Response data is required.
     */
    case DATA_REQUIRED = 'data.required';

    /**
     * The user's ID is required.
     */
    case USER_ID_REQUIRED = 'user.id_required';

    /**
     * The user's ID is invalid.
     */
    CASE USER_ID_INVALID = 'user.id_invalid';

    /**
     * The user's name is required.
     */
    case USER_NAME_REQUIRED = 'user.name_required';
}