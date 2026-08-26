<?php 

namespace Controllers\Action;

use Api\Fetching\PostFetcher;
use Application\Mapper\Post\CreatePostMapper;
use Infrastructure\Http\HttpRequest;
use Infrastructure\Http\RouteRedirector;

final class PostController {

    private readonly PostFetcher $fetcher;

    public function __construct(){
        $this->fetcher = new PostFetcher();
    }
    
    public function create(): void {
        $httpRequest = new HttpRequest();
        $createPostRequest = new CreatePostMapper()->map($httpRequest);

        $response = $this->fetcher->create($createPostRequest);

        RouteRedirector::redirect('/');
    }

}