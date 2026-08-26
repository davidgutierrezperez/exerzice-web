<?php 

namespace Application\Mapper\Post;

use Application\Mapper\Mapper;
use Application\Persistence\CreatePostRequest;
use Infrastructure\Http\HttpRequest;
use Override;
use Ramsey\Uuid\Uuid;

final class CreatePostMapper implements Mapper {
    #[Override]
    public function map(HttpRequest $request): mixed {
        $content = $request->input('content');

        if (!$content)
            return null;

        return new CreatePostRequest($content);
    }
}