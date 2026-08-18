<?php

namespace Api;

use Infrastructure\Http\HttpQueryBuilder;

/**
 * The abstract class Fetcher represents a generic fetcher component.
 */
abstract class Fetcher {

    /**
     * Builds a fetch query to use when using the API.
     * @param string $baseUrl Base URL of the query.
     * @param array $params Parameters of the query.
     * @return string Query fully built.
     */
    protected function buildFetchQuery(string $baseUrl, array $params): string {
        $queryParams = HttpQueryBuilder::build($params);

        return ApiUrl::url() . $baseUrl . '?' . $queryParams;
    }
}

?>