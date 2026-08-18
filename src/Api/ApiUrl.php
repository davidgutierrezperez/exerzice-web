<?php 

namespace Api;

use Api\DotEnv;

final class ApiUrl {

    public static function url(): string {
        return $_ENV[DotEnv::API_URL];
    }
}

?>