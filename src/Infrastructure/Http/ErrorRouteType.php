<?php 

namespace Infrastructure\Http;

/**
 * The enum ErrorRouteType contains the types of error that might
 * happen while navigating.
 */
enum ErrorRouteType {

    /**
     * Not found route error.
     */
    case NOT_FOUND;

    /**
     * Forbidden route error.
     */
    case FORBIDDEN;
}

