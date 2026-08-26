<?php 

namespace Api\Fetching;

use Api\Fetching\ApiFetcher;
use Application\Persistence\CreatePostRequest;
use Infrastructure\Http\HttpFetchingRequest;
use Infrastructure\Http\HttpMethod;
use Infrastructure\Http\HttpResponse;

/**
 * The class PostFetcher represents an API fetcher for posts.
 */
final class PostFetcher extends ApiFetcher {

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
     * Fetches posts by their creator.
     * @param string $id ID of the user who created the posts.
     * @return HttpResponse HTTP response.
     */
    public function fetchByCreator(string $id): HttpResponse {
        $params = [
            self::$CREATOR_PARAMETER => $id
        ];

        $query = $this->buildFetchQuery(self::$BASE_URL, $params);
        $fetchingRequest = new HttpFetchingRequest(HttpMethod::GET, $query);

        return $this->fetch($fetchingRequest);
    }

    /**
     * Fetches the creation of a new post.
     * @param CreatePostRequest $request Request to create a new post.
     * @return HttpResponse HTTP response.
     */
    public function create(CreatePostRequest $request): HttpResponse {
        $params = [
            'content' => $request->getContent()
        ];

        $query = $this->buildFetchQuery(self::$BASE_URL);
        $fetchingRequest = new HttpFetchingRequest(HttpMethod::POST, $query, $params);
        return $this->fetch($fetchingRequest);
    }
}

