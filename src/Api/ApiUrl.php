<?php 

namespace Api;

use Api\DotEnv;

/**
 * The class ApiUrl represents the URL of the main Exerzice API.
 */
final class ApiUrl {

    /**
     * Returns the URL of the main Exerzice API.
     * @return string
     */
    public static function url(): string {
        return $_ENV[DotEnv::API_URL];
    }
}

