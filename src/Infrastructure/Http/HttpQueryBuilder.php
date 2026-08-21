<?php 

namespace Infrastructure\Http;

/**
 * The class HttpQueryBuilder represents a query builder component for HTTP protocol.
 */
final class HttpQueryBuilder {

    /**
     * Builds a HTTP query from some paramaters.
     * @param array $params Parameters of the query.
     * @return string HTTP query fully built.
     */
    public static function build(array $params): string {
        return http_build_query($params);
    }
}

