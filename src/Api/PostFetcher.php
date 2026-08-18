<?php 

namespace Api;

use Api\ApiFetcher;
use Api\Fetcher;
use Infrastructure\Http\HttpQueryBuilder;
use Infrastructure\Http\HttpResponse;
use Override;

final class PostFetcher extends Fetcher {

    private static string $BASE_URL = '/posts';
    private static string $CREATOR_PARAMETER = 'created_by';
    private readonly ApiFetcher $fetcher;

    public function __construct(){
        $this->fetcher = new ApiFetcher();
    }

    public function fetchByCreator(string $id): HttpResponse {
        $params = [
            self::$CREATOR_PARAMETER => $id
        ];

        $query = $this->buildFetchQuery(self::$BASE_URL, $params);
        error_log("LA QUERY ES: " . $query);
        return $this->fetcher->fetch($query);
    }
}

?>