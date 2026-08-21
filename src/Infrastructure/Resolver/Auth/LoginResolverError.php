<?php 

namespace Infrastructure\Resolver\Auth;

use Infrastructure\Resolver\ResolveError;

enum LoginResolverError: string implements ResolveError {

    case NO_REGISTERED_USER = 'no_registered_user';
    case DATA_REQUIRED = 'data.required';
    case USER_ID_REQUIRED = 'user.id_required';

    CASE USER_ID_INVALID = 'user.id_invalid';

    case USER_NAME_REQUIRED = 'user.name_required';
}