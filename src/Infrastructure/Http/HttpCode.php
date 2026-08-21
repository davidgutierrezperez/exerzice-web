<?php 

namespace Infrastructure\Http;

/**
 * The enum HttpCode contains some HTTP protocol codes.
 */
enum HttpCode: int {

    /**
     * Success code.
     */
    case SUCCESS = 200;

    case BAD_REQUEST = 400;

    /**
     * Unauthorized code.
     */
    case UNAUTHORIZED = 401;

    /**
     * Forbidden code.
     */
    case FORBIDDEN = 403;

    /**
     * Not found resource code.
     */
    case NOT_FOUND = 404;

    /**
     * Internal server error code.
     */
    case INTERNAL_SERVER_ERROR = 500;
}

