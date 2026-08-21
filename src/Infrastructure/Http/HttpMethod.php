<?php 

namespace Infrastructure\Http;

/**
 * The num HttpMethod contains the HTTP methods available.
 */
enum HttpMethod: string {

    /**
     * GET method.
     */
    case GET = 'GET';

    /**
     * POST method.
     */
    case POST = 'POST';

    /**
     * DELETE method.
     */
    case DELETE = 'DELETE';

    /**
     * PUT method.
     */
    case PUT = 'PUT';
}

