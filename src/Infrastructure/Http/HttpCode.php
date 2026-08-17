<?php 

namespace Infrastructure\Http;

enum HttpCode: int {
    case SUCCESS = 200;
    case NOT_FOUND = 404;
    case FORBIDDEN = 403;
}

?>