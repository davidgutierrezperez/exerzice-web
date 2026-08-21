<?php 

namespace Application\Validation\Auth\Error;

use Application\Validation\ValidationError;

enum LoginValidationError: string implements ValidationError {
    case NO_REGISTERED_USER = 'no_registered_user';
}

?>