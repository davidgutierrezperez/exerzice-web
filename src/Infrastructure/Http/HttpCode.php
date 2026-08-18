<?php 

namespace Infrastructure\Http;

enum HttpCode: int {
    case SUCCESS = 200;

    case UNAUTHORIZED = 401;
    case FORBIDDEN = 403;
    case NOT_FOUND = 404;
    case INTERNAL_SERVER_ERROR = 500;
}

?>