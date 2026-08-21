<?php 

namespace Application\Middleware;

use Application\Security\EmptyRequestException;
use Infrastructure\Http\HttpRequest;
use Override;

final class RequestBodyMiddleware implements Middleware {
    #[Override]
    public function execute(): void
    {
        $httpRequest = new HttpRequest();

        if (empty($httpRequest->body()))
            throw new EmptyRequestException();
    }
}