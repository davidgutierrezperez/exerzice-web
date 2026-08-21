<?php 

namespace Application\Validation\Auth\Error;

use Application\Validation\ValidationError;

enum LoginValidationError: string implements ValidationError {
    case USER_NO_REGISTERED = 'no_registered_user';
}

