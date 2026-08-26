<?php 

namespace Application\Mapper\Post;

use Application\Mapper\Mapper;
use Application\Persistence\CreatePostRequest;
use Infrastructure\Http\HttpRequest;
use Override;

/**
 * The class CreatePostMapper represents a specific mapper to convert HTTP requests 
 * into requests to create posts.
 */
final class CreatePostMapper implements Mapper {

    #[Override]
    /**
     * Maps a HTTP request into another object.
     * @param HttpRequest $request HTTP request.
     * @return mixed Mapped object.
     */
    public function map(HttpRequest $request): mixed {
        $content = $request->input('content') ?? null;

        if (!$content)
            return null;

        return new CreatePostRequest($content);
    }
}