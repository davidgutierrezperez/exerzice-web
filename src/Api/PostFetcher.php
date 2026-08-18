<?php 

namespace Api;

use Api\ApiFetcher;
use Api\Fetcher;
use Infrastructure\Http\HttpResponse;

/**
 * The class PostFetcher represents an API fetcher for posts.
 */
final class PostFetcher extends Fetcher {

    /**
     * Base URL for posts fetching queries.
     * @var string
     */
    private static string $BASE_URL = '/posts';

    /**
     * Parameter to obtain posts based on its creator.
     * @var string
     */
    private static string $CREATOR_PARAMETER = 'created_by';

    /**
     * API fetcher component.
     * @var ApiFetcher
     */
    private readonly ApiFetcher $fetcher;

    /**
     * Default constructor of the class PostFetcher.
     */
    public function __construct(){
        $this->fetcher = new ApiFetcher();
    }

    /**
     * Fetches posts by their creator.
     * @param string $id ID of the user who created the posts.
     * @return HttpResponse HTTP response.
     */
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