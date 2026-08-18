<?php 

namespace Infrastructure\Http;

final class HttpQueryBuilder {
    public static function build(array $params): string {
        return http_build_query($params);
    }
}

?>