<?php

namespace Api;

use Infrastructure\Http\HttpQueryBuilder;

abstract class Fetcher {

    protected function buildFetchQuery(string $baseUrl, array $params): string {
        $queryParams = HttpQueryBuilder::build($params);

        return ApiUrl::url() . $baseUrl . '?' . $queryParams;
    }
}

?>