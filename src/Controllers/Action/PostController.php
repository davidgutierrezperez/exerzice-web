<?php 

namespace Controllers\Action;

use Api\Fetching\PostFetcher;
use Application\Mapper\Post\CreatePostMapper;
use Infrastructure\Http\HttpRequest;
use Infrastructure\Http\HttpResponse;
use Infrastructure\Http\RouteRedirector;

/**
 * The class PostController represents a specific action controller to handle posts related actions.
 */
final class PostController {

    /**
     * Posts fecthing component.
     * @var PostFetcher
     */
    private readonly PostFetcher $fetcher;

    /**
     * Default constructor of the class PostController.
     */
    public function __construct(){
        $this->fetcher = new PostFetcher();
    }
    
    /**
     * Handles the creation of a new post.
     * @return void
     */
    public function create(): void {
        $httpRequest = new HttpRequest();
        $createPostRequest = new CreatePostMapper()->map($httpRequest);

        if (!$createPostRequest)
            RouteRedirector::redirect('/create-post');

        $this->fetcher->create($createPostRequest);
        RouteRedirector::redirect('/');
    }

    public function like(string $id): void {
        error_log("-----------------HE LLEGADO----------------------");
        $this->fetcher->like($id);
    }

}